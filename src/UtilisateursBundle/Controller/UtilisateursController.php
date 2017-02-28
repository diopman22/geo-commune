<?php

namespace UtilisateursBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UtilisateursBundle\Entity\User;
use UtilisateursBundle\Form\UserType;
use Symfony\Component\Security\Core\SecurityContext;


class UtilisateursController extends Controller
{
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        if(null === $user){
          // Le service authentication_utils permet de récupérer le nom d'utilisateur
          // et l'erreur dans le cas où le formulaire a déjà été soumis mais était invalide
          // (mauvais mot de passe par exemple)
          $authenticationUtils = $this->get('security.authentication_utils');

          return $this->render('UtilisateursBundle:Utilisateurs:index.html.twig', array(
              'last_username' => $authenticationUtils->getLastUsername(),
              'error'         => $authenticationUtils->getLastAuthenticationError(),
            ));
        }
        else{

          if($user->getRoles() == array('ROLE_COMMISSION'))
              return $this->redirectToRoute('map_domanial');
          elseif($user->getRoles() == array('ROLE_PROPRIETAIRE'))
              return $this->redirectToRoute('map_proprietaire');
          elseif($user->getRoles() == array('ROLE_MODERATEUR'))
              return $this->redirectToRoute('map_moderateur');
        }

    }

    public function inscriptionAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class,$user);
        $em = $this->getDoctrine()->getManager();

        if($form->handleRequest($request)->isValid())
        {
            $user->setSalt('');
            $user->setRoles(array($user->getProfil()));
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);
            $em->persist($user);
            $em->flush();
            $request->getSession()->getFlashBag()->add('Notice', 'Utilisateur bien enregistré!');

            return $this->redirect($this->generateUrl('utilisateurs_homepage'));
        }
        return $this->render('UtilisateursBundle:Utilisateurs:inscription.html.twig',array(
          'form' => $form->createView()
        ));
    }
}
