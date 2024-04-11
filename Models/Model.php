<?php
namespace App\Models;

use App\Db\Database;

class Model extends Database{
    /**
     * propriétés de ma classe
     */
    protected $table;
    private $db;

    public function sqlQuery(string $query, array $attributs = null){
        /**
         * PROCESS :
         * - Récupérer ou créer l'instance de Database.
         * - Exécuter une requête (simple => $attributs = null, requête préparée => $attributs = [datas])
         */
        // On récupère ou crée l'instance de Database
        $this->db = Database::getInstance();

        // On vérifie si on a des attributs
        if($attributs !== null ){
            // Requête préparée puis exécution de la requête avec des valeurs spécifiques.
            // Requête non modifiable depuis l'extérieur (injection)
            $querySQL = $this->db->prepare($query);
            $querySQL->execute($attributs);
            return $querySQL;
        }else{
            // requête simple
            return $this->db->query($query);
        }
    }

    /**
     * Méthodes CRUD
     */

    public function findAll()
    {
        $querySQL = $this->sqlQuery("SELECT * FROM $this->table");
        return $querySQL->fetchAll();
    }

    public function find(int $id) {
        $querySQL = $this->sqlQuery("SELECT * FROM $this->table WHERE id = $id");
        return$querySQL->fetch();
    }

    public function findBy(array $attributs)
    {
        $fields = [];
        $values = [];

        foreach($attributs as $field => $value){
            $fields[] = "$field = ?";
            $values[] = $value;
        }
        $listFields = implode('AND',$fields);
        $querySQL = $this->sqlQuery("SELECT * FROM $this->table WHERE $listFields" , $values);
        return $querySQL->fetchAll();
    }

    public function create(Model $model)
    {
        $fields = [];
        $inter = [];
        $values = [];

        foreach($model as $field => $value){
            //var_dump($field);
            if ($value !== null && $field !== 'db' && $field !== 'table'){
                $fields[] = $field;
                $inter[] = '?';
                $values[] = $value;
            }
        }

        $listFields = implode(',',$fields);
        $listInter = implode(',',$inter);

        return $this->sqlQuery("INSERT INTO $this->table ($listFields) VALUES ($listInter)", $values);
    }

    //HYDRATATION
    public function hydrate(array $datas)
    {
        foreach ($datas as $key => $value) {
            $setter = 'set'.ucfirst($key);

            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }
        return $this;
    }

    //DELETE
    public function delete(int $id)
    {
        return $this->sqlQuery("DELETE FROM $this->table WHERE id = ?", [$id]);
    }

    //UPDATE
    public function update(int $id, Model $model)
    {
        $fields = [];
        $values = [];

        foreach($model as $key => $value){

            if ($value !== null && $key !== 'db' && $key !== 'table'){
                $fields[] = "$key = ?";
                $values[] = $value;
            }
        }

        $values[] = $id;
        $listFields = implode(',',$fields);

        return $this->sqlQuery("UPDATE $this->table SET $listFields WHERE id = ?" , $values);
    }
}

