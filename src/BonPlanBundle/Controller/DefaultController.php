<?php

namespace BonPlanBundle\Controller;

use BonPlanBundle\Entity\Avis;
use BonPlanBundle\Entity\Categorie;
use BonPlanBundle\Entity\Reservation;
use BonPlanBundle\Entity\User;
use BonPlanBundle\Form\AjouterCommentaire;
use BonPlanBundle\Form\ProfileType;
use BonPlanBundle\Form\RechercheType;
use BonPlanBundle\Form\VisiteurType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
<<<<<<< HEAD
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;


=======
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
>>>>>>> 98c1bff408d5bf6b674b2043121740432770b49e

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
    public function CategoriecultureAction()
    {
        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery(
                'SELECT u FROM BonPlanBundle:User u WHERE 
                  u.categorie LIKE :categorie'
            )->setParameter('categorie', '%culture%'
            );
        $users = $query->getResult();
        $em = $this->getDoctrine()->getManager();
        $NombreUser = $em->getRepository('BonPlanBundle:User');
        $nb = $NombreUser->culture();



        return $this->render('@BonPlan/Default/Categorie/CategorieCulture.html.twig', array('cultures' => $users , 'nb' =>$nb ));
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
        $em = $this->getDoctrine()->getManager();
        $NombreUser = $em->getRepository('BonPlanBundle:User');
        $nb = $NombreUser->restaurant();



        return $this->render('@BonPlan/Default/Categorie/CategorieRestaurant.html.twig', array('restau' => $users , 'nb' =>$nb ));
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
        $em = $this->getDoctrine()->getManager();
        $NombreUser = $em->getRepository('BonPlanBundle:User');
        $nb = $NombreUser->hotel();



        return $this->render('@BonPlan/Default/Categorie/CategorieHotels.html.twig', array('hotels' => $users , 'nb' =>$nb ));
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
        $em = $this->getDoctrine()->getManager();
        $NombreUser = $em->getRepository('BonPlanBundle:User');
        $nb = $NombreUser->nightlife();



        return $this->render('@BonPlan/Default/Categorie/CategorieNightlife.html.twig', array('nightlife' => $users , 'nb' =>$nb ));
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
        $em = $this->getDoctrine()->getManager();
        $NombreUser = $em->getRepository('BonPlanBundle:User');
        $nb = $NombreUser->coffee();



        return $this->render('@BonPlan/Default/Categorie/CategorieCoffee.html.twig', array('coffees' => $users , 'nb' =>$nb ));
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
    public function ConsulterAction(Request $request,$id)
    {
        {
            $search =$request->get('promotion');
            $en = $this->getDoctrine()->getManager();
            $promotion=$en->getRepository("BonPlanBundle:Promotion")->findByuser($search);
            return $this->render("BonPlanBundle:Default:ProfilPlan.html.twig",array(
                'promo' => $promotion));
        }
    }
<<<<<<< HEAD
    public function ConsulterPAction($id,Request $request)
=======
    public function ConsulterPAction(Request $request,$id)
>>>>>>> 98c1bff408d5bf6b674b2043121740432770b49e
    {
        $idreclam = $id;
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository(User::class)->findById($id);
<<<<<<< HEAD
        $avis = new Avis();
        $form = $this->createForm(AjouterCommentaire::class, $avis);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {

            $avis->setUserVisiteur($this->getUser());
            $avis->setUserPlan($users[0]);
            $avis->setDatecomment(new \DateTime('now'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($avis);
            $em->flush();

        }
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $plan = $this->getDoctrine()->getManager()->getRepository('BonPlanBundle:Abonner')->findOneBy(array('userVisiteur' => $this->getUser()->getId()));
            return $this->render('BonPlanBundle:Default:ProfilPlan.html.twig', array(
                'users_consult'=>$users,'plan' => $plan , 'idreclam'=>$idreclam));

        }
        $search =$request->get('promotion');
        $en = $this->getDoctrine()->getManager();
        $promotion=$en->getRepository("BonPlanBundle:Promotion")->findByuser($users[0]);

        return $this->render('BonPlanBundle:Default:ProfilPlan.html.twig', array(
            'users_consult'=>$users,'plan' => null,'form'=>$form->createView(),'promo' => $promotion
=======
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
>>>>>>> 98c1bff408d5bf6b674b2043121740432770b49e
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
<<<<<<< HEAD
    public function RechercheKbiraAction(Request $request)
    {
        $search =$request->query->get('user');
        $en = $this->getDoctrine()->getManager();
        $user=$en->getRepository("BonPlanBundle:User")->findPlan($search);
        return $this->render("BonPlanBundle:Default:ConsulterP.html.twig",array(
            'plans' => $user
        ));}
=======

>>>>>>> 98c1bff408d5bf6b674b2043121740432770b49e
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
<<<<<<< HEAD
        $g=$em->getRepository('BonPlanBundle:User')->nombreVisiteur();
        $a=$em->getRepository('BonPlanBundle:User')->nombrePlan();

        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable(
            [['Task', '$a'],
                ['Nombres des VISITEURS en Pourcentage' , ($g *100)/$a]  ,
                ['Nombres des PLANS en Pourcentage', ((($a-$g)-1)*100)/$a]
            ]
        );
        $pieChart->getOptions()->setTitle('Pourcentage des plans et des Visiteurs');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(600);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        return $this->render('BonPlanBundle:Default:Acceuilback.html.twig', array('piechart' => $pieChart));
=======
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
>>>>>>> 98c1bff408d5bf6b674b2043121740432770b49e
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



<<<<<<< HEAD



=======
=======
>>>>>>> 2fc00991a238d4670f325c3fd33b98e2396eb468
>>>>>>> 98c1bff408d5bf6b674b2043121740432770b49e
}
