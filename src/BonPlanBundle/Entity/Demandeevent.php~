<?php

namespace BonPlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Demandeevent
 *
 * @ORM\Table(name="demandeevent")
 * @ORM\Entity
 */
class Demandeevent
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idDemande", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddemande;

    /**
     * @var string
     *
     * @ORM\Column(name="nomEvent", type="string", length=45, nullable=false)
     */
    private $nomevent;

    /**
     * @var string
     *
     * @ORM\Column(name="typeEvent", type="string", length=45, nullable=false)
     */
    private $typeevent;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionEvent", type="string", length=45, nullable=false)
     */
    private $descriptionevent;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbPlaceEvent", type="integer", nullable=false)
     */
    private $nbplaceevent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateDebut", type="date", nullable=false)
     */
    private $datedebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateFin", type="date", nullable=false)
     */
    private $datefin;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Validité", type="boolean", nullable=false)
     */
    private $validite = '0';

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
     * Get iddemande
     *
     * @return integer
     */
    public function getIddemande()
    {
        return $this->iddemande;
    }

    /**
     * Set nomevent
     *
     * @param string $nomevent
     *
     * @return Demandeevent
     */
    public function setNomevent($nomevent)
    {
        $this->nomevent = $nomevent;

        return $this;
    }

    /**
     * Get nomevent
     *
     * @return string
     */
    public function getNomevent()
    {
        return $this->nomevent;
    }

    /**
     * Set typeevent
     *
     * @param string $typeevent
     *
     * @return Demandeevent
     */
    public function setTypeevent($typeevent)
    {
        $this->typeevent = $typeevent;

        return $this;
    }

    /**
     * Get typeevent
     *
     * @return string
     */
    public function getTypeevent()
    {
        return $this->typeevent;
    }

    /**
     * Set descriptionevent
     *
     * @param string $descriptionevent
     *
     * @return Demandeevent
     */
    public function setDescriptionevent($descriptionevent)
    {
        $this->descriptionevent = $descriptionevent;

        return $this;
    }

    /**
     * Get descriptionevent
     *
     * @return string
     */
    public function getDescriptionevent()
    {
        return $this->descriptionevent;
    }

    /**
     * Set nbplaceevent
     *
     * @param integer $nbplaceevent
     *
     * @return Demandeevent
     */
    public function setNbplaceevent($nbplaceevent)
    {
        $this->nbplaceevent = $nbplaceevent;

        return $this;
    }

    /**
     * Get nbplaceevent
     *
     * @return integer
     */
    public function getNbplaceevent()
    {
        return $this->nbplaceevent;
    }

    /**
     * Set datedebut
     *
     * @param \DateTime $datedebut
     *
     * @return Demandeevent
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    /**
     * Get datedebut
     *
     * @return \DateTime
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * Set datefin
     *
     * @param \DateTime $datefin
     *
     * @return Demandeevent
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;

        return $this;
    }

    /**
     * Get datefin
     *
     * @return \DateTime
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * Set validite
     *
     * @param boolean $validite
     *
     * @return Demandeevent
     */
    public function setValidite($validite)
    {
        $this->validite = $validite;

        return $this;
    }

    /**
     * Get validite
     *
     * @return boolean
     */
    public function getValidite()
    {
        return $this->validite;
    }


    /**
     * Set userVisiteur
     *
     * @param \BonPlanBundle\Entity\User $userVisiteur
     *
     * @return Demandeevent
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
     * @return Demandeevent
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
