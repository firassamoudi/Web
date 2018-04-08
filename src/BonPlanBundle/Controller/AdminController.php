<?php

namespace BonPlanBundle\Controller;

use BonPlanBundle\Entity\Promotion;
use BonPlanBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;

class AdminController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));

    }
    public function ToPDFAction(Request $request, $id){
        $user_id= $request->get('id');

        $em = $this->getDoctrine()->getManager();

        $user= $em->getRepository('BonPlanBundle:User')->find($user_id);



        $html = $this->renderView('BonPlanBundle:Default/validation:TESTPDF.html.twig' , array('user'=>$user) );

        $snappy = $this->get('knp_snappy.pdf');



        $filename = 'BonPlan';

        return new Response(
            $snappy->getOutputFromHtml($html),
                200,
                array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
                )
                );
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


    public function RechercheAction(Request $request)
    {
        $search =$request->query->get('user');
        $en = $this->getDoctrine()->getManager();
        $user=$en->getRepository("BonPlanBundle:User")->findProp($search);
        return $this->render("BonPlanBundle:Default/validation:validationcompte.html.twig",array(
            'users' => $user
        ));}

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
