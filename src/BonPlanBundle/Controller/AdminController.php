<?php

namespace BonPlanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
    public function ValiderCompteAction()
    {

        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery(
                'SELECT u FROM BonPlanBundle:User u WHERE 
                  u.roles LIKE :role 
                  AND u.validite =  0'
            )->setParameter('role', '%"ROLE_PROP"%'
            );
        $users = $query->getResult();



        return $this->render('@BonPlan/Default/validation/validationcompte.html.twig', array('users' => $users));


    }
    public function ValiderAction(Request $request, $id)
    {
        //$authChecker = $this->container->get('security.authorization_checker');
        //if (($authChecker->isGranted('ROLE_PROPRIETAIRE')))
        //{
        $user_id= $request->get('id');

        $em = $this->getDoctrine()->getManager();

        $user= $em->getRepository('BonPlanBundle:User')->find($user_id);




            $user->setvalidite(1);
            $em->persist($user);
            $em->flush();
            return $this->redirect($this->generateUrl('Validation_Compte'));


        // }else{
        //   return $this->render('@BonPlan/Default/index.html.twig');
    }
}
