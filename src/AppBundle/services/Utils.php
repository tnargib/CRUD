<?php

namespace AppBundle\services;

class Utils
{
	protected $em;


	public function __construct(\Doctrine\ORM\EntityManager $em)
	{
		$this->em = $em;
	}

	public function saveEntity($e)
	{
  		$this->em->persist($e);
      	$this->em->flush();
	}
}