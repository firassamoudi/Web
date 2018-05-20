<?php

namespace BonPlanBundle\Controller;

use BonPlanBundle\Entity\Avis;
use BonPlanBundle\Entity\User;
use BonPlanBundle\Form\AjouterCommentaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
<<<<<<< HEAD
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints\Date;
=======
>>>>>>> 1c4d0f271342a3deebb8766ad8e9dbb8d20e4b6e

class AvisController extends Controller
{
    public function CommentaireAction($id,Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $commentaire=$em->getRepository(Avis::class)->findByCommentaire($id);
        $users=$em->getRepository(User::class)->find($id);
        $avis = new Avis();
        $form = $this->createForm(AjouterCommentaire::class, $avis);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            var_dump($avis);
            $avis->setUserVisiteur($this->getUser());
            $avis->setUserPlan($users);
            $avis->setDatecomment(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($avis);
            $em->flush();
        }
        return $this->render('@BonPlan/Default/Commentaire/Commentaire.html.twig' ,array(
            'commentaires'=>$commentaire,'users'=>$users,'form'=>$form->createView()
        ));
<<<<<<< HEAD
    }

    public function SuppCommentaireAction(Request $request,$id)
    {

        $em=$this->getDoctrine()->getManager();
        $avis=$em->getRepository("BonPlanBundle:Avis")->find($id);
        $user2=$em->getRepository("BonPlanBundle:Avis")->findByProp($id);
        $u=$em->getRepository(User::class)->findOneBy(array('id'=>$user2[0]));
        $em->remove($avis);
        $em->flush();
        return $this->redirectToRoute('Profil_Plan',array('id'=>$u->getId()));
    }
    public function createCommentaireAction(Request $request)
    {
        $avis = new Avis();
        $form = $this->createForm(AjouterCommentaire::class, $avis);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            var_dump($avis);
//            $avis->setUserVisiteur($this->getUser());
//            $avis->setUserPlan($userPlan);
//            $avis->setDatecomment(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($avis);
            $em->flush();

//            return $this->redirectToRoute('Commentaire');
        }
        return $this->render('BonPlanBundle:Default/Commentaire:AjouterCommentaire.html.twig', array(
            "form" => $form->createView()
        ));
    }

    function AjoutCommentaireMobileAction(Request $request)
    {
        $modele=new Avis();
        $modele->setCommentaire($request->get('commentaire'));
        $modele->setUrlphoto(' ');
        $modele->setDatecomment(new \DateTime('now'));
        //   $modele->setUserVisiteur($request->get('Visiteur'));
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
    function afficherCommentaireMobileAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $reservation = $em->getRepository('BonPlanBundle:Avis')->findByuserP($id);
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($reservation);
        return new JsonResponse($formatted);

    }

    function supprimerCommentaireMobileAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $reservation = $em->getRepository("BonPlanBundle:Avis")->find($id);

        $em->remove($reservation);
        $em->flush();

=======
>>>>>>> 1c4d0f271342a3deebb8766ad8e9dbb8d20e4b6e
    }

    public function SuppCommentaireAction(Request $request,$id)
    {

        $em=$this->getDoctrine()->getManager();
        $avis=$em->getRepository("BonPlanBundle:Avis")->find($id);
        $user2=$em->getRepository("BonPlanBundle:Avis")->findByProp($id);
       $u=$em->getRepository(User::class)->findOneBy(array('id'=>$user2[0]));
        $em->remove($avis);
        $em->flush();
        return $this->redirectToRoute('Profil_Plan',array('id'=>$u->getId()));
    }
    public function createCommentaireAction(Request $request)
    {
        $avis = new Avis();
        $form = $this->createForm(AjouterCommentaire::class, $avis);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            var_dump($avis);
//            $avis->setUserVisiteur($this->getUser());
//            $avis->setUserPlan($userPlan);
//            $avis->setDatecomment(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($avis);
            $em->flush();

//            return $this->redirectToRoute('Commentaire');
        }
        return $this->render('BonPlanBundle:Default/Commentaire:AjouterCommentaire.html.twig', array(
            "form" => $form->createView()
        ));
    }

}
