<?php

namespace BonPlanBundle\Controller;

use BonPlanBundle\Entity\Categorie;
use BonPlanBundle\Entity\User;
use BonPlanBundle\Form\ProfileType;
use BonPlanBundle\Form\VisiteurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


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
    public function ConsulterAction()
    {
        return $this->render('BonPlanBundle:Default:Consulter.html.twig');
    }
    public function ConsulterPAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository(User::class)->findById($id);
        return $this->render('BonPlanBundle:Default:ProfilPlan.html.twig', array(
            'users_consult'=>$users
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
        return $this->render('BonPlanBundle:Default:Acceuilback.html.twig');
    }
    public function CategorierestauAction()
    {
        return $this->render('@BonPlan/Default/CategorieRestaurant.html.twig');
    }



}
