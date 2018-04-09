<?php

namespace BonPlanBundle\Controller;

use BonPlanBundle\Entity\Reclamation;
use BonPlanBundle\Form\ReclamationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class ReclamationController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
    function ReclamerPAction(Request $request)
    {
        $reclamation = new Reclamation();
        if ($request->isMethod('POST')) {
            $reclamation->setEtat('en cours');
            $reclamation->setType($request->get('type'));
            $reclamation->setNivRec($request->get('nivRec'));
            $reclamation->setDescription($request->get('description'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($reclamation);
            $em->flush();
            return $this->redirectToRoute('bon_plan_homepage');

        }
        return $this->render('BonPlanBundle:Default/Reclamation:ReclamerPlan.html.twig', array());

    }

<<<<<<< HEAD
    function ReclamerPlanAction(Request $request,$id)
    {
        $reclamation = new Reclamation();
        if ($request->isMethod('POST')) {
            $reclamation->setEtat('en cours');
            $reclamation->setUserVisiteur($this->container->get('security.token_storage')->getToken()->getUser());
            $reclamation->setType($request->get('type'));
            $reclamation->setNivRec($request->get('nivRec'));
            $reclamation->setDescription($request->get('description'));
            $reclamation->setUserPlan($this->getDoctrine()->getRepository('BonPlanBundle:User')->findOneBy(array('id' => $id)));
            $em = $this->getDoctrine()->getManager();
            $em->persist($reclamation);
            $em->flush();
            return $this->redirectToRoute('Profil_Plan',array('id'=>$id));

        }
        return $this->render('BonPlanBundle:Default/Reclamation:ReclamerPlan.html.twig', array());

    }function AfficheReclamationAction (){
=======
function ReclamerPlanAction(Request $request,$id)
{
    $reclamation = new Reclamation();
    if ($request->isMethod('POST')) {
        $reclamation->setEtat('en cours');
        $reclamation->setUserVisiteur($this->container->get('security.token_storage')->getToken()->getUser());
        $reclamation->setType($request->get('type'));
        $reclamation->setNivRec($request->get('nivRec'));
        $reclamation->setDescription($request->get('description'));
        $reclamation->setUserPlan($this->getDoctrine()->getRepository('BonPlanBundle:User')->findOneBy(array('id' => $id)));
        $em = $this->getDoctrine()->getManager();
        $em->persist($reclamation);
        $em->flush();
        return $this->redirectToRoute('Profil_Plan',array('id'=>$id));

    }
    return $this->render('BonPlanBundle:Default/Reclamation:ReclamerPlan.html.twig', array());

}function AfficheReclamationAction (){
>>>>>>> 2fc00991a238d4670f325c3fd33b98e2396eb468
    $em=$this->getDoctrine()->getManager();
    $reclamation=$em->getRepository("BonPlanBundle:Reclamation")->findAll();
    return $this->render('BonPlanBundle:Default/Reclamation:afficheRec.html.twig',array("reclamation"=>$reclamation));
}
    function UpdateReclamationAction(Request $request,$idreclamation){
        $em=$this->getDoctrine()->getManager();
        $reclamation=$em->getRepository('BonPlanBundle:Reclamation')->find($idreclamation);
        $Form=$this->createForm(ReclamationType::class,$reclamation);
        $Form->handleRequest($request);
        if($Form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($reclamation);
            $em->flush();
            return $this->redirectToRoute('Affiche_Rec');
        }
        return $this->render('BonPlanBundle:Default/Reclamation:UpdateRec.html.twig',array('form'=>$Form->createView()));
    }
    function DeleteReclamationAction ($idreclamation)
    {
        $em=$this->getDoctrine()->getManager();
        $reclamation=$em->getRepository("BonPlanBundle:Reclamation")->find($idreclamation);
        $em->remove($reclamation);
        $em->flush();
        return $this->redirectToRoute('Affiche_Rec');}


}
