<?php

namespace BonPlanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BonPlanBundle\Entity\Abonner;
use BonPlanBundle\Form\ReclamationType;
use Symfony\Component\HttpFoundation\Request;

class AbonnerController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
    public function abonnerAction($id)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $plan = $em->getRepository('BonPlanBundle:User')->findOneBy(array('id' => $id));
            $abonner = new Abonner();
            $abonner->setUserPlan($plan);
            $abonner->setUserVisiteur($user);
            $em->persist($abonner);
            $em->flush();
            return $this->redirectToRoute('Profil_Plan',array('id' => $id));
        }
        return $this->redirectToRoute('Profil_Plan', array('id' => $id));
    }
    public function desabonnerAction($idPlan,$idUser){
        $em = $this->getDoctrine()->getManager();
        $abonner = $em->getRepository('BonPlanBundle:Abonner')->findOneBy(array('userVisiteur' => $idUser, 'userPlan' => $idPlan));
        $em->remove($abonner);
        $em->flush();
        return $this->redirectToRoute('Profil_Plan', array('id' => $idPlan));

    }
}
