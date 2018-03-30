<?php

namespace BonPlanBundle\Controller;

use BonPlanBundle\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BonPlanBundle\Form\ReservationPropType;


class ReservationController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    function afficherReservationVisiteurAction(){


        $em = $this->getDoctrine()->getManager();
            $reservation = $em->getRepository('BonPlanBundle:Reservation')->findByuserV($this->getUser()->getId());
            return $this->render('BonPlanBundle:Reservation:ReservationVisiteur.html.twig', array("reservations"=>$reservation));


    }
    function afficherReservationPropAction(){


        $em = $this->getDoctrine()->getManager();
        $reservation = $em->getRepository('BonPlanBundle:Reservation')->findByuserV($this->getUser()->getId());
        return $this->render('BonPlanBundle:Reservation:ReservationProp.html.twig', array("reservations"=>$reservation));


    }

    function supprimerReservationVisiteurAction($id){

        $em=$this->getDoctrine()->getManager();
        $reservation=$em->getRepository("BonPlanBundle:Reservation")->find($id);

        $em->remove($reservation);
        $em->flush();
        return $this->redirectToRoute('ReservationVisiteur');

    }

    function updateReservationVisiteurAction(Request $request,$id){

        $em=$this->getDoctrine()->getManager();
        $modele=$em->getRepository("BonPlanBundle:Reservation")->find($id);

        $form=$this->createForm(ReservationType::class,$modele);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($modele);
            $em->flush();
            return $this->redirectToRoute('ReservationVisiteur');

        }
        return $this->render('BonPlanBundle:Reservation:UpdateReservationVisiteur.html.twig',
            array("form"=>$form->createView()));

    }
    function updateReservationPropAction(Request $request,$id){

        $em=$this->getDoctrine()->getManager();
        $modele=$em->getRepository("BonPlanBundle:Reservation")->find($id);

        $form=$this->createForm(ReservationPropType::class,$modele);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($modele);
            $em->flush();
            return $this->redirectToRoute('ReservationProp');

        }
        return $this->render('BonPlanBundle:Reservation:UpdateReservationProp.html.twig',
            array("form"=>$form->createView()));

    }
}
