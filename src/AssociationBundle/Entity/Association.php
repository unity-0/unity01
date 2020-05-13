<?php

namespace AssociationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Association
 *de
 * @ORM\Table(name="association")
 * @ORM\Entity(repositoryClass="AssociationBundle\Repository\AssociationRepository")
 */
class Association
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
     * @ORM\OneToMany(targetEntity="AssociationBundle\Entity\Reclamation",mappedBy="association")
     * @ORM\JoinColumn(name="reclamation_id", referencedColumnName="id")
     */
    protected $reclamation;

    /**
     * @return mixed
     */
    public function getReclamation()
    {
        return $this->reclamation;
    }

    /**
     * @param mixed $reclamation
     */
    public function setReclamation($reclamation)
    {
        $this->reclamation = $reclamation;
    }

    /**
     * @ORM\Column(type="string")
     * @param mixed $association
     */

    private $nomAssociation;

    /**
     * @return string
     */
    public function getNomAssociation()
    {
        return $this->nomAssociation;
    }

    /**
     * @param string $nomAssociation
     */
    public function setNomAssociation($nomAssociation)
    {
        $this->nomAssociation = $nomAssociation;
    }


    /**
     *@ORM\Column(type="integer")
     */
    private $telAssociation;

    /**
     * @var string
     *
     * @ORM\Column(name="EmailAssociation", type="string", length=255)
     */
    private $emailAssociation;

    /**
     * @var string
     *
     * @ORM\Column(name="AdresseAssociation", type="string", length=255)
     */
    private $adresseAssociation;

    /**
     * @var string
     *
     * @ORM\Column(name="DescriptionAssociation", type="string", length=255)
     */
    private $descriptionAssociation;

    /**
     * @var string
     *
     * @ORM\Column(name="NomPresidantAssociation", type="string", length=255)
     */
    private $nomPresidantAssociation;


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
     * Set telAssociation
     *
     * @param integer $telAssociation
     *
     * @return Association
     */
    public function setTelAssociation($telAssociation)
    {
        $this->telAssociation = $telAssociation;

        return $this;
    }

    /**
     * Get telAssociation
     *
     * @return int
     */
    public function getTelAssociation()
    {
        return $this->telAssociation;
    }

    /**
     * Set emailAssociation
     *
     * @param string $emailAssociation
     *
     * @return Association
     */
    public function setEmailAssociation($emailAssociation)
    {
        $this->emailAssociation = $emailAssociation;

        return $this;
    }

    /**
     * Get emailAssociation
     *
     * @return string
     */
    public function getEmailAssociation()
    {
        return $this->emailAssociation;
    }

    /**
     * Set adresseAssociation
     *
     * @param string $adresseAssociation
     *
     * @return Association
     */
    public function setAdresseAssociation($adresseAssociation)
    {
        $this->adresseAssociation = $adresseAssociation;

        return $this;
    }

    /**
     * Get adresseAssociation
     *
     * @return string
     */
    public function getAdresseAssociation()
    {
        return $this->adresseAssociation;
    }

    /**
     * Set descriptionAssociation
     *
     * @param string $descriptionAssociation
     *
     * @return Association
     */
    public function setDescriptionAssociation($descriptionAssociation)
    {
        $this->descriptionAssociation = $descriptionAssociation;

        return $this;
    }

    /**
     * Get descriptionAssociation
     *
     * @return string
     */
    public function getDescriptionAssociation()
    {
        return $this->descriptionAssociation;
    }

    /**
     * Set nomPresidantAssociation
     *
     * @param string $nomPresidantAssociation
     *
     * @return Association
     */
    public function setNomPresidantAssociation($nomPresidantAssociation)
    {
        $this->nomPresidantAssociation = $nomPresidantAssociation;

        return $this;
    }

    /**
     * Get nomPresidantAssociation
     *
     * @return string
     */
    public function getNomPresidantAssociation()
    {
        return $this->nomPresidantAssociation;
    }
    public function __toString()
    {

        return $this->nomAssociation;
    }
}

