<?php

namespace EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Don
 *
 * @ORM\Table(name="don")
 * @ORM\Entity(repositoryClass="EvenementBundle\Repository\DonRepository")
 */


class Don
{
 /**
* @ORM\ManyToOne(targetEntity="Evenement")
* @ORM\JoinColumn(
*     name="evenement ",
*     referencedColumnName="id",
*     nullable=true
* )
*/
    public $evenement;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float")
     */
    private $montant;

    /**
     * @var int
     *
     * @ORM\Column(name="card_num", type="integer")
     */
    private $cardNum;

    /**
     * @var int
     *
     * @ORM\Column(name="code_securite", type="integer")
     */
    private $codeSecurite;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @return mixed
     */
 public function getEvenement()
    {
        return $this->evenement;
    }

    /**
     * @param mixed $evenement
     */
    public function setEvenement($evenement)
    {
        $this->evenement = $evenement;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="telephone", type="integer")
     */
    private $telephone;





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
     * Set montant
     *
     * @param float $montant
     *
     * @return Don
     */

    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return float
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set cardNum
     *
     * @param integer $cardNum
     *
     * @return Don
     */
    public function setCardNum($cardNum)
    {
        $this->cardNum = $cardNum;

        return $this;
    }

    /**
     * Get cardNum
     *
     * @return int
     */
    public function getCardNum()
    {
        return $this->cardNum;
    }

    /**
     * Set codeSecurite
     *
     * @param integer $codeSecurite
     *
     * @return Don
     */
    public function setCodeSecurite($codeSecurite)
    {
        $this->codeSecurite = $codeSecurite;

        return $this;
    }

    /**
     * Get codeSecurite
     *
     * @return int
     */
    public function getCodeSecurite()
    {
        return $this->codeSecurite;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Don
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
     * Set email
     *
     * @param string $email
     *
     * @return Don
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set telephone
     *
     * @param integer $telephone
     *
     * @return Don
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return int
     */
    public function getTelephone()
    {
        return $this->telephone;
    }
}

