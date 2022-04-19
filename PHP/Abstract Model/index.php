<?php
require_once 'db.php';
require_once 'AbstractModel.php';
require_once 'Employee.php';

/*
$emp = new Employee('mohamed', 34, 'mo@yahoo.com');
$emp->save();
Employee::getByPK(5)->delete();
//echo $emp->name;
*/

$emp = Employee::get(
    'SELECT * FROM employee WHERE age=:age',
    array(
        'age' => array(Employee::DATA_TYPE_INT, 34)
    ));
//echo $emp->name;
echo "<pre>";
//var_dump(Employee::getAll());
var_dump($emp);
echo "</pre>";


