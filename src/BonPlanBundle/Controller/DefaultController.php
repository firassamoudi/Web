<?php

namespace BonPlanBundle\Controller;

use BonPlanBundle\Entity\Categorie;
use BonPlanBundle\Entity\Reservation;
use BonPlanBundle\Entity\User;
use BonPlanBundle\Form\ProfileType;
use BonPlanBundle\Form\RechercheType;
use BonPlanBundle\Form\VisiteurType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class DefaultController extends Controller
{

    public function RechercherPlanAction(Request $request,$nomPlan)
    {
        $modele=new User();

        $em=$this->getDoctrine()->getManager();


        $form=$this->createForm(RechercheType::class,$modele);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $modele=$em->getRepository("BonPlanBundle:User")->findGlobale($nomPlan);

        }else{
            $modele=$em->getRepository("BonPlanBundle:User")->findAll();

        }
        return $this->render('@BonPlan/Default/Rechercher.html.twig',
            array("form"=>$form->createView(),'model'=>$modele));

    }


   /* public function rechercheAction(Request $request)
    {
        if ($request->isXmlHttpRequest()){
            $search =$request->query->get('reche');
            $en = $this->getDoctrine()->getManager();
            $plan=$en->getRepository("BonPlanBundle:User")->findGlobale($search);
            $response = new JsonResponse();
            return $response->setData(array('p'=>$plan));}

        return $this->render("@BonPlan/Default/index.html.twig",array(
            'plans' => $plan
        ));
    }*/

    public function indexAction(Request $request)
    {
        $categories=new Categorie();
        $em=$this->getDoctrine()->getManager();
        $categories=$em->getRepository(Categorie::class)->findAll();
        return $this->render('BonPlanBundle:Default:index.html.twig', array(
            'categories'=>$categories
        ));
    }
    public function indexViewAllAction()
    {
        $em=$this->getDoctrine()->getManager();
        $user=$em->getRepository(User::class)->findByProp();
        return $this->render('@BonPlan/Default/AfficherToutPlan.html.twig' ,array(
            'users'=>$user
        ));
    }
    public function AjoutAction(Request $request )
    {
        {

            $id = $this->getUser()->getId();

            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository(User::class)->find($id);
            $form = $this->createForm(VisiteurType::class, $user);
            $form->handleRequest($request);
            if ($form->isSubmitted()) {

                $em->flush();

                return $this->redirectToRoute('bon_plan_homepage');

            }

            return $this->render('BonPlanBundle:Default:Ajouter.html.twig', array(
                "form" => $form->createView()
            ));
        }}
    public function AjoutPAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->findOneBy(array('id'=>$id));
        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $user->upload();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('bon_plan_homepage');

        }

        return $this->render('BonPlanBundle:Default:AjouterP.html.twig', array(
            "form" => $form->createView()
        ));
    }


    /**
     * @Route("/admin/", name="RoleAdmin")
     */
    public function adminlogAction()
    {
       // $this->denyAccessUnlessGranted("ROLE_ADMIN");

        return $this->render('BonPlanBundle:Default:loginback.html.twig');
    }
    public function ProfilPropAction()
    {
        return $this->render('BonPlanBundle:ProfilPlan:ProfilProp.html.twig');
    }
    public function EditProfilPropAction()
    {
        return $this->render('BonPlanBundle:ProfilPlan:EditProfilProp.html.twig');
    }
    public function ConsulterAction()
    {
        return $this->render('BonPlanBundle:Default:Consulter.html.twig');
    }
    public function ConsulterPAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository(User::class)->findById($id);
<<<<<<< HEAD

        if ($request->isMethod('POST')){
            $modele=new Reservation();

            $modele->setNbrplace($request->get('nbrplace'));
            $modele->setDate(new \DateTime($request->get('dateReservation')));
            $modele->setHeure(new \DateTime($request->get('heure')));
            $modele->setEtat('en cours');
            $modele->setTelephone($request->get('telephone'));
            $modele->setUserVisiteur($this->getUser());

            $modele->setUserPlan($users['0']);

            $emm=$this->getDoctrine()->getManager();
            $emm->persist($modele);
            $emm->flush();
            return $this->render('BonPlanBundle:Default:ProfilPlan.html.twig', array(
                'users_consult'=>$users
            ));
=======
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
        $plan = $this->getDoctrine()->getManager()->getRepository('BonPlanBundle:Abonner')->findOneBy(array('userVisiteur' => $this->getUser()->getId()));
            return $this->render('BonPlanBundle:Default:ProfilPlan.html.twig', array(
                'users_consult'=>$users,'plan' => $plan));

>>>>>>> f4659b75fc35a8fa471a7353ef0e073b121ec555
        }


        return $this->render('BonPlanBundle:Default:ProfilPlan.html.twig', array(
            'users_consult'=>$users,'plan' => null
        ));

    }
	    public function ConsulterPlAction($id)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $plan = $this->getDoctrine()->getManager()->getRepository('BonPlanBundle:Abonner')->findOneBy(array('userVisiteur' => $this->getUser()->getId()));
            return $this->render('BonPlanBundle:Default:ProfilPlan.html.twig', array('plan' => $plan));
        }
        return $this->render('BonPlanBundle:Default:ProfilPlan.html.twig', array('plan' => null));

    }

    public function indexAdminAction()
    {
        $this->denyAccessUnlessGranted("ROLE_ADMIN");

        return $this->render('BonPlanBundle:Default:indexback.html.twig');
    }

    public function EventsAction()
    {
        return $this->render('BonPlanBundle:Default:Events.html.twig');
    }

    /**
     * @Route("/admin/", name="RoleAdmin")
     */
    public function AcceuilBackAction()
    {
<<<<<<< HEAD
       // $this->denyAccessUnlessGranted("ROLE_ADMIN");
=======
        $this->denyAccessUnlessGranted("ROLE_ADMIN");

        $em = $this->getDoctrine()->getManager();
        $NombreUser = $em->getRepository('BonPlanBundle:User');
        $nb = $NombreUser->nombrePlan();

        return $this->render('BonPlanBundle:Default:Acceuilback.html.twig', array('nombre' => $nb));
<<<<<<< HEAD
=======
>>>>>>> b820972144c8f32a32d404d0bb685d1561150cce
        return $this->render('BonPlanBundle:Default:Acceuilback.html.twig');
>>>>>>> f4659b75fc35a8fa471a7353ef0e073b121ec555
    }
    public function CategorierestauAction()
    {
        return $this->render('@BonPlan/Default/CategorieRestaurant.html.twig');
    }


<<<<<<< HEAD

    public function ConsulterPlAction($id)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $plan = $this->getDoctrine()->getManager()->getRepository('BonPlanBundle:Abonner')->findOneBy(array('userVisiteur' => $this->getUser()->getId()));
            return $this->render('BonPlanBundle:Default:ProfilPlan.html.twig', array('plan' => $plan));
        }
        return $this->render('BonPlanBundle:Default:ProfilPlan.html.twig', array('plan' => null));

    }



=======
>>>>>>> 2fc00991a238d4670f325c3fd33b98e2396eb468
}
