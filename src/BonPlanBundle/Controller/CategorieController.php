<?php

namespace BonPlanBundle\Controller;

use BonPlanBundle\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategorieController extends Controller
{
    public function CategAjoutAction(Request $request)
    {
        $event = new Categorie();
        $form=$this->createForm(\BonPlanBundle\Form\Categorie::class,$event);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            //return $this->redirectToRoute("afficher");
        }

        return $this->render('BonPlanBundle:Default/Categorie:Ajouter_Categorie.html.twig', array(
            "form"=>$form->createView()
        ));
    }

    public function CategorieAAction()
    {
        return $this->render('BonPlanBundle:Default/Categorie:CategorieAdmin.html.twig');
    }
}
