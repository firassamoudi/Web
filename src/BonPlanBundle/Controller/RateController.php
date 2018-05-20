<?php

namespace BonPlanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BonPlanBundle\Entity\Rate;
use BonPlanBundle\Entity\User;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;

class RateController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
    public function CategAjoutAction(Request $request)
    {
        $event = new Rate();
        $form=$this->createForm(\BonPlanBundle\Form\RatingType::class,$event);
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
    function AjoutRateMobileAction(Request $request)
    {

        $modele=new Rate();
        $modele->setRating($request->get('rate'));
        $em = $this->getDoctrine()->getManager();

        $visiteur = $em->getRepository(User::class)->findById($request->get('Visiteur'));
        $modele->setUserVisiteur($visiteur[0]);
        $Plan = $em->getRepository(User::class)->findById($request->get('Plan'));
        $modele->setUserPlan($Plan[0]);
        $emm=$this->getDoctrine()->getManager();
        $emm->persist($modele);
        $emm->flush();
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($modele);
        return new JsonResponse($formatted);

    }

    public function afficheRateAction(Request $request){

        $id = $request->get('id');
        $em=$this->getDoctrine()->getManager();

        $rate = $em->getRepository('BonPlanBundle:Rate')->Rate($id);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formated = $serializer->normalize($rate);
        return new JsonResponse($formated);

    }
}
