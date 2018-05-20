<?php

namespace BonPlanBundle\Controller;

use BonPlanBundle\Entity\Likes;
use BonPlanBundle\Entity\Promotion;
use BonPlanBundle\Entity\User;
use BonPlanBundle\Form\PromotionType;
use BonPlanBundle\Form\PromotionUpdateType;
use BonPlanBundle\Form\RatePromoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use BonPlanBundle\Repository\promotionRepository;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class PromotionController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
    public function listPromotionAdminAction()
    {
        $authChecker = $this->container->get('security.authorization_checker');
        $em = $this->getDoctrine()->getManager();

        if (($authChecker->isGranted('ROLE_ADMIN'))) {


            $promotion = $em->getRepository('BonPlanBundle:Promotion')->findAll();

            return $this->render('BonPlanBundle:Default/Promotion:PromotionAdmin.html.twig', array('promo' => $promotion));
        }



    elseif (($authChecker->isGranted('ROLE_PROP'))){
        $promotion = $em->getRepository('BonPlanBundle:Promotion')->findByuser($this->getUser()->getId());

        return $this->render('@BonPlan/Default/Promotion/ListePromotionProp.html.twig', array('promo' => $promotion));

        }  else
            return $this->render('@BonPlan/Default/pageErreur.html.twig');
    }
    public function listPromotionVisiteurAction()
    {
        $promo= array();
        $today = (new \DateTime())->format('Y-m-d');

        $em = $this->getDoctrine()->getManager();
        $promotion = $em->getRepository('BonPlanBundle:Promotion')->findAll();
        foreach ($promotion as $p) {
            $dat = $p->getDatefinp()->format('Y-m-d');
            if (( $dat > $today) and($p->getEtat()=="en cours") ){
                $promo[] = $p;
            }
        }
        return $this->render('BonPlanBundle:Default/Promotion:ListePromoDiv.html.twig', array('promo' => $promo));


    }
    public function listPromotionPropAction()
    {


        $em = $this->getDoctrine()->getManager();
        $promotion = $em->getRepository('BonPlanBundle:Promotion')->findByuser($this->getUser()->getId());

        return $this->render('@BonPlan/Default/Promotion/ListePromotionProp.html.twig', array('promo' => $promotion));


    }

    public function addPromotionAction(Request $request)
    {
        //$usr = $this->getUser()->getRole();
      //  $authChecker = $this->container->get('security.authorization_checker');
       // if (($authChecker->isGranted('ROLE_PROPRIETAIRE')))
        {
            $promotion = new Promotion();
            $user = $this->getUser();


            $form = $this->createForm(PromotionType::class, $promotion);
            $form->handleRequest($request);
            $session = new Session();
            $promotion->setUserPlan($this->getUser());
$promotion->setEtat("en cours");

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($promotion);

                $em->flush();
                $session->getFlashBag()->add('success', 'Promotion ajouté avec succes');
                return $this->redirect($this->generateUrl('liste_Promotion_Prop'));
            }
            return $this->render('BonPlanBundle:Default/Promotion:AjoutPromotion.html.twig', array('form' => $form->createView()));
       // }else{
        //    return $this->render('BonPlanBundle:Default:AjoutPromotion.html.twig');
        }}
        public function create_PrmotionAction(Request $request)
    {

        $promotion = new Promotion();
        $form=$this->createForm(PromotionType::class,$promotion);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em=$this->getDoctrine()->getManager();
            $promotion->setUserPlan($this->getUser());
           // $file = $promotion->getUrlpromo();

            //$filename = $this->generateUniqueFileName().'.'.$file->guessExtension();
            //$file->move(
              //  $this->getParameter('brochures_directory'),$filename
            //);
           // $promotion->setUrlpromo($filename);
            $em->persist($promotion);
            $em->flush();
            return $this->redirectToRoute("liste_Promotion_Admin");
        }
        return $this->render('BonPlanBundle:Default/Promotion:Ajouter_Promotion.html.twig', array(
            "form"=>$form->createView()
        ));

}
    public function UpdatePromotion1Action(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $promotion = $em->getRepository(Promotion::class)->find($id);
        $form=$this->createForm(PromotionUpdateType::class,$promotion);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em->persist($promotion);
            //Mettre a jour
            $em->flush();
            //Rederiger vers read
            // $promotion =$em->getRepository(Promotion::class)->findByidUser($this->getUser());
            return $this->redirect($this->generateUrl('liste_Promotion_Prop'));
        }
        return $this->render('BonPlanBundle:Default/Promotion:ModifierPromotion.html.twig',array(
                "form"=>$form->createView(),"promo"=>$promotion)
        );
    }


    public function detailPromoAction(Request $request,$id)
    { $promotion = new Promotion();

        $em = $this->getDoctrine()->getManager();
        $promo = $em->getRepository(Promotion::class)->findById($id);
        $promotion=$em->getRepository(Promotion::class)->findOneBy(array('idpromotion'=>$id));
        $form = $this->createForm(RatePromoType::class, $promotion);
        $form->handleRequest($request);
        $p= $form->get("etat_promo")->getData();
        $m=$promotion->getEtatPromo()+$p;
$promotion->setEtatPromo($p);
        if (($form->isSubmitted() )) {

            $em->persist($promotion);



            $em->flush();
         }

        return $this->render("BonPlanBundle:Default/Promotion:detail_promo.html.twig",array(
            'promo' => $promo ,"form"=>$form->createView()
        ));





    }
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
    public function addPromoAction(Request $request)
    {
        //$usr = $this->getUser()->getRole();
        $authChecker = $this->container->get('security.authorization_checker');
        if (($authChecker->isGranted('ROLE_PROP')))
        {
            $promotion = new Promotion();
            $form = $this->createForm(PromotionType::class, $promotion);
            $form->handleRequest($request);
            $session = new Session();
            if ($form->isValid()) {
                //$promotion->setFosUser($this->getUser());
                $promotion->setUserPlan($this->getUser());

                $file = $promotion->getUrlpromo();

                $filename = $this->generateUniqueFileName().'.'.$file->guessExtension();
                $file->move(
                    $this->getParameter('brochures_directory'),$filename
                );
                $promotion->setUrlpromo($filename);
                $em = $this->getDoctrine()->getManager();
                $em->persist($promotion);
                $em->flush();
                $session->getFlashBag()->add('success', 'promo ajouté avec succes');
                return $this->redirect($this->generateUrl('liste_Promotion_Prop'));
            }
            return $this->render('BonPlanBundle:Default/Promotion:Ajouter_Promotion.html.twig', array('form' => $form->createView()));
        //}else{
          //  return $this->render('piBundle:Default:erreur_403.html.twig');
        }
        else {
            return $this->render('@BonPlan/Default/index.html.twig');

        }
    }

    public function LikesAction(Request $request)
    {
        if ($request->isXmlHttpRequest())
        {
            if ($request->get('id'))
            {

                $likes = new Likes();
                $em = $this->getDoctrine()->getManager();
                $likes->setIduser($this->getUser()->getId());
                $likes->setIdpromotion($request->get('id'));
                $likes->setNumber($likes->getNumber()+1);
                $id = $request->get('idpromotion');
                $resultat = $this->getDoctrine()->getRepository('BonPlanBundle:Likes')->findBy(array('idpromotion' => $id));
                $nb = $this->getDoctrine()->getRepository('BonPlanBundle:Promotion')->likenumber($id);

                $data = ($resultat);
                $em->persist($likes);
                $em->flush();


                return new JsonResponse($nb);

            }


        }
        return $this->redirectToRoute('liste_Promotion_Visiteur');


    }


    public function Recherche_PromotionPropAction(Request $request)
    {
        $search =$request->get('promotion');
        $en = $this->getDoctrine()->getManager();
        $promotion=$en->getRepository("BonPlanBundle:Promotion")->findByuser($search);
        return $this->render("BonPlanBundle:Default/Promotion:ListePromotionProp.html.twig",array(
            'promo' => $promotion
        ));
    }
    public function updatePromotionAction(Request $request, $id)
    {
        //$authChecker = $this->container->get('security.authorization_checker');
        //if (($authChecker->isGranted('ROLE_PROPRIETAIRE')))
        //{
            $promotion_id = $request->get('id');

            $em = $this->getDoctrine()->getManager();

            $promotion = $em->getRepository('BonPlanBundle:Promotion')->find($promotion_id);


            $form = $this->createForm(PromotionType::class, $promotion);

            $form->handleRequest($request);

            if($form->isValid())
            {

                $em->persist($promotion);
                $em->flush();
                return $this->render('@BonPlan/Default/Promotion/ListePromotionProp.html.twig');
            }
            return $this->render('@BonPlan/Default/Promotion/ModifierPromotion.html.twig', array('form'=>$form->createView()));
       // }else{
         //   return $this->render('@BonPlan/Default/index.html.twig');
        }


    public function deletePromotionAction(Request $request)
    {
        $promotion_id = $request->get('id');
        $em = $this->getDoctrine()->getManager();

        $promotion= $em->getRepository('BonPlanBundle:Promotion')->find($promotion_id);
        $em->remove($promotion);
        $em->flush();

        return $this->redirectToRoute('liste_Promotion_Prop');

    }
    public function RechercheAction(Request $request)
    {

        $search =$request->query->get('promotion');
        $en = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $promotion=$en->getRepository("BonPlanBundle:Promotion")->findDescription($search,$user);
        return $this->render("BonPlanBundle:Default/Promotion:ListePromotionProp.html.twig",array(
            'promo' => $promotion

        ));
    }
    public function RechercheAdminAction(Request $request)
    {

        $search =$request->query->get('promotion');
        $en = $this->getDoctrine()->getManager();

        $promotion=$en->getRepository("BonPlanBundle:Promotion")->findDescriptionAdmin($search);
        return $this->render("BonPlanBundle:Default/Promotion:PromotionAdmin.html.twig",array(
            'promo' => $promotion

        ));
    }


    ///*******************webservices************************
    public function newMobileAction(Request $request)
    {


        $date=new \DateTime($request->get("datedebutp"));
        $datef=new \DateTime($request->get("datefinp"));
        //$promotio->setDatedebutp($date);
        $em = $this->getDoctrine()->getManager();
        $id=$request->get('proprietaire_id');
        $user = $this->getDoctrine()->getManager()
            ->getRepository('BonPlanBundle:User')
            ->find($id);
        $promotion = new Promotion();
        $promotion->setDescription($request->get('descritpion'));
        $promotion->setReduction($request->get('reduction'));
        $promotion->setDatedebutp($date);
        $promotion->setUrlpromo($request->get('urlPromo'));
        $promotion->setDatedebutp($date);
        $promotion->setDatefinp($datef);
        $promotion->setEtatPromo(0);
        $promotion->setUserPlan($user);
        $em->persist($promotion);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($promotion);
        return new JsonResponse($formatted);
    }
    public function findPromoMobileAction($id)
    {
        //$id=$request->get('proprietaire_id');
        $promotions = $this->getDoctrine()->getManager()
            ->getRepository('BonPlanBundle:Promotion')
            ->findByuser($id);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($promotions);
        return new JsonResponse($formatted);
    }
    public function findMobileAction($id)
    {
        $promotions = $this->getDoctrine()->getManager()
            ->getRepository('BonPlanBundle:Promotion')
            ->find($id);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($promotions);
        return new JsonResponse($formatted);
    }
    public function findUserMobileAction($id)
    {
        //  $promotions = $this->getDoctrine()->getManager()
        //    ->getRepository('BonPlanBundle:Promotion')
        //  ->findBy($id);
        $promotion=$this->getDoctrine()->getManager()
            ->getRepository(Promotion::class)->findOneBy(array('idpromotion'=>$id));
        $serializer = new Serializer([new ObjectNormalizer()]);

        $p = $promotion->getUserPlan()->getNomPlan();

        $formatted = $serializer->normalize($p);
        return new JsonResponse($formatted);
    }
    public function allMobileAction()
    {
        $promotions = $this->getDoctrine()->getManager()
            ->getRepository('BonPlanBundle:Promotion')
            ->findAll();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($promotions);

        return new JsonResponse($formatted);
    }
}
