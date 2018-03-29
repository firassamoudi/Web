<?php

namespace BonPlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Events
 *
 * @ORM\Table(name="events")
 * @ORM\Entity
 */
class Events
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idEvents", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idevents;

    /**
     * @var string
     *
     * @ORM\Column(name="nomEv", type="string", length=45, nullable=true)
     */
    private $nomev;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrPlace", type="integer", nullable=true)
     */
    private $nbrplace;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=45, nullable=false)
     */
    private $type = '	publique';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebutEv", type="date", nullable=false)
     */
    private $datedebutev;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFinEv", type="date", nullable=false)
     */
    private $datefinev;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbParticipant", type="integer", nullable=false)
     */
    private $nbparticipant = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="etatEv", type="string", length=45, nullable=false)
     */
    private $etatev = 'En cours';

    /**
     * @ORM\ManyToOne(targetEntity="BonPlanBundle\Entity\User")
     *
     * @ORM\JoinColumn(name="user_iduser",referencedColumnName="id")
     */
    private $userPlan;


    /**
     * Get idevents
     *
     * @return integer
     */
    public function getIdevents()
    {
        return $this->idevents;
    }

    /**
     * Set nomev
     *
     * @param string $nomev
     *
     * @return Events
     */
    public function setNomev($nomev)
    {
        $this->nomev = $nomev;

        return $this;
    }

    /**
     * Get nomev
     *
     * @return string
     */
    public function getNomev()
    {
        return $this->nomev;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Events
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set nbrplace
     *
     * @param integer $nbrplace
     *
     * @return Events
     */
    public function setNbrplace($nbrplace)
    {
        $this->nbrplace = $nbrplace;

        return $this;
    }

    /**
     * Get nbrplace
     *
     * @return integer
     */
    public function getNbrplace()
    {
        return $this->nbrplace;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Events
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set datedebutev
     *
     * @param \DateTime $datedebutev
     *
     * @return Events
     */
    public function setDatedebutev($datedebutev)
    {
        $this->datedebutev = $datedebutev;

        return $this;
    }

    /**
     * Get datedebutev
     *
     * @return \DateTime
     */
    public function getDatedebutev()
    {
        return $this->datedebutev;
    }

    /**
     * Set datefinev
     *
     * @param \DateTime $datefinev
     *
     * @return Events
     */
    public function setDatefinev($datefinev)
    {
        $this->datefinev = $datefinev;

        return $this;
    }

    /**
     * Get datefinev
     *
     * @return \DateTime
     */
    public function getDatefinev()
    {
        return $this->datefinev;
    }

    /**
     * Set nbparticipant
     *
     * @param integer $nbparticipant
     *
     * @return Events
     */
    public function setNbparticipant($nbparticipant)
    {
        $this->nbparticipant = $nbparticipant;

        return $this;
    }

    /**
     * Get nbparticipant
     *
     * @return integer
     */
    public function getNbparticipant()
    {
        return $this->nbparticipant;
    }

    /**
     * Set etatev
     *
     * @param string $etatev
     *
     * @return Events
     */
    public function setEtatev($etatev)
    {
        $this->etatev = $etatev;

        return $this;
    }

    /**
     * Get etatev
     *
     * @return string
     */
    public function getEtatev()
    {
        return $this->etatev;
    }


    /**
     * Set userPlan
     *
     * @param \BonPlanBundle\Entity\User $userPlan
     *
     * @return Events
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
