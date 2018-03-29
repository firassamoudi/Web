<?php

namespace BonPlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Abonner
 *
 * @ORM\Table(name="abonner")
 * @ORM\Entity
 */
class Abonner
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idabonner", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idabonner;

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
     * Get idabonner
     *
     * @return integer
     */
    public function getIdabonner()
    {
        return $this->idabonner;
    }


    /**
     * Set userVisiteur
     *
     * @param \BonPlanBundle\Entity\User $userVisiteur
     *
     * @return Abonner
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
     * @return Abonner
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
