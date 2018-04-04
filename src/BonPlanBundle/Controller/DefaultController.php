<?php

namespace BonPlanBundle\Controller;

use BonPlanBundle\Entity\User;
use BonPlanBundle\Form\ProfileType;
use BonPlanBundle\Form\VisiteurType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BonPlanBundle:Default:index.html.twig');
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
    public function ConsulterPAction()
    {
        return $this->render('BonPlanBundle:Default:ProfilPlan.html.twig');
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
