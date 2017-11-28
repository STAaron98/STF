<?php

class travel {
    //ATTRIBUTES
    private $id = 0;
    private $name = "";
    private $startDate = "";
    private $endDate = "";
    private $description = "";
    private $state = 0;
    private $price = 0;
    private $id_address = 0;
    private $id_genre = 0;


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
        return "id: 'this->id' name: 'this->name' startDate: 'this->startDate' endDate: "
        . "'this->endDate' description: 'this->description' state: 'this->state' price: "
        . "'this->price' id_address: 'this->id_address' id_genre: 'this->id_genre'";
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
    
    public function  get_startDate(){
        return $this->startDate;
    }
    
    public function  get_endDate(){
        return $this->endDate;
    }
    
    public function  get_description(){
        return $this->description;
    }
    
    public function  get_state(){
        return $this->state;
    }
    
    public function  get_price(){
        return $this->price;
    }
    
    public function  get_id_address(){
        return $this->id_address;
    }
    
    public function  get_id_genre(){
        return $this->id_genre;
    }
    
    public function  set_name($Name){
        $this->name=$Name;
    }
    
    public function  set_startDate($StartDate){
        $this->startDate=$StartDate;
    }
    
    public function  set_endDate($EndDate){
        $this->endDate=$EndDate;
    }
    
    public function  set_description($Description){
        $this->description=$Description;
    }
    
    public function  set_state($State){
        $this->state=$State;
    }
    
    public function  set_price($Price){
        $this->price=$Price;
    }
    
    public function  set_id_address($Id_address){
        $this->id_address=$Id_address;
    }
    
    public function  set_id_genre($Id_genre){
        $this->id_genre=$Id_genre;
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
        $sql = 'DELETE FROM travel WHERE id=?';
        $abfrage = DB::getDB()->prepare($sql);
        $abfrage->execute(array($this->get_id()));
        $this->id = 0;
    }
    
    //PRIVATE METHODS
    private function _insert() {
        $sql = 'INSERT INTO travel (name, startDate, endDate, description, '
                . 'state, price, id_address, id_genre) '
                . 'VALUES (:name, :startDate, :endDate, :description, :state, '
                . ':price, :id_address, :id_genre)';
        $abfrage = DB::getDB()->prepare($sql);
        $abfrage->execute($this->toArray(false));
        $this->id = DB::getDB()->lastInsertId();
    }

    private function _update() {
        $sql = 'UPDATE travel SET name = :name, startDate = :startDate, '
                . 'endDate = :endDate, description = :description, '
                . 'state = :state, price = :price, id_address = :id_address, '
                . 'id_genre = :id_genre WHERE id = :id';
        $abfrage = DB::getDB()->query($sql);
        $abfrage->execute($this->toArray());
    }
    
    //FUNCTIONS
    public static function findById($id) {
        $sql = 'SELECT * FROM travel WHERE id=?';
        $abfrage = DB::getDB()->prepare($sql);
        $abfrage->execute(array($id));
        $abfrage->setFetchMode(PDO::FETCH_CLASS, 'travel');
        return $abfrage->fetch();
    }

    public static function findAll() {
        $sql = 'SELECT * FROM travel';
        $abfrage = DB::getDB()->query($sql);
        $abfrage->setFetchMode(PDO::FETCH_CLASS, 'travel');
        return $abfrage->fetchAll();
    }

    public static function findByName($Name) {
        $sql = 'SELECT * FROM travel WHERE name=?';
        $abfrage = DB::getDB()->prepare($sql);
        $abfrage->execute(array($Name));
        $abfrage->setFetchMode(PDO::FETCH_CLASS, 'travel');
        return $abfrage->fetch();
    }
    
    public static function findByStartDate($StartDate) {
        $sql = 'SELECT * FROM travel WHERE startDate=?';
        $abfrage = DB::getDB()->prepare($sql);
        $abfrage->execute(array($StartDate));
        $abfrage->setFetchMode(PDO::FETCH_CLASS, 'travel');
        return $abfrage->fetch();
    }
    
    public static function findByEndDate($EndDate) {
        $sql = 'SELECT * FROM travel WHERE endDate=?';
        $abfrage = DB::getDB()->prepare($sql);
        $abfrage->execute(array($EndDate));
        $abfrage->setFetchMode(PDO::FETCH_CLASS, 'travel');
        return $abfrage->fetch();
    }
    
    public static function findByDescription($Description) {
        $sql = 'SELECT * FROM travel WHERE description=?';
        $abfrage = DB::getDB()->prepare($sql);
        $abfrage->execute(array($Description));
        $abfrage->setFetchMode(PDO::FETCH_CLASS, 'travel');
        return $abfrage->fetch();
    }
    
    public static function findByState($State) {
        $sql = 'SELECT * FROM travel WHERE state=?';
        $abfrage = DB::getDB()->prepare($sql);
        $abfrage->execute(array($State));
        $abfrage->setFetchMode(PDO::FETCH_CLASS, 'travel');
        return $abfrage->fetch();
    }
    
    public static function findByPrice($Price) {
        $sql = 'SELECT * FROM travel WHERE price=?';
        $abfrage = DB::getDB()->prepare($sql);
        $abfrage->execute(array($Price));
        $abfrage->setFetchMode(PDO::FETCH_CLASS, 'travel');
        return $abfrage->fetch();
    }
    
    public static function findById_address($Id_address) {
        $sql = 'SELECT * FROM travel WHERE id_address=?';
        $abfrage = DB::getDB()->prepare($sql);
        $abfrage->execute(array($Id_address));
        $abfrage->setFetchMode(PDO::FETCH_CLASS, 'travel');
        return $abfrage->fetch();
    }
    
    public static function findId_genre($Id_genre) {
        $sql = 'SELECT * FROM travel WHERE id_genre=?';
        $abfrage = DB::getDB()->prepare($sql);
        $abfrage->execute(array($Id_genre));
        $abfrage->setFetchMode(PDO::FETCH_CLASS, 'travel');
        return $abfrage->fetch();
    }
}
