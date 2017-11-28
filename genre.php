<?php

class genre {
    //ATTRIBUTES
    private $id = 0;
    private $name = "";
    
    //CONSTRUCTOR
    public function __construct($data = array()) {
        if ($data) {
            foreach ($data as $k => $v) {
                $setterName = 'set_' . $k;
                if (method_exists($this, $setterName)) {
                    $this->$setterName($v);
                }
            }
        }
    }
    
    //NOT WORKING
    public function __toString() {
        return "id: 'this->id' name: 'this->name'";
    }
    public function toArray($withId = true) {
            $attribute = get_object_vars($this);
            if ($withIdId === false) {
                    // wenn $withId false ist, entferne den Schluessel
                    // id aus dem Ergebnis
                    unset($attribute['id']);
            }
            return $attribute;
    }
    
    //GETTER AND SETTER
    public function set_id($id) {
        $this->id = $id;
    }

    public function get_id() {
        return $this->id;
    }

    public function  get_name(){
        return $this->name;
    }
    
    public function  set_name($Name){
        $this->name=$Name;
    }
    
    
    //PUBLIC METHODS
    public function save() {
        if ($this->get_id() > 0) {
            $this->_update();
        } else {
            $this->_insert();
        }
    }

    public function delete() {
        $sql = 'DELETE FROM genre WHERE id=?';
        $abfrage = DB::getDB()->prepare($sql);
        $abfrage->execute(array($this->get_id()));
        $this->id = 0;
    }
    
    //PRIVATE METHODS
    private function _insert() {
        $sql = 'INSERT INTO genre (name) '
                . 'VALUES (:name)';
        $abfrage = DB::getDB()->prepare($sql);
        $abfrage->execute($this->toArray(false));
        $this->id = DB::getDB()->lastInsertId();
    }

    private function _update() {
        $sql = 'UPDATE genre SET name = :name WHERE id = :id';
        $abfrage = DB::getDB()->query($sql);
        $abfrage->execute($this->toArray());
    }
    
    //FUNCTIONS
    public static function findById($id) {
        $sql = 'SELECT * FROM genre WHERE id=?';
        $abfrage = DB::getDB()->prepare($sql);
        $abfrage->execute(array($id));
        $abfrage->setFetchMode(PDO::FETCH_CLASS, 'genre');
        return $abfrage->fetch();
    }

    public static function findAll() {
        $sql = 'SELECT * FROM genre';
        $abfrage = DB::getDB()->query($sql);
        $abfrage->setFetchMode(PDO::FETCH_CLASS, 'genre');
        return $abfrage->fetchAll();
    }

    public static function findByName($Name) {
        $sql = 'SELECT * FROM genre WHERE name=?';
        $abfrage = DB::getDB()->prepare($sql);
        $abfrage->execute(array($Name));
        $abfrage->setFetchMode(PDO::FETCH_CLASS, 'genre');
        return $abfrage->fetch();
    }

}
