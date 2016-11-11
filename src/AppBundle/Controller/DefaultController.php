<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Animal;
use AppBundle\Form\AnimalType;
use AppBundle\Entity\Mammifere;
use AppBundle\Form\MammifereType;
use AppBundle\Entity\Reptile;
use AppBundle\Form\ReptileType;
use AppBundle\Entity\oiseaux;
use AppBundle\Form\oiseauxType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
	public function indexAction()
    {
		$animals = $this->getDoctrine()->getManager()->getRepository('AppBundle:Animal');
		$list_animals = $animals->findAll();

		foreach ($list_animals as $animal) {
			$animal->type = (new \ReflectionClass($animal))->getShortName();

			switch($animal->type) {
				case 'Reptile':
					$animal->description = $animal->hiss().', et mes écailles sont '.$animal->getScale();
					break;
				case 'Mammifere':
					$animal->description = $animal->growl().', et ma fourrure est '.$animal->getFur();
					break;
				case 'oiseaux':
					$animal->description = $animal->tweet().', et mon plumage est '.$animal->getFeathers();
					break;
			}
		}


        return $this->render(
        	'AppBundle:Default:index.html.twig',
        	array('animals' => $list_animals)
    	);
    }




    public function addAction(Request $request)
    {
	    $reptile = new Reptile();
	    $form_reptile = $this->get('form.factory')->create(new ReptileType, $reptile);

	    $mammifere = new Mammifere();
	    $form_mammifere = $this->get('form.factory')->create(new MammifereType, $mammifere);

	    $oiseau = new oiseaux();
	    $form_oiseau = $this->get('form.factory')->create(new oiseauxType, $oiseau);

	    // On récupère le service
    	$utils = $this->container->get('app.utils');

	    if ($form_reptile->handleRequest($request)->isValid()) {
	    	$utils->saveEntity($reptile);
	    	return $this->redirect($this->generateUrl('app_homepage'));
	    } 
	    if ($form_mammifere->handleRequest($request)->isValid()) {
	    	$utils->saveEntity($mammifere);
	    	return $this->redirect($this->generateUrl('app_homepage'));
	    } 
	    if ($form_oiseau->handleRequest($request)->isValid()) {
	    	$utils->saveEntity($oiseau);
	    	return $this->redirect($this->generateUrl('app_homepage'));
	    } 

        return $this->render('AppBundle:Default:form.html.twig', array(
    		'form_reptile' => $form_reptile->createView(),
    		'form_mammifere' => $form_mammifere->createView(),
    		'form_oiseau' => $form_oiseau->createView(),
		));
    }


    public function editAction(Request $request, Animal $id)
    {
    	$id->type = (new \ReflectionClass($id))->getShortName();

    	$form_reptile = $this->get('form.factory')->create(new ReptileType, new Reptile);;
    	$form_mammifere = $this->get('form.factory')->create(new MammifereType, new Mammifere);
    	$form_oiseau = $this->get('form.factory')->create(new oiseauxType, new oiseaux);

		switch($id->type) {
			case 'Reptile':
	    		$form_reptile = $this->get('form.factory')->create(new ReptileType, $id);
				break;
			case 'Mammifere':
				$form_mammifere = $this->get('form.factory')->create(new MammifereType, $id);
				break;
			case 'oiseaux':
				$form_oiseau = $this->get('form.factory')->create(new oiseauxType, $id);
				break;
		}



	    // On récupère le service
    	$utils = $this->container->get('app.utils');

	    if ($form_reptile->handleRequest($request)->isValid() || 
	    	$form_mammifere->handleRequest($request)->isValid() || 
	    	$form_oiseau->handleRequest($request)->isValid())
	    {
	    	$utils->saveEntity($id);
	    	return $this->redirect($this->generateUrl('app_homepage'));
	    }

        return $this->render('AppBundle:Default:edit.html.twig', array(
        	'animal' => $id,
    		'form_reptile' => $form_reptile->createView(),
    		'form_mammifere' => $form_mammifere->createView(),
    		'form_oiseau' => $form_oiseau->createView(),
		));
    }




    public function deleteAction(Animal $id) {

    	$em = $this->getDoctrine()->getEntityManager();
    	$em->remove($id);
		$em->flush();

    	return $this->redirect($this->generateUrl('app_homepage'));
    }
}
