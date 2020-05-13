<?php

namespace CampBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * refuge
 *
 * @ORM\Table(name="refuge")
 * @ORM\Entity(repositoryClass="CampBundle\Repository\refugeRepository")
 */
class refuge
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var int
     *
     * @ORM\Column(name="tel", type="integer")
     */
    private $tel;

    /**
     * @var int
     *
     * @ORM\Column(name="nbtot", type="integer")
     */
    private $nbtot;


    /**
     * @var float
     *
     * @ORM\Column(name="pour", type="float")
     */
    private $pour;


    /**
     * @var string
     * @Assert\NotBlank(message="choisissez une image")
     * @Assert\Image()
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;



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
     * Set nom
     *
     * @param string $nom
     *
     * @return refuge
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return refuge
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set tel
     *
     * @param integer $tel
     *
     * @return refuge
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return int
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return int
     */
    public function getNbtot()
    {
        return $this->nbtot;
    }

    /**
     * @param int $nbtot
     */
    public function setNbtot($nbtot)
    {
        $this->nbtot = $nbtot;
    }

    /**
     * @return float
     */
    public function getPour()
    {
        return $this->pour;
    }

    /**
     * @param float $pour
     */
    public function setPour($pour)
    {
        $this->pour = $pour;
    }




}

