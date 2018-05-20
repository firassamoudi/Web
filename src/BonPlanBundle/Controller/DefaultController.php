<?php

namespace BonPlanBundle\Controller;

use BonPlanBundle\Entity\Avis;
use BonPlanBundle\Entity\Categorie;
use BonPlanBundle\Entity\User;
use BonPlanBundle\Entity\Reservation;
use BonPlanBundle\Form\AjouterCommentaire;
use BonPlanBundle\Form\ProfileType;
use BonPlanBundle\Form\VisiteurType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use BonPlanBundle\Entity\Rate;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class DefaultController extends Controller
{

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

        public function CategorieRestauAction($id) {

        $em=$this->getDoctrine()->getManager();
        $plans= $em->getRepository(User::class)->findbyCategorie($id);
        $NombreUser = $em->getRepository('BonPlanBundle:User');
        $cat=$em->getRepository(Categorie::class)->getnomcat($id);

        $nb = $NombreUser->restaurant($id);

        return $this->render('BonPlanBundle:Default/Categorie:CategorieRestaurant.html.twig', array(
            'restau'=>$plans,'nb'=>$nb,'cat'=>$cat));


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
        $categ=9;
        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery(
                'SELECT u FROM BonPlanBundle:User u WHERE 
                  u.categorie LIKE :categorie'
            )->setParameter('categorie', $categ
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
        $this->denyAccessUnlessGranted("ROLE_ADMIN");

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
    public function ConsulterPAction($id,Request $request)
    {
        $idreclam = $id;
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository(User::class)->findById($id);
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
    public function RechercheKbiraAction(Request $request)
    {
        $search =$request->query->get('user');
        $en = $this->getDoctrine()->getManager();
        $user=$en->getRepository("BonPlanBundle:User")->findPlan($search);
        return $this->render("BonPlanBundle:Default:ConsulterP.html.twig",array(
            'plans' => $user
        ));}
    public function indexAdminAction()
    {
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


        $em = $this->getDoctrine()->getManager();
        $g=$em->getRepository('BonPlanBundle:User')->nombreVisiteur();
        $nb=$em->getRepository('BonPlanBundle:User')->nombrePlan();

        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable(
            [['Task', '$a'],
                ['Nombres des VISITEURS en Pourcentage' , ($g *100)/$nb]  ,
                ['Nombres des PLANS en Pourcentage', ((($nb-$g)-1)*100)/$nb]
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

        return $this->render('BonPlanBundle:Default:Acceuilback.html.twig', array('piechart' => $pieChart,'nombre' => $nb));

    }






}
