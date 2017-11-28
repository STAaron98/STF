<?php

class travel_address {
    //ATTRIBUTES
    private $id = 0;
    private $id_address = 0;
    private $id_travel = 0;
    
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
        return "id: 'this->id' id_address: 'this->id_address' id_travel: 'id_travel'";
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

    public function  get_id_address(){
        return $this->id_address;
    }
    
    public function  get_id_travel(){
        return $this->id_travel;
    }
    
    public function  set_id_address($Id_address){
        $this->id_address=$Id_address;
    }
    
    public function  set_id_travel($Id_travel){
        $this->id_travel=$Id_travel;
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
        $sql = 'DELETE FROM travel_address WHERE id=?';
        $abfrage = DB::getDB()->prepare($sql);
        $abfrage->execute(array($this->get_id()));
        $this->id = 0;
    }
    
    //PRIVATE METHODS
    private function _insert() {
        $sql = 'INSERT INTO travel_address (id_address, id_travel) '
                . 'VALUES (:id_address, :id_travel)';
        $abfrage = DB::getDB()->prepare($sql);
        $abfrage->execute($this->toArray(false));
        $this->id = DB::getDB()->lastInsertId();
    }

    private function _update() {
        $sql = 'UPDATE travel_address SET id_address = :id_address, id_travel = :id_travel '
                . 'WHERE id = :id';
        $abfrage = DB::getDB()->query($sql);
        $abfrage->execute($this->toArray());
    }
    
    //FUNCTIONS
    public static function findById($id) {
        $sql = 'SELECT * FROM travel_address WHERE id=?';
        $abfrage = DB::getDB()->prepare($sql);
        $abfrage->execute(array($id));
        $abfrage->setFetchMode(PDO::FETCH_CLASS, 'travel_address');
        return $abfrage->fetch();
    }

    public static function findAll() {
        $sql = 'SELECT * FROM travel_address';
        $abfrage = DB::getDB()->query($sql);
        $abfrage->setFetchMode(PDO::FETCH_CLASS, 'travel_address');
        return $abfrage->fetchAll();
    }

    public static function findById_address($Id_address) {
        $sql = 'SELECT * FROM travel_address WHERE id_address=?';
        $abfrage = DB::getDB()->prepare($sql);
        $abfrage->execute(array($Id_address));
        $abfrage->setFetchMode(PDO::FETCH_CLASS, 'travel_address');
        return $abfrage->fetch();
    }

    public static function findById_travel($Id_travel) {
        $sql = 'SELECT * FROM travel_address WHERE id_travel=?';
        $abfrage = DB::getDB()->prepare($sql);
        $abfrage->execute(array($Id_travel));
        $abfrage->setFetchMode(PDO::FETCH_CLASS, 'travel_address');
        return $abfrage->fetch();
    }
}
