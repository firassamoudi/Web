<?php

namespace BonPlanBundle\Entity;

/**
 * Likes
 */
class Likes
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $idpromotion;

    /**
     * @var int
     */
    private $number;

    /**
     * @var int
     */
    private $iduser;


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
     * Set idpromotion
     *
     * @param integer $idpromotion
     *
     * @return Likes
     */
    public function setIdpromotion($idpromotion)
    {
        $this->idpromotion = $idpromotion;

        return $this;
    }

    /**
     * Get idpromotion
     *
     * @return int
     */
    public function getIdpromotion()
    {
        return $this->idpromotion;
    }

    /**
     * Set number
     *
     * @param integer $number
     *
     * @return Likes
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set iduser
     *
     * @param integer $iduser
     *
     * @return Likes
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;

        return $this;
    }

    /**
     * Get iduser
     *
     * @return int
     */
    public function getIduser()
    {
        return $this->iduser;
    }
}

