<?php

namespace BonPlanBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * views
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="BonPlanBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=180, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="nomPlan", type="string", length=45, nullable=true)
     */
    private $nomPlan;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=45, nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="nomVisiteur", type="string", length=45, nullable=true)
     */
    private $nomVisiteur;

    /**
     * @var string
     *
     * @ORM\Column(name="prenomVisiteur", type="string", length=45, nullable=true)
     */
    private $prenomVisiteur;

    /**
     * @var double
     *
     * @ORM\Column(name="latitude", nullable=true)
     */
    private $latitude;

    /**
     * @var double
     *
     * @ORM\Column(name="longitude", nullable=true)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=45, nullable=true)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=45, nullable=true)
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=45, nullable=true)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="photodeprofil", type="string", length=45, nullable=true)
     */
    private $photodeprofil;

    /**
     * @return string
     */
    public function getPhotodeprofil()
    {
        return $this->photodeprofil;
    }

    /**
     * @param string $photodeprofil
     */
    public function setPhotodeprofil($photodeprofil)
    {
        $this->photodeprofil = $photodeprofil;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="codePostal", nullable=true)
     */
    private $codePostal;
    /**
     * @var integer
     *
     * @ORM\Column(name="validite", nullable=true)
     */
    private $validite;

    /**
     * @return int
     */
    public function getValidite()
    {
        return $this->validite;
    }

    /**
     * @param int $validite
     */
    public function setValidite($validite)
    {
        $this->validite = $validite;
    }

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
     * Set description
     *
     * @param string $description
     *
     * @return User
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
     * Set nomPlan
     *
     * @param string $nomPlan
     *
     * @return User
     */
    public function setNomPlan($nomPlan)
    {
        $this->nomPlan = $nomPlan;

        return $this;
    }

    /**
     * Get nomPlan
     *
     * @return string
     */
    public function getNomPlan()
    {
        return $this->nomPlan;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return User
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set nomVisiteur
     *
     * @param string $nomVisiteur
     *
     * @return User
     */
    public function setNomVisiteur($nomVisiteur)
    {
        $this->nomVisiteur = $nomVisiteur;

        return $this;
    }

    /**
     * Get nomVisiteur
     *
     * @return string
     */
    public function getNomVisiteur()
    {
        return $this->nomVisiteur;
    }

    /**
     * Set prenomVisiteur
     *
     * @param string $prenomVisiteur
     *
     * @return User
     */
    public function setPrenomVisiteur($prenomVisiteur)
    {
        $this->prenomVisiteur = $prenomVisiteur;

        return $this;
    }

    /**
     * Get prenomVisiteur
     *
     * @return string
     */
    public function getPrenomVisiteur()
    {
        return $this->prenomVisiteur;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     *
     * @return User
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     *
     * @return User
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return User
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set categorie
     *
     * @param string $categorie
     *
     * @return User
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return User
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set codePostal
     *
     * @param string $codePostal
     *
     * @return User
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return string
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

}
