<?php

class AbstractModel
{
    // Constant Data Types
    const DATA_TYPE_INT = PDO::PARAM_INT;
    const DATA_TYPE_BOOL = PDO::PARAM_BOOL;
    const DATA_TYPE_STR = PDO::PARAM_STR;
    const DATA_TYPE_DECIMAL = 3;

    public static function viewTableScheme()
    {
        return static::$tableScheme;
    }

    private static function buildNamedParametersSQL()
    {
        $namedParameters ='';
        foreach(static::$tableScheme as $columnName => $type){
            $namedParameters .= $columnName.'=:'.$columnName.', ';
        }

        return trim($namedParameters, ', ');
    }

    private function create()
    {
        global $connection;
        $sql = 'INSERT INTO '.static::$tableName.' SET '.self::buildNamedParametersSQL();
        //echo $sql;
        $stmt = $connection->prepare($sql);
        $this->prepareValues($stmt);
        return $stmt->execute();
    }

    private function prepareValues(PDOStatement &$stmt)
    {
        foreach(static::$tableScheme as $columnName => $type){
            if($type == 3)
            {
                $sanitizedValue = filter_var($this->$columnName, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $stmt-> bindValue(":{$columnName}", $sanitizedValue);
            } else {
                $stmt->bindValue(":{$columnName}", $this-> $columnName);
            }
        }
    }

    private function update()
    {
        global $connection;
        $sql = 'UPDATE '.static::$tableName.' SET '.self::buildNamedParametersSQL().' WHERE '.static::$primaryKey.' = '.$this->{static::$primaryKey};
        $stmt = $connection->prepare($stmt);
        $this->prepareValues($stmt);
        return $stmt->execute();
    }

    public function save()
    {
        return $this->{static::$primaryKey} === null ? $this->create() : $this->update();
    }
    public function delete()
    {
        global $connection;
        $sql = 'DELETE FROM '.static::$tableName.'  WHERE '.static::$primaryKey.' = '.$this->{static::$primaryKey};
        //echo $sql;
        $stmt = $connection->prepare($sql);
        return $stmt->execute();
    }

    public static function getAll()
    {
        global $connection;
        $sql = 'SELECT * FROM '.static::$tableName;
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableScheme)) ;
        return (is_array($result) && !empty($result)) ? $result : false;
    }

    public static function getByPK($pk)
    {
        global $connection;
        $sql = 'SELECT * FROM '.static::$tableName.' WHERE '.static::$primaryKey.' = '.$pk;
        //echo $sql;
        $stmt = $connection->prepare($sql);
        if($stmt->execute()){
            $result = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableScheme)) ; 
            return array_shift($result);
        }
        return false;
        
    }

    public static function get($sql, $options = array())
    {
        global $connection;
        $stmt = $connection->prepare($sql);
        if(!empty($options))
        {
            foreach($options as $columnName => $type){
                if($type[0] == 3)
                {
                    $sanitizedValue = filter_var($this->$columnName, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $stmt-> bindValue(":{$columnName}", $sanitizedValue);
                } else {
                    $stmt->bindValue(":{$columnName}", $type[1]);
                }
            }
            
        }

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableScheme)) ;
        return (is_array($result) && !empty($result)) ? $result : false;
    }

}