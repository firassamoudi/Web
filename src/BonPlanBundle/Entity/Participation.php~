<?php

namespace BonPlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="participation")
 * @ORM\Entity
 */
class Participation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idParticipation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idparticipation;

    /**
     * @ORM\ManyToOne(targetEntity="BonPlanBundle\Entity\Events")
     *
     * @ORM\JoinColumn(name="Events_idEvents",referencedColumnName="idEvents")
     */
    private $eventsevents;

    /**
     * @ORM\ManyToOne(targetEntity="BonPlanBundle\Entity\User")
     *
     * @ORM\JoinColumn(name="user_iduser",referencedColumnName="id")
     */
    private $userVisiteur;



    /**
     * Get idparticipation
     *
     * @return integer
     */
    public function getIdparticipation()
    {
        return $this->idparticipation;
    }

    /**
     * Set eventsevents
     *
     * @param \BonPlanBundle\Entity\Events $eventsevents
     *
     * @return Participation
     */
    public function setEventsevents(\BonPlanBundle\Entity\Events $eventsevents = null)
    {
        $this->eventsevents = $eventsevents;

        return $this;
    }

    /**
     * Get eventsevents
     *
     * @return \BonPlanBundle\Entity\Events
     */
    public function getEventsevents()
    {
        return $this->eventsevents;
    }


    /**
     * Set userVisiteur
     *
     * @param \BonPlanBundle\Entity\User $userVisiteur
     *
     * @return Participation
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
}
