<?php

namespace BonPlanBundle\Controller;

use BonPlanBundle\Entity\Events;
use BonPlanBundle\Form\EventsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class EventsController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));}

        public function addEventAction(Request $request)
    {
        //$usr = $this->getUser()->getRole();
        //  $authChecker = $this->container->get('security.authorization_checker');
        // if (($authChecker->isGranted('ROLE_PROPRIETAIRE')))
        {   $this->denyAccessUnlessGranted("ROLE_PROP");
            $ev= new Events();
            $user = $this->getUser();


            $form = $this->createForm(EventsType::class, $ev);
            $form->handleRequest($request);
            $session = new Session();
            $ev->setUserPlan($this->getUser());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($ev);

                $em->flush();
                $session->getFlashBag()->add('success', 'evenement ajouté avec succes');
                return $this->redirect($this->generateUrl('EventProp_consult'));
            }
            return $this->render('BonPlanBundle:Default/Events:AjoutEvent.html.twig', array('form' => $form->createView()));
            //
        }}


    function afficherEventsPropAction(){


        $em = $this->getDoctrine()->getManager();
        $ev = $em->getRepository('BonPlanBundle:Events')->findByUser($this->getUser()->getId());
        return $this->render('BonPlanBundle:Default/Events:consultationPropEvent.html.twig', array("events"=>$ev));


    }

    function afficherEventAction($id){

    $em = $this->getDoctrine()->getManager();
    $ev = $em->getRepository('BonPlanBundle:Events')->findBy(array("idevents"=>$id));
    return $this->render('BonPlanBundle:Default/Events:PageEvent.html.twig', array("event"=>$ev));


    }

    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BonPlanBundle:Events')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find events entity.');
        }


        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('PageEvent'));
        }

        return $this->render('BonPlanBundle:Default/Events:PageEvent.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),

        ));
    }

    private function createEditForm(Events $entity)
    {
        $form = $this->createForm(new EventsType(), $entity, array(
            'action' => $this->generateUrl('Event_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }



    function annulerEventAction($id){

        $em = $this->getDoctrine()->getManager();
        $ev = $em->getRepository('BonPlanBundle:Events')->findBy(array("idevents"=>$id));


        return $this->render('BonPlanBundle:Default/Events:PageEvent.html.twig', array("event"=>$ev));
    }







}
