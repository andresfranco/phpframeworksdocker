<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="curricullum")
 */
 class Curricullum
 {
     /**
      * @ORM\Id
      * @ORM\GeneratedValue(strategy="AUTO")
      * @ORM\Column(type="integer")
      */
     private $id;
     /**
      * @ORM\Column(type="string")
      */
     private $name;

      /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Post
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
 }