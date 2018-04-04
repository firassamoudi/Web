<?php

namespace BonPlanBundle\Controller;

use BonPlanBundle\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BonPlanBundle\Form\ReservationPropType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class ReservationController extends Controller
{

    /**
     * @Route("/send-notification", name="send_notification")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Exception
     */
    public function sendNotification(Request $request)
    {


        
        $manager = $this->get('mgilet.notification');
        $notif = $manager->createNotification('Hello world !');
        $notif->setMessage('This a notification.');
        $notif->setLink('http://symfony.com/');
        // or the one-line method :
        // $manager->createNotification('Notification subject','Some random text','http://google.fr');

        // you can add a notification to a list of entities
        // the third parameter ``$flush`` allows you to directly flush the entities
        $manager->addNotification(array($this->getUser()), $notif, true);

        return $this->redirectToRoute('homepage');
    }
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
}
