<?php

namespace BonPlanBundle\Controller;

use BonPlanBundle\Entity\Avis;
use BonPlanBundle\Entity\Categorie;
use BonPlanBundle\Entity\User;
use BonPlanBundle\Form\AjouterCommentaire;
use BonPlanBundle\Form\ProfileType;
use BonPlanBundle\Form\VisiteurType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;



class DefaultController extends Controller
{
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
    public function ConsulterPAction($id,Request $request)
    {
        $idreclam = $id;
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository(User::class)->findById($id);
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
        ));
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
        $this->denyAccessUnlessGranted("ROLE_ADMIN");

        $em = $this->getDoctrine()->getManager();
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
    }






}
