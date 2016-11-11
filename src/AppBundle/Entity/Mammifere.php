<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mammifere
 *
 * @ORM\Table(name="mammifere")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MammifereRepository")
 */
class Mammifere extends Animal
{
    

    /**
     * @var string
     *
     * @ORM\Column(name="fur", type="string", length=255)
     */
    private $fur;


    

    /**
     * Set fur
     *
     * @param string $fur
     * @return Mammifere
     */
    public function setFur($fur)
    {
        $this->fur = $fur;

        return $this;
    }

    /**
     * Get fur
     *
     * @return string 
     */
    public function getFur()
    {
        return $this->fur;
    }

    /**
     * growl
     *
     * @return string 
     */
    public function growl()
    {
        return 'Je suis un(e) '.parent::getName();
    }
}
