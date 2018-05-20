<?php

namespace BonPlanBundle\Redirection;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class AfterLoginRedirection implements AuthenticationSuccessHandlerInterface
{

    /**
     * @var \Symfony\Component\Routing\RouterInterface
     */
    private $router;
    /**
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }
    /**
     * @param Request $request
     * @param TokenInterface $token
     * @return RedirectResponse
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        // Get list of roles for current user
        $roles = $token->getRoles();
        // Tranform this list in array
        $rolesTab = array_map(function($role){
            return $role->getRole();
        }, $roles);
        // If is a admin or super admin we redirect to the backoffice area

<<<<<<< HEAD
        if (in_array('ROLE_ADMIN', $rolesTab, true)) {
            // c'est un aministrateur : on le rediriger vers l'espace admin
            $redirection = new RedirectResponse($this->router->generate('bon_plan_homepage_back'));
        } else{
            if (in_array('ROLE_PROP', $rolesTab, true)) {
            // c'est un utilisaeur Proppriétaire : on le rediriger vers son accueil si son compte est validé sinon la page d'acceuil générale
                if ($token->getUser()->getValidite()!=0)
                    $redirection = new RedirectResponse($this->router->generate('bon_plan_homepage_back'));
                else
                    $redirection = new RedirectResponse($this->router->generate('homepage'));
        }

                else
                {
                // c'est un utilisaeur Visiteur : on le rediriger vers la page d'acceuil générale
                $redirection = new RedirectResponse($this->router->generate('homepage'));
                }
            }
=======
        if (in_array('ROLE_ADMIN', $rolesTab, true) )
            $redirection = new RedirectResponse($this->router->generate('Acceuil_back'));
        // otherwise, if is a commercial user we redirect to the crm area
        elseif (in_array('ROLE_PROP', $rolesTab, true))
            if ($token->getUser()->getValidite()!=null)
            $redirection = new RedirectResponse($this->router->generate('bon_plan_homepage_back'));
        else
            $redirection = new RedirectResponse($this->router->generate('homepage'));

>>>>>>> 1c4d0f271342a3deebb8766ad8e9dbb8d20e4b6e

        // otherwise we redirect user to the member area
        else
            $redirection = new RedirectResponse($this->router->generate('homepage'));
        return $redirection;
    }
}