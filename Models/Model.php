<?php

namespace App\Models;

use App\Db\Database;

class Model extends Database
{
    /**
     * propriétés de ma classe
     */
    protected $table;
    private $db;

    public function sqlQuery(string $query, array $attributs = null)
    {
        /**
         * PROCESS :
         * - Récupérer ou créer l'instance de Database.
         * - Exécuter une requête (simple => $attributs = null, requête préparée => $attributs = [datas])
         */
        // On récupère ou crée l'instance de Database
        $this->db = Database::getInstance();

        // On vérifie si on a des attributs
        if ($attributs !== null) {
            // Requête préparée puis exécution de la requête avec des valeurs spécifiques.
            // Requête non modifiable depuis l'extérieur (injection)
            $querySQL = $this->db->prepare($query);
            $querySQL->execute($attributs);
            return $querySQL;
        } else {
            // requête simple
            return $this->db->query($query);
        }
    }

    /**
     * Méthodes CRUD => Create Read Update Delete
     */
    // findAll() => Select * from nom_table;
    public function findAll()
    {
        $querySQL = $this->sqlQuery("SELECT * FROM $this->table");
        return $querySQL->fetchAll();
    }

    // find() => select * from nom_table where id = X;
    public function find(int $id)
    {
        $querySQL = $this->sqlQuery("SELECT * FROM $this->table WHERE id = $id");
        return $querySQL->fetch();
        // return $this->sqlQuery("SELECT * FROM $this->table WHERE id = $id")->fetch();
    }

    // findBy() => select * from nom_table where ATTR1 = ? and ATTR2 = ?;
    /**
     *  $attributs = [
     *  'nom' => 'N%',
     *  'email' => '%@test.fr',
     *  ...
     *  ]
     */
    public function findBy(array $attributs)
    {
        $fields = [];
        $values = [];

        // Eclater le tableau $attributs afin de pouvoir récupérer les clés et les valeurs.
        foreach ($attributs as $field => $value) {
            $fields[] = "$field = ?";
            $values[] = $value;
        }

        //Création de la 2nd partie de la requête SQL (après clause WHERE)
        $listFields = implode('AND ', $fields);

        //Executer la requête SQL
        $querySQL = $this->sqlQuery("SELECT * FROM $this->table WHERE $listFields", $values);
        return $querySQL->fetchAll();
    }

    //-----------CREATE------------
    public function create(Model $model)
    {
        $fields = [];
        $inter = []; // Contenir les ? pour créer la chaîne (?, ?, ?)
        $values = [];

        // Eclater l'objet $model pour récupérer les clés et les valeurs.
        foreach ($model as $field => $value) {
            // var_dump($field);
            //Condition pour gérer que les informations de l'entité manipulée (hors 'db', 'table' et les valeurs NULL)
            if ($value !== null && $field !== 'db' && $field !== 'table') {
                $fields[] = $field;
                $inter[] = '?';
                $values[] = $value;
            }
        }

        // Générer les strings pour les clauses INSERT INTO / VALUES
        $listFields = implode(',', $fields);
        $listInter = implode(',', $inter);

        // Execution de la requête SQL
        return $this->sqlQuery("INSERT INTO $this->table ($listFields) VALUES ($listInter)", $values);
    }

    //------HYDRATATION-------
    public function hydrate(array $datas)
    {
        foreach ($datas as $key => $value) {
            $setter = 'set' . ucfirst($key); // Exemple : $value = "nom" => setNom
            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }
        return $this;
    }

    //------UPDATE------
    public function update(int $id, Model $model)
    {
        $fields = [];
        $values = [];

        foreach ($model as $key => $value) {
            // Condition permettant de ne pas gérer les propriétés de la classe mère Model et les champs NULL.
            if ($value !== null && $key !== 'db' && $key !== 'table') {
                $fields[] = "$key = ?";
                $values[] = $value;
            }
        }
        // Ajout de l'id en dernier (clause WHERE)
        $values[] = $id;

        $listFields = implode(',', $fields);

        return $this->sqlQuery("UPDATE $this->table SET $listFields WHERE id = ?", $values);
    }


    //------DELETE------
    public function delete(int $id)
    {
        return $this->sqlQuery("DELETE FROM $this->table WHERE ID = ?", [$id]);
    }
}
