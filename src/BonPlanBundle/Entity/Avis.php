<?php

namespace BonPlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Avis
 *
 * @ORM\Table(name="avis")
 * @ORM\Entity
 */
class Avis
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idAvis", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idavis;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=255, nullable=true)
     */
    private $commentaire;

    /**
     * @var string
     *
     * @ORM\Column(name="urlPhoto", type="string", length=100, nullable=true)
     */
    private $urlphoto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateComment", type="date", nullable=true)
     */
    private $datecomment;

    /**
     * @ORM\ManyToOne(targetEntity="BonPlanBundle\Entity\User")
     *
     * @ORM\JoinColumn(name="user_iduser",referencedColumnName="id")
     */
    private $userVisiteur;

    /**
     * @ORM\ManyToOne(targetEntity="BonPlanBundle\Entity\User")
     *
     * @ORM\JoinColumn(name="user_iduser1",referencedColumnName="id")
     */
    private $userPlan;

    /**
     * Get idavis
     *
     * @return integer
     */
    public function getIdavis()
    {
        return $this->idavis;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Avis
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set urlphoto
     *
     * @param string $urlphoto
     *
     * @return Avis
     */
    public function setUrlphoto($urlphoto)
    {
        $this->urlphoto = $urlphoto;

        return $this;
    }

    /**
     * Get urlphoto
     *
     * @return string
     */
    public function getUrlphoto()
    {
        return $this->urlphoto;
    }

    /**
     * Set datecomment
     *
     * @param \DateTime $datecomment
     *
     * @return Avis
     */
    public function setDatecomment($datecomment)
    {
        $this->datecomment = $datecomment;

        return $this;
    }

    /**
     * Get datecomment
     *
     * @return \DateTime
     */
    public function getDatecomment()
    {
        return $this->datecomment;
    }


    /**
     * Set userVisiteur
     *
     * @param \BonPlanBundle\Entity\User $userVisiteur
     *
     * @return Avis
     */
    public function setUserVisiteur(\BonPlanBundle\Entity\User $userVisiteur = null)
    {
        $this->userVisiteur = $userVisiteur;

        return $this;
    }

    /**
     * Get userVisiteur
     *
     * @return \BonPlanBundle\Entity\User
     */
    public function getUserVisiteur()
    {
        return $this->userVisiteur;
    }

    /**
     * Set userPlan
     *
     * @param \BonPlanBundle\Entity\User $userPlan
     *
     * @return Avis
     */
    public function setUserPlan(\BonPlanBundle\Entity\User $userPlan = null)
    {
        $this->userPlan = $userPlan;

        return $this;
    }

    /**
     * Get userPlan
     *
     * @return \BonPlanBundle\Entity\User
     */
    public function getUserPlan()
    {
        return $this->userPlan;
    }
}
