<?php
require_once 'AbstractModel.php';

class Employee extends AbstractModel
{
    private $id;
    private $name;
    private $age;
    private $mail;
    protected static $primaryKey = 'id';
    protected static $tableName = 'employee';
    protected static $tableScheme = array(
        'name'=> self::DATA_TYPE_STR,
        'age'=> self::DATA_TYPE_INT,
        'mail'=> self::DATA_TYPE_STR,
    );


    public function __construct($name, $age, $mail)
    {
        $this->name = $name;
        $this->age = $age;
        $this->mail = $mail;
        
    }

    public function __get($prop)
    {
        return $this->$prop;
    }
}