<?php
namespace Model;

use PDO;
class DbModel
{
    static $db=null;
    private array $datas;
    private array $where= [];
    private array $order=[];

    static function Connect() : void
    {
        if(is_null(self::$db))
        {
            $dsn    = 'mysql:host='.DB_HOST.';dbname='.DB_NAME;
            try {
                self::$db =  new PDO($dsn,DB_USER,DB_PASSWORD);
                self::$db->exec("SET NAMES 'UTF8'");
                self::$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }
    }
    
    public function __construct()
    {
        self::Connect();
    }
    public function __set($var,$value)
    {
        $this->datas[$var] = $value;
    }

    public function __get($var)
    {
        return $this->datas[$var];
    }

    public function Where(object $Object, string|int|array $whereVal, string|array $property = 'id'): int|string|array|object
    {
        if(is_array($property)){
            for($i = 0; $i < count($property); $i++){
                $cleanProp = stripslashes($property[$i]);
                $whereCond = $Object->$cleanProp;
                $this->where[$whereCond] = $whereVal[$i];
            }
        }
        else{
            $this->where[$Object->$property] = $whereVal;
        }

        return $this->where;
    }

    // public function Order(array $order=[]): int|string|array|object
    // {
    //     $this->Ohere = $order;
    //     return $this;
    // }
    
    public function Save() : string|int|object|array
    {
        $columns = array_keys($this->datas);

        $sql    = 'INSERT into '.$this->table.' set ';

        foreach($columns as $key=>$column)
        {
            $sql   .= $column.'=:'.$column;
            if($key < (count($columns)-1))
            $sql   .= ',';
        }
        
        $rq = self::$db->prepare($sql);
        $rq->execute($this->datas);
        return self::$db->lastInsertId();
    }
    public function Update() : string|int|object|array
    {
        $columns = array_keys($this->datas);

        $sql    = 'UPDATE '.$this->table.' SET ';

        foreach($columns as $key=>$column)
        {
            $sql   .= $column.'=:'.$column;
            if($key < (count($columns)-1))
            $sql   .= ', ';
        }

        $whereConds = array_keys($this->where);
        $whereVals = array_values($this->where);
        
        $sql .= " WHERE ";

        for($i = 0; $i < count($whereConds); $i++){
            $i > 0 ? $And = ' AND ': $And = "";

            $sql .= $And . $whereConds[$i] . " = " . $whereVals[$i];
        }

        // echo $sql;die;
        // var_dump($this->datas);die;

        $rq = self::$db->prepare($sql);
        return $rq->execute($this->datas);
    }

    public function Delete() : string|int|object|array
    {
        $columns = array_keys($this->datas);

        $sql    = 'DELETE FROM '.$this->table.' WHERE ';

        foreach($columns as $key=>$column)
        {
            $sql   .= $column.'=:'.$column;
            if($key < (count($columns)-1))
            $sql   .= ' AND ';
        }

        $rq = self::$db->prepare($sql);
        return $rq->execute($this->datas);
    }
   public function Select(string $sql,array $datas=[], string $fetchMode = "FetchAll") : string|int|object|array
   {
        $rq = self::$db->prepare($sql);
        $rq->execute($datas);
        
        return $rq->$fetchMode();
    }

    public function Find() : string|int|object|array
    {
        $sql    = 'SELECT * FROM '.$this->table;

        $rq = self::$db->prepare($sql);
        $rq->execute();
        
        return $rq->fetchAll();
    }

    public function FindSpecific(bool $not = false) : string|int|object|array
    {
        $columns = array_keys($this->datas);

        $sql    = 'SELECT * FROM '.$this->table.' WHERE ';

        foreach($columns as $key=>$column)
        {
            if($not == true){
                $sql   .= $column . '!=:' . $column;
            }
            $sql   .= $column . '=:' . $column;
            if($key < (count($columns)-1))
            $sql   .= ',';
        }

        $rq      = self::$db->prepare($sql);
        $rq->execute($this->datas);
        
        return $rq->fetchAll();
    }

    public function FindOne() : string|int|object|array
    {
        $columns = array_keys($this->datas);

        $sql    = 'SELECT * FROM '.$this->table.' WHERE ';

        foreach($columns as $key=>$column)
        {
            $sql   .= $column . '=:' . $column;
            if($key < (count($columns)-1))
            $sql   .= ',';
        }

        $sql    .= ' LIMIT 1';
        $rq      = self::$db->prepare($sql);
        $rq->execute($this->datas);
        
        return $rq->fetch();
    }
}
