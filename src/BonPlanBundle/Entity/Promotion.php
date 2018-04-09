<?php

namespace BonPlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Promotion
 *
 * @ORM\Table(name="promotion")
 * @ORM\Entity(repositoryClass="BonPlanBundle\Repository\promotionRepository")
 */
class Promotion
{

    /**
     * @var integer
     *
     * @ORM\Column(name="idPromotion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpromotion;

    /**
     * @var integer
     *
     * @ORM\Column(name="reduction", type="integer", length=45, nullable=true)
     */
    private $reduction;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=45, nullable=true)
     */
    private $description;

    /**
     * @var string
         *
     * @ORM\Column(name="urlPromo", type="string", length=255, nullable=true)
     */
    private $urlpromo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebutP", type="date", nullable=false)
     */
    private $datedebutp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFinP", type="date", nullable=false)
     */

    private $datefinp;

    /**
     * @var \ integer
     *
     * @ORM\Column(name="etat_promo", type="integer", nullable=true)
     */
    private $etat_promo;

    /**
     * @ORM\ManyToOne(targetEntity="BonPlanBundle\Entity\User")
     *
     * @ORM\JoinColumn(name="user_iduser",referencedColumnName="id")
     */
    private $userPlan;

    /**
     * Get idpromotion
     *
     * @return integer
     */
    public function getIdpromotion()
    {
        return $this->idpromotion;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Promotion
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
     * Set urlpromo
     *
     * @param string $urlpromo
     *
     * @return Promotion
     */
    public function setUrlpromo($urlpromo)
    {
        $this->urlpromo = $urlpromo;

        return $this;
    }

    /**
     * Get urlpromo
     *
     * @return string
     */
    public function getUrlpromo()
    {
        return $this->urlpromo;
    }

    /**
     * Set datedebutp
     *
     * @param \DateTime $datedebutp
     *
     * @return Promotion
     */
    public function setDatedebutp($datedebutp)
    {
        $this->datedebutp = $datedebutp;

        return $this;
    }

    /**
     * Get datedebutp
     *
     * @return \DateTime
     */
    public function getDatedebutp()
    {
        return $this->datedebutp;
    }

    /**
     * @return int
     */
    public function getReduction()
    {
        return $this->reduction;
    }

    /**
     * @param int $reduction
     */
    public function setReduction($reduction)
    {
        $this->reduction = $reduction;
    }

    /**
     * @return int
     */
    public function getEtatPromo()
    {
        return $this->etat_promo;
    }

    /**
     * @param int $etat_promo
     */
    public function setEtatPromo($etat_promo)
    {
        $this->etat_promo = $etat_promo;
    }

    /**
     * Set datefinp
     *
     * @param \DateTime $datefinp
     *
     * @return Promotion
     */
    public function setDatefinp($datefinp)
    {
        $this->datefinp = $datefinp;

        return $this;
    }

    /**
     * Get datefinp
     *
     * @return \DateTime
     */
    public function getDatefinp()
    {
        return $this->datefinp;
    }

    /**
     * Set userPlan
     *
     * @param \BonPlanBundle\Entity\User $userPlan
     *
     * @return Promotion
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
