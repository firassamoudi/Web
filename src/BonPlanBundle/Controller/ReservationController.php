<?php

namespace BonPlanBundle\Controller;

use BonPlanBundle\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BonPlanBundle\Form\ReservationPropType;
use BonPlanBundle\Entity\Reservation;
use BonPlanBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;

class ReservationController extends Controller
{


    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    function afficherReservationVisiteurAction()
    {

        $em = $this->getDoctrine()->getManager();
        $reservation = $em->getRepository('BonPlanBundle:Reservation')->findByuserV($this->getUser()->getId());
        return $this->render('BonPlanBundle:Reservation:ReservationVisiteur.html.twig', array("reservations" => $reservation));


    }


    function notifAction(Request $request){
        if ($_POST['view'] != '') {

            $em = $this->getDoctrine()->getManager();
            $em->getRepository('BonPlanBundle:Reservation')
                ->Updatenotif($this->getUser());
        }

        if ($request->isXmlHttpRequest()) {
            $emm = $this->getDoctrine()->getManager();
            $result = $emm->getRepository('BonPlanBundle:Reservation')->findByNotig($this->getUser()->getId());

            $output = '';
            if ($result) {
                foreach ($result as $row) {

                    $output .= '
                      <li>
                      <a href="#">
                      <small><h5>Nouvelle réservation </h5></small>
                      <small>téléphone :<em>' . $row['telephone'] . '</em></small><br>
                       <small>état :<em>' . $row['etat'] . '</em></small><br>
                        <small> Nombre Place: <em>' . $row['nbrplace'] . '</em></small><br>
                    
                      </a>
                      </li>
                    
                      ';
                }
            } else {
                $output .= '<li><a href="#" class="text-bold text-italic">pas de notifications</a></li>';
            }
            $em = $this->getDoctrine()->getManager();
            $reser = $em->getRepository('BonPlanBundle:Reservation')->findByNotig($this->getUser()->getId());
            $count = count($reser);

            $data = array(
                'notification' => $output,
                'unseen_notification' => $count
            );
            return new Response(json_encode($data));
        }

        $emm = $this->getDoctrine()->getManager();
        $reservation = $emm->getRepository('BonPlanBundle:Reservation')->findByuserP($this->getUser()->getId());
        return $this->render('BonPlanBundle:Reservation:ReservationProp.html.twig', array("reservations" => $reservation));

    }

    function afficherReservationPropAction()
    {


        $emm = $this->getDoctrine()->getManager();
        $reservation = $emm->getRepository('BonPlanBundle:Reservation')->findByuserP($this->getUser()->getId());
        return $this->render('BonPlanBundle:Reservation:ReservationProp.html.twig', array("reservations" => $reservation));
    }





    function afficherReservationVisiteurMobileAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $reservation = $em->getRepository('BonPlanBundle:Reservation')->findByuserV($id);
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($reservation);
        return new JsonResponse($formatted);

    }
    function AjoutReservationVisiteurMobileAction(Request $request)
    {

        $modele=new Reservation();
        $modele->setNbrplace($request->get('nbrplace'));
        $modele->setDate(new \DateTime($request->get('datereservation')));
        $modele->setHeure(new \DateTime($request->get('heure')));
        $modele->setEtat('en cours');
        $modele->setTelephone($request->get('telephone'));
        //   $modele->setUserVisiteur($request->get('Visiteur'));
        $em = $this->getDoctrine()->getManager();

        $visiteur = $em->getRepository(User::class)->findById($request->get('Visiteur'));
        $modele->setUserVisiteur($visiteur[0]);
        $modele->setNotif('0');
        $modele->setDescription(' ');
        $Plan = $em->getRepository(User::class)->findById($request->get('Plan'));

        $modele->setUserPlan($Plan[0]);
        $emm=$this->getDoctrine()->getManager();
        $emm->persist($modele);
        $emm->flush();
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($modele);
        return new JsonResponse($formatted);

    }

    function supprimerReservationVisiteurAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $reservation = $em->getRepository("BonPlanBundle:Reservation")->find($id);

        $em->remove($reservation);
        $em->flush();
        return $this->redirectToRoute('ReservationVisiteur');

    }

    function updateReservationVisiteurAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $modele = $em->getRepository("BonPlanBundle:Reservation")->find($id);

        $form = $this->createForm(ReservationType::class, $modele);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($modele);
            $em->flush();
            $message = \Swift_Message::newInstance()
                ->setSubject('validation de votre réservation')
                ->setFrom(array('hayawin2@gmail.com' => 'haya win'))
                ->setTo('hayawin2@gmail.com')
                ->setBody('test');
            $this->get('mailer')->send($message);
            return $this->redirectToRoute('ReservationVisiteur');

        }
        return $this->render('BonPlanBundle:Reservation:UpdateReservationVisiteur.html.twig',
            array("form" => $form->createView()));

    }

    function updateReservationPropAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $modele = $em->getRepository("BonPlanBundle:Reservation")->find($id);

        $form = $this->createForm(ReservationPropType::class, $modele);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($modele);
            $em->flush();
            return $this->redirectToRoute('ReservationProp');

        }
        return $this->render('BonPlanBundle:Reservation:UpdateReservationProp.html.twig',
            array("form" => $form->createView()));

    }

    function ajoutReservationAction(Request $request, $id)
    {

        if ($request->isMethod('POST')) {
            $modele = new Reservation();

            $modele->setNbrplace($request->get('nbrplace'));
            $modele->setDate($request->get('dateReservation'));
            $modele->setEtat('en cours');
            $modele->setHeure($request->get('heure'));
            $modele->setTelephone($request->get('telephone'));
            $modele->setUserVisiteur($request->get('userConnecté'));
            $modele->setUserPlan($request->get('Plan'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($modele);
            $em->flush();
            return $this->redirectToRoute('AjoutReservation');
        }
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository(User::class)->findById($id);
        return $this->render('BonPlanBundle:Default:ProfilPlan.html.twig',
            array('users_consult' => $users));
    }
}