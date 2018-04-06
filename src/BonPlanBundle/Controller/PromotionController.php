<?php

namespace BonPlanBundle\Controller;

use BonPlanBundle\Entity\Likes;
use BonPlanBundle\Entity\Promotion;
use BonPlanBundle\Entity\User;
use BonPlanBundle\Form\PromotionType;
use BonPlanBundle\Form\PromotionUpdateType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use BonPlanBundle\Repository\promotionRepository;

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

        if (($authChecker->isGranted('ROLE_SUPER_ADMIN'))) {


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
            if ( $dat > $today) {
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
        ));}

    public function detailPromoAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $promotion = $em->getRepository(Promotion::class)->findById($id);


        return $this->render("BonPlanBundle:Default/Promotion:detail_promo.html.twig",array(
            'promo' => $promotion
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
    public function like_ClikedAction(Request $request)
    {
        if ($request->isXmlHttpRequest())
        {
            if ($request->get('id'))
            {
                $likes = new Likes();
                $em = $this->getDoctrine()->getManager();
                $likes->setIduser($this->getUser());
                $likes->setPromotion($em->getRepository('BonPlanBundle:Promotion')->findOneBy(array('id' => $request->get('id'))));
                $em->persist($likes);
                $em->flush();
                $id = $request->get('id');

                $resultat = $this->getDoctrine()->getRepository('GalleryBundle:Likes')->findBy(array('idpromotion' => $id));

                $data = count($resultat);
                return new JsonResponse($data);

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
                return $this->redirect($this->generateUrl('liste_Promotion_Prop'));
            }
            return $this->render('@BonPlan/Default/Promotion/ModifierPromotion.html.twig', array('form'=>$form->createView()));
       // }else{
         //   return $this->render('@BonPlan/Default/index.html.twig');
        }
    public function UpdatePromotion1Action(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $promotion = $em->getRepository(Promotion::class)->find($id);
        $form=$this->createForm(PromotionUpdateType::class,$promotion);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $promotion->setDatedebutp($request->get(""));
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
}
