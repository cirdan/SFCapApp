<?php

namespace SF\CapUserBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;

class RegistrationController extends BaseController
{

    public function registerAction()
    {
        $form = $this->container->get('fos_user.registration.form');
        $formHandler = $this->container->get('fos_user.registration.form.handler');
        $confirmationEnabled = $this->container->getParameter('fos_user.registration.confirmation.enabled');

        $runner=$this->container->get('CapRunner');
        if($runner===null){
            return new RedirectResponse($this->container->get('router')->generate("sf_cap_homepage"));
        }
        $process = $formHandler->process($confirmationEnabled);
        if ($process) {
            $user = $form->getData();

            /*****************************************************
             * On set le runnerId *
             *****************************************************/

            $em = $this->container->get('doctrine')->getEntityManager();
            $runner=$this->container->get('CapRunner');
            $user->setRunner($runner);
            $em->persist($user);
            $em->flush();

            $authUser = false;
            if ($confirmationEnabled) {
                $this->container->get('session')->set('fos_user_send_confirmation_email/email', $user->getEmail());
                $route = 'fos_user_registration_check_email';
            } else {
                $authUser = true;
                $route = 'fos_user_registration_confirmed';
            }

            $this->setFlash('fos_user_success', 'registration.flash.user_created');
            $url = $this->container->get('router')->generate($route);
            $response = new RedirectResponse($url);

            if ($authUser) {
                $this->authenticateUser($user, $response);
            }

            return $response;
        }

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register.html.'.$this->getEngine(), array(
            'form' => $form->createView(),
            'runner' => $runner
        ));
    }
}