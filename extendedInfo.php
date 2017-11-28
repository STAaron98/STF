<?php

class extendedInfo {
    //ATTRIBUTES
    private $id = 0;
    private $description = "";
    private $dateOfBirth = "";
    private $cardNumber = "";
    
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
        return "id: 'this->id' description: 'this->description' dateOfBirth: 'dateOfBirth' cardNumber: 'cardNumber'";
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

    public function  get_description(){
        return $this->description;
    }
    
    public function  get_dateOfBirth(){
        return $this->dateOfBirth;
    }
    public function  get_cardNumber(){
        return $this->cardNumber;
    }
    
    public function  set_description($Description){
        $this->description=$Descriptionescription;
    }
    
    public function  set_dateOfBirth($DateOfBirth){
        $this->dateOfBirth=$DateOfBirth;
    }
    public function  set_cardNumber($CardNumber){
        $this->cardNumber=$CardNumber;
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
        $sql = 'DELETE FROM extendedInfo WHERE id=?';
        $abfrage = DB::getDB()->prepare($sql);
        $abfrage->execute(array($this->get_id()));
        $this->id = 0;
    }
    
    //PRIVATE METHODS
    private function _insert() {
        $sql = 'INSERT INTO extendedInfo (description, dateOfBirth, cardNumber) '
                . 'VALUES (:description, :dateOfBirth, :cardNumber)';
        $abfrage = DB::getDB()->prepare($sql);
        $abfrage->execute($this->toArray(false));
        $this->id = DB::getDB()->lastInsertId();
    }

    private function _update() {
        $sql = 'UPDATE extendedInfo SET description = :description, dateOfBirth = '
                .':dateOfBirth, cardNumber = :cardNumber WHERE id = :id';
        $abfrage = DB::getDB()->query($sql);
        $abfrage->execute($this->toArray());
    }
    
    //FUNCTIONS
    public static function findById($id) {
        $sql = 'SELECT * FROM extendedInfo WHERE id=?';
        $abfrage = DB::getDB()->prepare($sql);
        $abfrage->execute(array($id));
        $abfrage->setFetchMode(PDO::FETCH_CLASS, 'extendedInfo');
        return $abfrage->fetch();
    }

    public static function findAll() {
        $sql = 'SELECT * FROM extendedInfo';
        $abfrage = DB::getDB()->query($sql);
        $abfrage->setFetchMode(PDO::FETCH_CLASS, 'extendedInfo');
        return $abfrage->fetchAll();
    }

    public static function findByDescription($Description) {
        $sql = 'SELECT * FROM extendedInfo WHERE description=?';
        $abfrage = DB::getDB()->prepare($sql);
        $abfrage->execute(array($Description));
        $abfrage->setFetchMode(PDO::FETCH_CLASS, 'extendedInfo');
        return $abfrage->fetch();
    }

    public static function findByDateOfBirth($DateOfBirth) {
        $sql = 'SELECT * FROM extendedInfo WHERE dateOfBirth=?';
        $abfrage = DB::getDB()->prepare($sql);
        $abfrage->execute(array($DateOfBirth));
        $abfrage->setFetchMode(PDO::FETCH_CLASS, 'extendedInfo');
        return $abfrage->fetch();
    }
    
    public static function findByCardNumber($CardNumber) {
        $sql = 'SELECT * FROM extendedInfo WHERE cardNumber=?';
        $abfrage = DB::getDB()->prepare($sql);
        $abfrage->execute(array($CardNumber));
        $abfrage->setFetchMode(PDO::FETCH_CLASS, 'extendedInfo');
        return $abfrage->fetch();
    }
}
