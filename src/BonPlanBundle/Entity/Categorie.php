<?php

namespace BonPlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="BonPlanBundle\Repository\CategorieRepository")
 */
class Categorie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_categorie", type="string", length=255)
     */
    private $nomCategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="image_categorie", type="string", length=255)
     *
     * @Assert\NotBlank(message="Ajouter une image jpg")
     * @Assert\File(mimeTypes={ "image/jpg" })
     *
     */
    private $imageCategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="icone_categorie", type="string", length=255)
     */
    private $iconeCategorie;


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
     * Set nomCategorie
     *
     * @param string $nomCategorie
     *
     * @return Categorie
     */
    public function setNomCategorie($nomCategorie)
    {
        $this->nomCategorie = $nomCategorie;

        return $this;
    }

    /**
     * Get nomCategorie
     *
     * @return string
     */
    public function getNomCategorie()
    {
        return $this->nomCategorie;
    }

    /**
     * @return string
     */
    public function getImageCategorie()
    {
        return $this->imageCategorie;
    }

    /**
     * @param string $imageCategorie
     */
    public function setImageCategorie($imageCategorie)
    {
        $this->imageCategorie = $imageCategorie;
    }



    /**
     * Set iconeCategorie
     *
     * @param string $iconeCategorie
     *
     * @return Categorie
     */
    public function setIconeCategorie($iconeCategorie)
    {
        $this->iconeCategorie = $iconeCategorie;

        return $this;
    }

    /**
     * Get iconeCategorie
     *
     * @return string
     */
    public function getIconeCategorie()
    {
        return $this->iconeCategorie;
    }
}
