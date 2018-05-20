<?php

namespace BonPlanBundle\Controller;

use BonPlanBundle\Entity\Events;
<<<<<<< HEAD
use BonPlanBundle\Entity\Participation;
use BonPlanBundle\Form\AnnulationEventType;
use BonPlanBundle\Form\EventsType;
use BonPlanBundle\Form\IncrementEventType;
use BonPlanBundle\Form\ModificationEventType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateIntervalToStringTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

=======
use BonPlanBundle\Form\EventsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
>>>>>>> 1c4d0f271342a3deebb8766ad8e9dbb8d20e4b6e

class EventsController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));}

<<<<<<< HEAD

    //**********************Espace propriétaire************************

    function addEventAction(Request $request)
=======
        public function addEventAction(Request $request)
>>>>>>> 1c4d0f271342a3deebb8766ad8e9dbb8d20e4b6e
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

<<<<<<< HEAD
    function updateEventAction(Request $request, $id)
    {

        $EventId = $request->get('id');

        $em = $this->getDoctrine()->getManager();

        $event = $em->getRepository('BonPlanBundle:Events')->find($EventId);


        $form = $this->createForm(ModificationEventType::class, $event);

        $form->handleRequest($request);

        //echo  "<script>alert($event->get)</script>";
        if($form->isValid())
        {

            $em->persist($event);
            $em->flush();
            return $this->afficherEventAction($request,$id);
        }
        return $this->render('@BonPlan/Default/Events/ModificationEvents.html.twig', array('event'=>$event,'form'=>$form->createView()));


       /* $nom = $request->get('nom');
        $desc = $request->get('description');
        $nbp = $request->get('nbrP');
        $deb = $request->get('debut');
        $fin = $request->get('fin');



        //$user = $this->get('security.token_storage')->getToken()->getUser();


        $em = $this->container->get('doctrine')->getManager();

        $ev = $em->getRepository('BonPlanBundle:Events')->findOneBy(array("idevents"=>$id));

        //    $user = $em->getRepository('AppBundle:User')->find($user_id);

        $ev->setNomev($nom);
        $ev->setDescription($desc);
        $ev->setNbrplace($nbp);
        $ev->setDatedebutev($deb);
        $ev->setDatefinev($fin);


        $em->persist($ev);
        $em->flush();



        $response = array("nom" => $nom, "description" => $desc, "nbrPlace" => $ev->getNbrplace(), "debut" => $ev->getDatedebutev(),
            "fin" => $ev->getDatedebutev(),
          );

        return new Response(json_encode($response));*/
    }

    function afficherToutEventsAction(){


        $em = $this->getDoctrine()->getManager();
        $ev = $em->getRepository('BonPlanBundle:Events')->findPublic();
        return $this->render('BonPlanBundle:Default/Events:consultationPropEvent.html.twig', array("events"=>$ev));


    }
=======
>>>>>>> 1c4d0f271342a3deebb8766ad8e9dbb8d20e4b6e

    function afficherEventsPropAction(){


        $em = $this->getDoctrine()->getManager();
        $ev = $em->getRepository('BonPlanBundle:Events')->findByUser($this->getUser()->getId());
<<<<<<< HEAD
        return $this->render('BonPlanBundle:Default/Events:consultSesEvent.html.twig', array("events"=>$ev));
=======
        return $this->render('BonPlanBundle:Default/Events:consultationPropEvent.html.twig', array("events"=>$ev));
>>>>>>> 1c4d0f271342a3deebb8766ad8e9dbb8d20e4b6e


    }

<<<<<<< HEAD
    function afficherEventAction(Request $request,$id){

        $em = $this->getDoctrine()->getManager();
        $ev = $em->getRepository('BonPlanBundle:Events')->findBy(array("idevents"=>$id));

        $event = $em->getRepository(Events::class)->findOneBy(array("idevents"=>$id));

        $form = $this->createForm(AnnulationEventType::class, $event);
        $form->handleRequest($request);

        if (($form->isSubmitted() )) {
                    return $this->AnnulerEventAction($event->getIdevents(),$event);
                }


        return $this->render('BonPlanBundle:Default/Events:PageEvent.html.twig', array("event"=>$ev,"form"=>$form->createView()));
=======
    function afficherEventAction($id){

    $em = $this->getDoctrine()->getManager();
    $ev = $em->getRepository('BonPlanBundle:Events')->findBy(array("idevents"=>$id));
    return $this->render('BonPlanBundle:Default/Events:PageEvent.html.twig', array("event"=>$ev));
>>>>>>> 1c4d0f271342a3deebb8766ad8e9dbb8d20e4b6e


    }

<<<<<<< HEAD

    //**********************Espace visiteur************************

    function afficherEventVisiteurAction(Request $request,$id){

        $em = $this->getDoctrine()->getManager();
        $ev = $em->getRepository('BonPlanBundle:Events')->findBy(array("idevents"=>$id));
        $event = $em->getRepository(Events::class)->findOneBy(array("idevents"=>$id));

        $form = $this->createForm(IncrementEventType::class, $event);
        $form->handleRequest($request);

        if (($form->isSubmitted() )) {
            if ($event->getNbrplace()== $event->getNbparticipant()) {
                echo  "<script>alert(\"plus de place disponible!!\")</script>";
            } else
                {
                    $m = $event->getNbparticipant() + 1;
                    $event->setNbparticipant($m);
                    $em->persist($event);
                    $em->flush();

                   $user= $this->getUser();
                    $p= new Participation();
                    $session = new Session();
                    $p->setEventsevents($event);
                    $p->setUserVisiteur($user);

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($p);

                    $em->flush();
                    $session->getFlashBag()->add('success', 'participation ajouté avec succes');

                   // $pc =new ParticipationController();
                   // $pc->addParticipationAction($request,$this->getUser(),$event);
                    return $this->redirectToRoute("Events");

                }

        }

        return $this->render("BonPlanBundle:Default/Events:PageEventVisiteur.html.twig", array("event"=>$ev,'form'=>$form->createView()));



    }

    function afficherToutEvents_VisiteurAction(){
        $word='En cours';
        $em = $this->getDoctrine()->getManager();
        $ev = $em->getRepository('BonPlanBundle:Events')->findByEtat($word);
        return $this->render('BonPlanBundle:Default/Events:Events.html.twig', array("events"=>$ev));

    }


    /* function incrementParticipantsAction(Request $request,$id)
     {
         $nbpr = $request->get('participants');

         $em = $this->container->get('doctrine')->getManager();

         $ev = $em->getRepository('BonPlanBundle:Events')->findOneBy(array("idevents"=>$id));
         $ev->setNbparticipant($nbpr);

         $em->persist($ev);
         $em->flush();



         $response = array("participants" =>$nbpr,

       // return new Response(json_encode($response));

    }**/


    function AnnulerEventAction($id,$event){


        $em = $this->getDoctrine()->getManager();
        $ev = $em->getRepository('BonPlanBundle:Events')->findOneBy(array("idevents"=>$id));
        $ev->setEtatev("Annulé");
        $em->persist($event);
        $em->flush();

        return $this->redirectToRoute("EventProp_consult");


    }


//**********************************************services web**********************************************//

    public function allAction()
    {
        $ev = $this->getDoctrine()->getManager()
            ->getRepository('BonPlanBundle:Events')
            ->findAll();

        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($ev);
        return new JsonResponse($formatted);
    }

      public function newAction(Request $request)
    {
        $ev = $this->getDoctrine()->getManager();
        $event = new Events();

        $event->setNomev($request->get('nomev'));
        $event->setDescription($request->get('description'));
        $event->setDatedebutev(new \DateTime($request->get('datedebutev')));
        $event->setDatefinev(new \DateTime($request->get('datefinev')));
        $event->setNbrplace($request->get('nbrplace'));
        $event->setNbparticipant(0);
        $event->setEtatev("En cours");
        $event->setType("publique");

        $user = $ev->getRepository('BonPlanBundle:User')->findById($request->get('user_iduser'));
        $event->setUserPlan($user[0]);
        $ev->persist($event);
        $ev->flush();

        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($event);
        return new JsonResponse($formatted);
    }

    function incrementParticipantsAction(Request $request)

    { $em = $this->getDoctrine()->getManager();

        $event = $em->getRepository(Events::class)->findOneBy(array("idevents"=>$request->get('idEvent')));


        $m = $event->getNbparticipant() + 1;
        $event->setNbparticipant($m);
        $em->persist($event);
        $em->flush();

        $user = $em->getRepository('BonPlanBundle:User')->findOneBy(array("id"=>$request->get('user')));
        //$user= $this->getUser();
        $p= new Participation();
        $p->setUserVisiteur($user);
        $p->setEventsevents($event);



        $ep = $this->getDoctrine()->getManager();
        $ep->persist($p);

        $ep->flush();

        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($event);
        return new JsonResponse($formatted);
    }

    function decrementParticipantsAction(Request $request)

    { $em = $this->getDoctrine()->getManager();

        $event = $em->getRepository(Events::class)->findOneBy(array("idevents"=>$request->get('idEvent')));

        $m = $event->getNbparticipant() - 1;
        $event->setNbparticipant($m);
        $em->persist($event);
        $em->flush();

        $ep = $this->getDoctrine()->getManager();
        $p = $ep->getRepository('BonPlanBundle:Participation')
            ->findOneBy(array("userVisiteur"=>$request->get('user'),"eventsevents"=>$event));
        $ep->remove($p);

        $ep->flush();

        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($event);
        return new JsonResponse($formatted);
    }

    public function findAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $event = $em->getRepository(Events::class)->findOneBy(array("idevents"=>$request->get('idEvent')));
        $p= $this->getDoctrine()->getManager()
            ->getRepository('BonPlanBundle:Participation')
            ->findOneBy(array("userVisiteur"=>$request->get('user'),"eventsevents"=>$event));

        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($p);
        return new JsonResponse($formatted);
=======
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
>>>>>>> 1c4d0f271342a3deebb8766ad8e9dbb8d20e4b6e
    }



    function annulerEventAction($id){

        $em = $this->getDoctrine()->getManager();
        $ev = $em->getRepository('BonPlanBundle:Events')->findBy(array("idevents"=>$id));


        return $this->render('BonPlanBundle:Default/Events:PageEvent.html.twig', array("event"=>$ev));
    }







}
