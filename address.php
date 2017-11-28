<?php

class address {
    //ATTRIBUTES
    private $id = 0;
    private $city = "";
    private $country = "";
    
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
        return "id: 'this->id' city: 'this->city' country: 'country'";
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

    public function  get_city(){
        return $this->city;
    }
    
    public function  get_country(){
        return $this->country;
    }
    
    public function  set_city($City){
        $this->city=$City;
    }
    
    public function  set_country($Country){
        $this->country=$Country;
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
        $sql = 'DELETE FROM address WHERE id=?';
        $abfrage = DB::getDB()->prepare($sql);
        $abfrage->execute(array($this->get_id()));
        $this->id = 0;
    }
    
    //PRIVATE METHODS
    private function _insert() {
        $sql = 'INSERT INTO address (city, country) '
                . 'VALUES (:city, :country)';
        $abfrage = DB::getDB()->prepare($sql);
        $abfrage->execute($this->toArray(false));
        $this->id = DB::getDB()->lastInsertId();
    }

    private function _update() {
        $sql = 'UPDATE address SET city = :city, country = :country '
                . 'WHERE id = :id';
        $abfrage = DB::getDB()->query($sql);
        $abfrage->execute($this->toArray());
    }
    
    //FUNCTIONS
    public static function findById($id) {
        $sql = 'SELECT * FROM address WHERE id=?';
        $abfrage = DB::getDB()->prepare($sql);
        $abfrage->execute(array($id));
        $abfrage->setFetchMode(PDO::FETCH_CLASS, 'address');
        return $abfrage->fetch();
    }

    public static function findAll() {
        $sql = 'SELECT * FROM address';
        $abfrage = DB::getDB()->query($sql);
        $abfrage->setFetchMode(PDO::FETCH_CLASS, 'address');
        return $abfrage->fetchAll();
    }

    public static function findByCity($City) {
        $sql = 'SELECT * FROM address WHERE city=?';
        $abfrage = DB::getDB()->prepare($sql);
        $abfrage->execute(array($City));
        $abfrage->setFetchMode(PDO::FETCH_CLASS, 'address');
        return $abfrage->fetch();
    }

    public static function findByCountry($Country) {
        $sql = 'SELECT * FROM address WHERE country=?';
        $abfrage = DB::getDB()->prepare($sql);
        $abfrage->execute(array($Country));
        $abfrage->setFetchMode(PDO::FETCH_CLASS, 'address');
        return $abfrage->fetch();
    }
}
