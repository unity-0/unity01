<?php

namespace AssociationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation")
 * @ORM\Entity(repositoryClass="AssociationBundle\Repository\ReclamationRepository")
 */
class Reclamation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AssociationBundle\Entity\Association",inversedBy="reclamation")
     */
    protected $association;

    /**
     * @return mixed
     */
    public function getAssociation()
    {
        return $this->association;
    }

    /**
     * @param mixed $association
     */
    public function setAssociation($association)
    {
        $this->association = $association;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="SujetReclamation", type="string", length=255)
     */
    private $sujetReclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="DescriptionReclamation", type="string", length=255)
     */
    private $descriptionReclamation;


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
     * Set sujetReclamation
     *
     * @param string $sujetReclamation
     *
     * @return Reclamation
     */
    public function setSujetReclamation($sujetReclamation)
    {
        $this->sujetReclamation = $sujetReclamation;

        return $this;
    }

    /**
     * Get sujetReclamation
     *
     * @return string
     */
    public function getSujetReclamation()
    {
        return $this->sujetReclamation;
    }

    /**
     * Set descriptionReclamation
     *
     * @param string $descriptionReclamation
     *
     * @return Reclamation
     */
    public function setDescriptionReclamation($descriptionReclamation)
    {
        $this->descriptionReclamation = $descriptionReclamation;

        return $this;
    }

    /**
     * Get descriptionReclamation
     *
     * @return string
     */
    public function getDescriptionReclamation()
    {
        return $this->descriptionReclamation;
    }

}

