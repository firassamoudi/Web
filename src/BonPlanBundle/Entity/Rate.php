<?php

namespace BonPlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rate
 *
 * @ORM\Table(name="rate")
 * @ORM\Entity(repositoryClass="BonPlanBundle\Repository\RateRepository")
 */
class Rate
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idRate", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrate;

    /**
     * @var integer
     *
     * @ORM\Column(name="rating", type="integer", nullable=false)
     */
    private $rating;

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
     * Get idrate
     *
     * @return integer
     */
    public function getIdrate()
    {
        return $this->idrate;
    }

    /**
     * @return int
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }




    /**
     * Set userVisiteur
     *
     * @param \BonPlanBundle\Entity\User $userVisiteur
     *
     * @return Rate
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
     * @return Rate
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
