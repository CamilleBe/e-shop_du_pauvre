<?php

namespace App\Models;

use App\Models\ProductModel;

class TelephoneModel extends ProductModel
{
    protected $id;
    protected $marque;
    protected $modele;
    protected $stockage;
    protected $image;
    protected $id_produit;

    public function __construct()
    {
        $this->table = "telephones";
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of marque
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Set the value of marque
     *
     * @return  self
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get the value of modele
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * Set the value of modele
     *
     * @return  self
     */
    public function setModele($modele)
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * Get the value of stockage
     */
    public function getStockage()
    {
        return $this->stockage;
    }

    /**
     * Set the value of stockage
     *
     * @return  self
     */
    public function setStockage($stockage)
    {
        $this->stockage = $stockage;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of id_produit
     */
    public function getId_produit()
    {
        return $this->id_produit;
    }

    /**
     * Set the value of id_produit
     *
     * @return  self
     */
    public function setId_produit($id_produit)
    {
        $this->id_produit = $id_produit;

        return $this;
    }
}
