<?php

namespace BonPlanBundle\Controller;

use BonPlanBundle\Entity\Categorie;
use BonPlanBundle\Form\UpdateCateg;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class CategorieController extends Controller
{

    public function allAction(Request $request)
    {
        $users = $this->getDoctrine()->getManager()
            ->getRepository('BonPlanBundle:Categorie')
            ->findAll();
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($users);
        return new JsonResponse($formatted);
    }

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
<<<<<<< HEAD
        $categorie = $em->getRepository(Categorie::class)->findOneBy(array('id'=>$request->get('id')));
        $form = $this->createForm(UpdateCateg::class,$categorie);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em=$this->getDoctrine()->getManager();
            $categorie->upload();
            $em->persist($categorie);
            $em->flush();
            return $this->redirectToRoute('Categorie_admin');
        }
        return $this->render('BonPlanBundle:Default/Categorie:Modifier_Categorie.html.twig', array(
            "edit_form" => $form->createView(),
            "Categories"=>$categorie
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
=======
        $categ = $em->getRepository(Categorie::class)->findOneBy(array('id'=>$request->get('id')));
        $form = $this->createForm(UpdateCateg::class,$categ);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em=$this->getDoctrine()->getManager();
            $em->persist($categ);
            $em->flush();
            return $this->redirectToRoute('Categorie_admin');
        }
        return new JsonResponse(array('html' => $this->renderView('BonPlanBundle:Default/Categorie:Modifier_Categorie.html.twig', array(
            "edit_form" => $form->createView(),
            "Categories"=>$categ
        ))));
    }

>>>>>>> 1c4d0f271342a3deebb8766ad8e9dbb8d20e4b6e
    public function CategorieAAction(Request $request)
    {
        $events=new Categorie();
        $em=$this->getDoctrine()->getManager();
        $events=$em->getRepository(Categorie::class)->findAll();
        $categ = $em->getRepository(Categorie::class)->findOneBy(array('id'=>$request->get('id')));
        $form = $this->createForm(UpdateCateg::class,$categ);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em=$this->getDoctrine()->getManager();
            $em->persist($categ);
            $em->flush();
            return $this->redirectToRoute('Categorie_admin');
        }
<<<<<<< HEAD
=======
        $form->handleRequest($request);
>>>>>>> 1c4d0f271342a3deebb8766ad8e9dbb8d20e4b6e
        return $this->render('BonPlanBundle:Default/Categorie:CategorieAdmin.html.twig', array(
            'events'=>$events,"edit_form" => $form->createView(),"Categories"=>$categ
        ));
    }

}
