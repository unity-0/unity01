<?php

namespace ActionBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Postcomment
 *
 * @ORM\Table(name="postcomment")
 * @ORM\Entity(repositoryClass="ActionBundle\Repository\PostcommentRepository")
 * * @ORM\HasLifecycleCallbacks()
 */
class Postcomment
{


    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="ActionBundle\Entity\Action", inversedBy="comments")
     * @ORM\JoinColumn(name="action_id", referencedColumnName="id")
     */
    private $action;


    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="comments")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;


    /**
     * @Assert\DateTime()
     */
    private $posted_at;


    /**
     * @ORM\PrePersist
     */

    public function setPostedAt()
    {
        $this->posted_at = new DateTime('now');
    }


    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */

    private $id;

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
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Postcomment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }





    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }
    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }
}

