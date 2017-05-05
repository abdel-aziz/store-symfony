<?php

namespace Ecommerce\EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produits
 *
 * @ORM\Table(name="produits")
 * @ORM\Entity(repositoryClass="Ecommerce\EcommerceBundle\Repository\ProduitsRepository")
 */
class Produits
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
     * @ORM\Column(name="libelle", type="string", length=125, nullable=true)
     */
    private $libelle;

    /**
     * @var float
     *
     * @ORM\Column(name="prixachat", type="float", nullable=true)
     */
    private $prixachat;

    /**
     * @var float
     *
     * @ORM\Column(name="prixvente", type="float", nullable=true)
     */
    private $prixvente;
    
    /**
     * @var float
     *
     * @ORM\Column(name="tva", type="float", nullable=true)
     */
    private $tva;

  
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
 
    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Produits
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set prixachat
     *
     * @param float $prixachat
     *
     * @return Produits
     */
    public function setPrixachat($prixachat)
    {
        $this->prixachat = $prixachat;

        return $this;
    }

    /**
     * Get prixachat
     *
     * @return float
     */
    public function getPrixachat()
    {
        return $this->prixachat;
    }

    /**
     * Set prixvente
     *
     * @param float $prixvente
     *
     * @return Produits
     */
    public function setPrixvente($prixvente)
    {
        $this->prixvente = $prixvente;

        return $this;
    }

    /**
     * Get prixvente
     *
     * @return float
     */
    public function getPrixvente()
    {
        return $this->prixvente;
    }

    /**
     * Set tva
     *
     * @param float $tva
     *
     * @return Produits
     */
    public function setTva($tva)
    {
        $this->tva = $tva;

        return $this;
    }

    /**
     * Get tva
     *
     * @return float
     */
    public function getTva()
    {
        return $this->tva;
    }
}
