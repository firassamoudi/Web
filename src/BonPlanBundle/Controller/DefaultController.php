<?php

namespace BonPlanBundle\Controller;

use BonPlanBundle\Entity\Avis;
use BonPlanBundle\Entity\Categorie;
use BonPlanBundle\Entity\Reservation;
use BonPlanBundle\Entity\User;
<<<<<<< HEAD
use BonPlanBundle\Entity\Reservation;
=======
>>>>>>> 1c4d0f271342a3deebb8766ad8e9dbb8d20e4b6e
use BonPlanBundle\Form\AjouterCommentaire;
use BonPlanBundle\Form\ProfileType;
use BonPlanBundle\Form\RechercheType;
use BonPlanBundle\Form\VisiteurType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
<<<<<<< HEAD
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use BonPlanBundle\Entity\Rate;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
=======
<<<<<<< HEAD
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
>>>>>>> 1c4d0f271342a3deebb8766ad8e9dbb8d20e4b6e


=======
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
>>>>>>> 98c1bff408d5bf6b674b2043121740432770b49e

class DefaultController extends Controller
{

<<<<<<< HEAD
    public function maxIdAction()
    {
        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery('SELECT MAX(u) FROM BonPlanBundle:User u');
        $users = $query->getResult();
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($users);
        return new JsonResponse($formatted);
    }

    public function loginAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $user=$em->getRepository("BonPlanBundle:User")->findOneBy(['username' =>$request->get('username')]);
        if($user){
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $salt = $user->getSalt();
            if($encoder->isPasswordValid($user->getPassword(),$request->get('password'), $salt)||$user->getPassword()==$request->get('password')){
                $serializer=new Serializer([new ObjectNormalizer()]);
                $formatted=$serializer->normalize($user);
                return new JsonResponse($formatted);
            }
        }
        return new JsonResponse("Failed");

    }

    public function registerPropMobileAction(Request $request){

        $em=$this->getDoctrine()->getManager();
        $user=new User();
        $user->setUsername($request->get('username'));
        $user->setEmail($request->get('email'));
        $user->setPassword($request->get('password'));
        $roleArray=  array  ($request->get('roles'));
        $user->setRoles($roleArray);
        $user->setNomPlan($request->get('nomPlan'));
        $user->setAdresse($request->get('adresse'));
        $user->setTelephone($request->get('telephone'));
        $user->setDescription($request->get('description'));
        $user->setLatitude(doubleval($request->get('latitude')));
        $user->setLongitude(doubleval($request->get('longitude')));
        $categorie=$em->getRepository(Categorie::class)->findOneBy(array('nomCategorie'=>$request->get('nomCategorie')));
        $user->setCategorie($categorie);
        $em->persist($user);
        $em->flush();

        return new JsonResponse("Success");

    }
    public function registerMobileAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $user=new User();
        $user->setUsername($request->get('username'));


        $user->setEmail($request->get('email'));
        $user->setPassword($request->get('password'));
 //       $user->setNomVisiteur($request->get('nomVisiteur'));
//        $user->setPrenomVisiteur($request->get('prenomVisiteur'));
 //       $user->setPhotodeprofil($request->get('photodeprofil'));
//        $user->setVille($request->get('ville'));


        $roleArray=  array  ($request->get('roles'));
        $user->setRoles($roleArray);

        $em->persist($user);
        $em->flush();
        return new JsonResponse("Success");
    }

    public function findAction($id){
        $em=$this->getDoctrine()->getManager()
            ->getRepository('BonPlanBundle:User')->findBy(array('id'=>$id));
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($em);
        return new JsonResponse($formatted);
    }

    public function allAction()
    {
        $em=$this->getDoctrine()->getManager();
        $users=$em->getRepository('BonPlanBundle:User')->findAll();
        $data=array();
        foreach ($users as $u)
        {
            if (in_array('ROLE_PROP',$u->getRoles()))
            {
                $i=["id"=>$u->getId(),"description"=>$u->getDescription(),"nomPlan"=>$u->getNomPlan(),"photodeprofil"=>$u->getPhotodeprofil()];
                array_push($data,$i);
            }
        }
        return new JsonResponse($data);
    }

    public function indexAction()
=======
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
>>>>>>> 1c4d0f271342a3deebb8766ad8e9dbb8d20e4b6e
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
<<<<<<< HEAD

        public function CategorieRestauAction($id) {

        $em=$this->getDoctrine()->getManager();
        $plans= $em->getRepository(User::class)->findbyCategorie($id);
        $NombreUser = $em->getRepository('BonPlanBundle:User');
        $cat=$em->getRepository(Categorie::class)->getnomcat($id);

        $nb = $NombreUser->restaurant($id);

        return $this->render('BonPlanBundle:Default/Categorie:CategorieRestaurant.html.twig', array(
            'restau'=>$plans,'nb'=>$nb,'cat'=>$cat));


    }



=======
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

>>>>>>> 1c4d0f271342a3deebb8766ad8e9dbb8d20e4b6e
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
<<<<<<< HEAD
        $categ=9;
=======
>>>>>>> 1c4d0f271342a3deebb8766ad8e9dbb8d20e4b6e
        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery(
                'SELECT u FROM BonPlanBundle:User u WHERE 
                  u.categorie LIKE :categorie'
<<<<<<< HEAD
            )->setParameter('categorie', $categ
=======
            )->setParameter('categorie', '%coffee%'
>>>>>>> 1c4d0f271342a3deebb8766ad8e9dbb8d20e4b6e
            );
        $users = $query->getResult();
        $em = $this->getDoctrine()->getManager();
        $NombreUser = $em->getRepository('BonPlanBundle:User');
        $nb = $NombreUser->coffee();
<<<<<<< HEAD
=======



>>>>>>> 1c4d0f271342a3deebb8766ad8e9dbb8d20e4b6e
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
        $categorie=$em->getRepository(Categorie::class)->findAll();
        if ($request->isMethod('POST')) {
            $user->setAdresse($request->get('adresse'));
            $user->setNomPlan($request->get('nomPlan'));
            $user->setDescription($request->get('description'));
            $user->setLatitude($request->get('latitude'));
            $user->setLongitude($request->get('longitude'));
            $user->setTelephone($request->get('telephone'));
            $user->setValidite(0);
            $categorie=$em->getRepository(Categorie::class)->findOneBy(array('nomCategorie'=>$request->get('categorie')));
            $user->setCategorie($categorie);
            $user->setPhotodeprofil($request->get('photoProfil'));
            $user->upload();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('bon_plan_homepage');

        }

        return $this->render('BonPlanBundle:Default:AjouterP.html.twig', array('categ'=>$categorie));
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
<<<<<<< HEAD
    public function ConsulterPAction($id,Request $request)
=======
    public function ConsulterPAction(Request $request,$id)
>>>>>>> 98c1bff408d5bf6b674b2043121740432770b49e
>>>>>>> 1c4d0f271342a3deebb8766ad8e9dbb8d20e4b6e
    {
        $idreclam = $id;
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository(User::class)->findById($id);
<<<<<<< HEAD
        $avis = new Avis();
        $form = $this->createForm(AjouterCommentaire::class, $avis);
        $form->handleRequest($request);
        $search =$request->get('promotion');
        $promotion=$em->getRepository("BonPlanBundle:Promotion")->findByuser($users[0]);


        if ($this->getUser()==null){
            return $this->render('BonPlanBundle:Default:ProfilPlan.html.twig', array(
                'users_consult'=>$users,'form'=>$form->createView(),'promo' => $promotion));
        }else{
            if($form->isSubmitted())
            {
                $avis->setUserVisiteur($this->getUser());
                $avis->setUserPlan($users[0]);
                $avis->setDatecomment(new \DateTime('now'));
                $em = $this->getDoctrine()->getManager();
                $em->persist($avis);
                $em->flush();
            }
            if ($request->isMethod('POST')){
                $modele=new Reservation();
                $modele->setNbrplace($request->get('nbrplace'));
                $modele->setDate(new \DateTime($request->get('dateReservation')));
                $modele->setHeure(new \DateTime($request->get('heure')));
                $modele->setEtat('en cours');
                $modele->setTelephone($request->get('telephone'));
                $modele->setUserVisiteur($this->getUser());
                $modele->setNotif('0');
                $modele->setUserPlan($users['0']);
                $emm=$this->getDoctrine()->getManager();
                $emm->persist($modele);
                $emm->flush();
                $plan = $this->getDoctrine()->getManager()->getRepository('BonPlanBundle:Abonner')->findOneBy(array('userVisiteur' => $this->getUser()->getId()));
                return $this->render('BonPlanBundle:Default:ProfilPlan.html.twig', array(
                    'users_consult'=>$users,'form'=>$form->createView(),'promo' => $promotion,"rating" => $form->createView(), 'idreclam'=>$idreclam,'plan' => $plan
                ));
            }
                $event = new Rate();
                $form=$this->createForm(\BonPlanBundle\Form\RatingType::class,$event);
                $form->handleRequest($request);
                if($form->isSubmitted())
                {
                    $em=$this->getDoctrine()->getManager();
                    $em->persist($event);
                    $em->flush();
                    $plan = $this->getDoctrine()->getManager()->getRepository('BonPlanBundle:Abonner')->findOneBy(array('userVisiteur' => $this->getUser()->getId()));

                    return $this->render('BonPlanBundle:Default:ProfilPlan.html.twig', array(
                        'users_consult'=>$users,'form'=>$form->createView(),'promo' => $promotion,"rating" => $form->createView(), 'idreclam'=>$idreclam,'plan' => $plan
                    ));
                }

                if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
                        $plan = $this->getDoctrine()->getManager()->getRepository('BonPlanBundle:Abonner')->findOneBy(array('userVisiteur' => $this->getUser()->getId()));
                        return $this->render('BonPlanBundle:Default:ProfilPlan.html.twig', array(
                            'users_consult'=>$users,'form'=>$form->createView(),'promo' => $promotion,"rating" => $form->createView(), 'idreclam'=>$idreclam,'plan' => $plan
                        ));
                        }
                    $plan = $this->getDoctrine()->getManager()->getRepository('BonPlanBundle:Abonner')->findOneBy(array('userVisiteur' => $this->getUser()->getId()));
                    return $this->render('BonPlanBundle:Default:ProfilPlan.html.twig', array(
                        'users_consult'=>$users,'form'=>$form->createView(),'promo' => $promotion,"rating" => $form->createView(), 'idreclam'=>$idreclam,'plan' => $plan
                ));
        }

    }
=======
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
>>>>>>> 1c4d0f271342a3deebb8766ad8e9dbb8d20e4b6e
    public function RechercheKbiraAction(Request $request)
    {
        $search =$request->query->get('user');
        $en = $this->getDoctrine()->getManager();
        $user=$en->getRepository("BonPlanBundle:User")->findPlan($search);
        return $this->render("BonPlanBundle:Default:ConsulterP.html.twig",array(
            'plans' => $user
        ));}
<<<<<<< HEAD
=======
=======

>>>>>>> 98c1bff408d5bf6b674b2043121740432770b49e
>>>>>>> 1c4d0f271342a3deebb8766ad8e9dbb8d20e4b6e
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


        $em = $this->getDoctrine()->getManager();
        $g=$em->getRepository('BonPlanBundle:User')->nombreVisiteur();
        $nb=$em->getRepository('BonPlanBundle:User')->nombrePlan();
=======
<<<<<<< HEAD
       // $this->denyAccessUnlessGranted("ROLE_ADMIN");
=======
        $this->denyAccessUnlessGranted("ROLE_ADMIN");

        $em = $this->getDoctrine()->getManager();
<<<<<<< HEAD
        $g=$em->getRepository('BonPlanBundle:User')->nombreVisiteur();
        $a=$em->getRepository('BonPlanBundle:User')->nombrePlan();
>>>>>>> 1c4d0f271342a3deebb8766ad8e9dbb8d20e4b6e

        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable(
            [['Task', '$a'],
<<<<<<< HEAD
                ['Nombres des VISITEURS en Pourcentage' , ($g *100)/$nb]  ,
                ['Nombres des PLANS en Pourcentage', ((($nb-$g)-1)*100)/$nb]
=======
                ['Nombres des VISITEURS en Pourcentage' , ($g *100)/$a]  ,
                ['Nombres des PLANS en Pourcentage', ((($a-$g)-1)*100)/$a]
>>>>>>> 1c4d0f271342a3deebb8766ad8e9dbb8d20e4b6e
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

<<<<<<< HEAD
        return $this->render('BonPlanBundle:Default:Acceuilback.html.twig', array('piechart' => $pieChart,'nombre' => $nb));
=======
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
>>>>>>> 1c4d0f271342a3deebb8766ad8e9dbb8d20e4b6e

    }



<<<<<<< HEAD



=======
<<<<<<< HEAD



=======
=======
>>>>>>> 2fc00991a238d4670f325c3fd33b98e2396eb468
>>>>>>> 98c1bff408d5bf6b674b2043121740432770b49e
>>>>>>> 1c4d0f271342a3deebb8766ad8e9dbb8d20e4b6e
}
