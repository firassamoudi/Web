<?php

namespace BonPlanBundle\Controller;

use BonPlanBundle\Entity\Avis;
use BonPlanBundle\Entity\User;
use BonPlanBundle\Form\AjouterCommentaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
