<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reptile
 *
 * @ORM\Table(name="reptile")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReptileRepository")
 */
class Reptile extends Animal
{
    

    /**
     * @var string
     *
     * @ORM\Column(name="scale", type="string", length=255)
     */
    private $scale;


    

    /**
     * Set scale
     *
     * @param string $scale
     * @return Reptile
     */
    public function setScale($scale)
    {
        $this->scale = $scale;

        return $this;
    }

    /**
     * Get scale
     *
     * @return string 
     */
    public function getScale()
    {
        return $this->scale;
    }

    /**
     * hiss
     *
     * @return string 
     */
    public function hiss()
    {
        // print_r(get_parent_class($this));
        return 'Je suis un(e) '.parent::getName();
    }
}
