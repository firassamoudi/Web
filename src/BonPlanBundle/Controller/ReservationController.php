<?php

namespace BonPlanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReservationController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    function afficherReservationVisiteurAction(){
        $em= $this->getDoctrine()->getManager();
        $reservation = $em->getRepository("BonPlanBundle:Reservation")->findAll();

        return $this->render('BonPlanBundle::ReservationVisiteur.html.twig',array("reservations"=>$reservation));

    }
}
