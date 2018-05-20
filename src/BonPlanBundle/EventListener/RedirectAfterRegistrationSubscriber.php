<?php
/**
 * Created by PhpStorm.
 * User: meyss
 * Date: 10/04/2018
 * Time: 17:53
 */

namespace BonPlanBundle\EventListener;


use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use BonPlanBundle\Entity\User;

class RedirectAfterRegistrationSubscriber
{
   /* private $router;
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function onRegistrationSuccess(FormEvent $event,Request $request)
    {
        $user = $this->getUser();

        if (in_array('ROLE_VISITEUR', $user, true) ) {
            $url = $this->router->generate('Ajouter');
        }else{
            $url = $this->router->generate('AjouterP');
        }

        $response = new RedirectResponse($url);
        $event->setResponse($response);
    }
    public static function getSubscribedEvents()
    {
        return [
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess'
        ];
    }*/
}