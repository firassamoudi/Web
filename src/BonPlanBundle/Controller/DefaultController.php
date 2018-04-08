<?php

namespace BonPlanBundle\Controller;

use BonPlanBundle\Entity\User;
use BonPlanBundle\Form\ProfileType;
use BonPlanBundle\Form\RechercheType;
use BonPlanBundle\Form\VisiteurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

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


    public function rechercheAction(Request $request)
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
    }

    public function indexAction(Request $request)
    {
        return $this->render('BonPlanBundle:Default:index.html.twig');

    }

    public function AjoutAction(Request $request)
    {
        {

            $id = $this->getUser()->getId();

            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository(User::class)->findOneBy(array('id' => $id));
            $form = $this->createForm(VisiteurType::class, $user);
            $form->handleRequest($request);
            if ($form->isSubmitted()) {
                $em->persist($user);


                $em->flush();

                return $this->redirectToRoute('bon_plan_homepage');

            }

            return $this->render('BonPlanBundle:Default:Ajouter.html.twig', array(
                "form" => $form->createView()
            ));
        }
    }

    public function CategorieRestauAction()
    {
        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery(
                'SELECT u FROM BonPlanBundle:User u WHERE 
                  u.categorie LIKE :categorie'
            )->setParameter('categorie', '%restaurant%'
            );
        $users = $query->getResult();


        return $this->render('@BonPlan/Default/Categorie/CategorieRestaurant.html.twig', array('restau' => $users));
    }

    public function CategoriehotlesAction()
    {
        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery(
                'SELECT u FROM BonPlanBundle:User u WHERE 
                  u.categorie LIKE :categorie'
            )->setParameter('categorie', '%hotel%'
            );
        $users = $query->getResult();
        return $this->render('@BonPlan/Default/Categorie/CategorieHotels.html.twig', array('hotels' => $users));
    }


    public function CategorienightlifeAction()
    {
        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery(
                'SELECT u FROM BonPlanBundle:User u WHERE 
                  u.categorie LIKE :categorie'
            )->setParameter('categorie', '%nightlife%'
            );
        $users = $query->getResult();
        return $this->render('@BonPlan/Default/Categorie/CategorieNightlife.html.twig', array('nightlife' => $users));
    }

    public function CategorieCoffeAction()
    {
        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery(
                'SELECT u FROM BonPlanBundle:User u WHERE 
                  u.categorie LIKE :categorie'
            )->setParameter('categorie', '%coffee%'
            );
        $users = $query->getResult();
        return $this->render('@BonPlan/Default/Categorie/CategorieCoffee.html.twig', array('coffees' => $users));
    }


    public function CategoriecultureAction()
    {
        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery(
                'SELECT u FROM BonPlanBundle:User u WHERE 
                  u.categorie LIKE :categorie'
            )->setParameter('categorie', '%culture%'
            );
        $users = $query->getResult();
        return $this->render('@BonPlan/Default/Categorie/CategorieCulture.html.twig', array('cultures' => $users));
    }


    public function AjoutPAction(Request $request)
    {
        $id = $this->getUser()->getId();

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);
        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $em->flush();

            return $this->redirectToRoute('bon_plan_homepage');

        }

        return $this->render('BonPlanBundle:Default:AjouterP.html.twig', array(
            "form" => $form->createView()
        ));
    }


    public function adminlogAction()
    {
        $this->denyAccessUnlessGranted("ROLE_ADMIN");

        return $this->render('BonPlanBundle:Default:loginback.html.twig');
    }

    public function ConsulterAction()
    {
        return $this->render('BonPlanBundle:Default:Consulter.html.twig');
    }

    public function ConsulterPAction()
    {
        return $this->render('BonPlanBundle:Default:ProfilPlan.html.twig');
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

    public function AcceuilBackAction()
    {
        $this->denyAccessUnlessGranted("ROLE_ADMIN");

        $em = $this->getDoctrine()->getManager();
        $NombreUser = $em->getRepository('BonPlanBundle:User');
        $nb = $NombreUser->nombrePlan();

        return $this->render('BonPlanBundle:Default:Acceuilback.html.twig', array('nombre' => $nb));
    }
    //public function CategorierestauAction()
    //{
    //  return $this->render('@BonPlan/Default/Categorie/CategorieRestaurant.html.twig');
    //}

}
