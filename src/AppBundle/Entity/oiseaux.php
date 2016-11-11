<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * oiseaux
 *
 * @ORM\Table(name="oiseaux")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\oiseauxRepository")
 */
class oiseaux extends Animal
{
    

    /**
     * @var string
     *
     * @ORM\Column(name="feathers", type="string", length=255)
     */
    private $feathers;


    

    /**
     * Set feathers
     *
     * @param string $feathers
     * @return oiseaux
     */
    public function setFeathers($feathers)
    {
        $this->feathers = $feathers;

        return $this;
    }

    /**
     * Get feathers
     *
     * @return string 
     */
    public function getFeathers()
    {
        return $this->feathers;
    }

    /**
     * tweet
     *
     * @return string 
     */
    public function tweet()
    {
        return 'Je suis un(e) '.parent::getName();
    }
}
