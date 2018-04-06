<?php

namespace BonPlanBundle\Controller;

use BonPlanBundle\Entity\Categorie;
use BonPlanBundle\Form\UpdateCateg;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

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
            $event->upload();
            $em->persist($event);
            $em->flush();
            return $this->redirectToRoute("Categorie_admin");
        }

        return $this->render('BonPlanBundle:Default/Categorie:Ajouter_Categorie.html.twig', array(
            "form"=>$form->createView()
        ));
    }

    public function CategSuppAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $categories=$em->getRepository("BonPlanBundle:Categorie")->find($id);
        $em->remove($categories);
        $em->flush();
        return $this->redirectToRoute('Categorie_admin');
    }

    public function CategUpdateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository(Categorie::class)->findOneBy(array('id'=>$request->get('id')));
        $form = $this->createForm(UpdateCateg::class, $categorie);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $categorie->upload();
            $em->persist($categorie);
            $em->flush();
            return $this->redirectToRoute('Categorie_admin');
        }
        return new JsonResponse(array('html' => $this->renderView('BonPlanBundle:Default/Categorie:Modifier_Categorie.html.twig', array(
            "edit_form" => $form->createView()
        ))));
    }

    public function CategorieAAction()
    {
        $events=new Categorie();
        $em=$this->getDoctrine()->getManager();
        $events=$em->getRepository(Categorie::class)->findAll();
        return $this->render('BonPlanBundle:Default/Categorie:CategorieAdmin.html.twig', array(
            'events'=>$events
        ));
    }

    private function createEditForm(Categorie $categorie)
    {
        $form = $this->createForm(new \BonPlanBundle\Form\Categorie(), $categorie, array(
            'action' => $this->generateUrl('modifier_Categorie_admin', array('id' => $categorie->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
}
