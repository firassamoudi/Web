<?php

namespace BonPlanBundle\Controller;

use BonPlanBundle\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BonPlanBundle\Form\ReservationPropType;
use BonPlanBundle\Entity\Reservation;
use BonPlanBundle\Entity\User;


class ReservationController extends Controller
{



    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    function afficherReservationVisiteurAction(){

        $this->denyAccessUnlessGranted("ROLE_VISITEUR");
        $em = $this->getDoctrine()->getManager();
            $reservation = $em->getRepository('BonPlanBundle:Reservation')->findByuserV($this->getUser()->getId());
            return $this->render('BonPlanBundle:Reservation:ReservationVisiteur.html.twig', array("reservations"=>$reservation));


    }
    function afficherReservationPropAction(){

        $this->denyAccessUnlessGranted("ROLE_PROP");
        $em = $this->getDoctrine()->getManager();
        $reservation = $em->getRepository('BonPlanBundle:Reservation')->findByuserP($this->getUser()->getId());
        return $this->render('BonPlanBundle:Reservation:ReservationProp.html.twig', array("reservations"=>$reservation));


    }

    function supprimerReservationVisiteurAction($id){
        $this->denyAccessUnlessGranted("ROLE_VISITEUR");

        $em=$this->getDoctrine()->getManager();
        $reservation=$em->getRepository("BonPlanBundle:Reservation")->find($id);

        $em->remove($reservation);
        $em->flush();
        return $this->redirectToRoute('ReservationVisiteur');

    }

    function updateReservationVisiteurAction(Request $request,$id){
        $this->denyAccessUnlessGranted("ROLE_VISITEUR");

        $em=$this->getDoctrine()->getManager();
        $modele=$em->getRepository("BonPlanBundle:Reservation")->find($id);

        $form=$this->createForm(ReservationType::class,$modele);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($modele);
            $em->flush();
            $message = \Swift_Message::newInstance()
                ->setSubject('validation de votre réservation')
                ->setFrom(array('hayawin2@gmail.com'=>'haya win'))
                ->setTo('hayawin2@gmail.com')
                ->setBody('test');
            $this->get('mailer')->send($message);
            return $this->redirectToRoute('ReservationVisiteur');

        }
        return $this->render('BonPlanBundle:Reservation:UpdateReservationVisiteur.html.twig',
            array("form"=>$form->createView()));

    }

    function updateReservationPropAction(Request $request,$id){
        $this->denyAccessUnlessGranted("ROLE_PROP");

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
    function ajoutReservationAction(Request $request,$id){

        if ($request->isMethod('POST')){
            $modele=new Reservation();

            $modele->setNbrplace($request->get('nbrplace'));
            $modele->setDate($request->get('dateReservation'));
            $modele->setEtat('en cours');
            $modele->setHeure($request->get('heure'));
            $modele->setTelephone($request->get('telephone'));
            $modele->setUserVisiteur($request->get('userConnecté'));
            $modele->setUserPlan($request->get('Plan'));

            $em=$this->getDoctrine()->getManager();
            $em->persist($modele);
            $em->flush();
            return $this->redirectToRoute('AjoutReservation');
        }
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository(User::class)->findById($id);
        return $this->render('BonPlanBundle:Default:ProfilPlan.html.twig',
            array('users_consult'=>$users));
    }
}
