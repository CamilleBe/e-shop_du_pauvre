<?php

namespace App\Models;

use App\Models\Model;

class LigneCommandeModel extends Model
{
    protected $id;
    protected $id_commande;
    protected $id_produit;

    public function __construct()
    {
        $this->table = 'ligne_commande';
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
     * Get the value of id_commande
     */
    public function getId_commande()
    {
        return $this->id_commande;
    }

    /**
     * Set the value of id_commande
     *
     * @return  self
     */
    public function setId_commande($id_commande)
    {
        $this->id_commande = $id_commande;

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
