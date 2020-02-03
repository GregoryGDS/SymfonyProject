<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // si l'utilisateur accède à "\login" en étant déjà connect
        if ($this->getUser()) {
            return $this->redirectToRoute('/login-success');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user (ici dernier email)
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername, 
            'error' => $error
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        return $this->redirectToRoute('/');
        
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
        
    }

    /**
     * @Route("/login-success", name="login-success")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function connectSuccess()
    {
        return $this->render('security/login-success.html.twig');
    }
}
