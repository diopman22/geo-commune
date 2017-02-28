<?php

namespace MapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MapBundle\Entity\Overlay;
use MapBundle\Form\OverlayType;

class MapController extends Controller
{
    public function domanialAction(Request $request)
    {
        $overlay = new Overlay();
        $form = $this->createForm(OverlayType::class,$overlay);
        $em = $this->getDoctrine()->getManager();

        if($form->handleRequest($request)->isValid())
        {
          $lats = explode("/",$overlay->getLat());
          $lngs = explode("/",$overlay->getLng());
          $coordonnees = array();
          for($i=0;$i<sizeof($lats);$i++){
                array_push($coordonnees,array($lats[$i],$lngs[$i]));
          }
          $overlay->setPath(json_encode($coordonnees));
          $em->persist($overlay);
          $em->flush();
          $request->getSession()->getFlashBag()->add('Notice', 'Overlay bien enregistré!');

          return $this->redirect($this->generateUrl('map_domanial'));
        }

        $repository = $em->getRepository('MapBundle:Overlay');
        $listeOverlay = $repository->findAll();
        foreach($listeOverlay as $over){
              $over->setPath(json_decode($over->getPath()));
        }

        return $this->render('MapBundle:Map:domanial.html.twig',array(
          'form' => $form->createView(),'listeOverlay' => $listeOverlay
        ));
    }

    public function proprietaireAction()
    {
      $em = $this->getDoctrine()->getManager();
      $repository = $em->getRepository('MapBundle:Overlay');
      $listeOverlay = $repository->findAll();
      foreach($listeOverlay as $over){
            $over->setPath(json_decode($over->getPath()));
      }
      return $this->render('MapBundle:Map:proprietaire.html.twig',array('listeOverlay' => $listeOverlay));
    }

    public function deleteOverlayAction()
    {
      if(isset($_POST['idd'])){
        $id = $_POST['idd'];
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('MapBundle:Overlay');
        $overlay = $repository->findOneById($id); // retrouve l'overlay dont l'id est $id passé en paramétre
        $em->remove($overlay); // demande un delete
        $em->flush(); // execute delete sur $overlay
        return $this->redirect($this->generateUrl('map_domanial'));
      }
      return $this->redirect($this->generateUrl('map_domanial'));
    }
}
