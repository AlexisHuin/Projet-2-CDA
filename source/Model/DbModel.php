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

    // public function Where(array $where=[]):object
    // {
    //     $this->Where = $where;
    //     return $this;
    // }

    // public function Order(array $order=[]):object
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

        $sql    = 'UPDATE '.$this->table.' set ';

        foreach($columns as $key=>$column)
        {
            $sql   .= $column.'=:'.$column;
            if($key < (count($columns)-1))
            $sql   .= ',';
        }

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

    public function Select(string $sql, string $fetchMode = "FetchAll") : string|int|object|array
    {
        $rq = self::$db->prepare($sql);
        $rq->execute();
        
        return $rq->$fetchMode();
    }

    public function Find() : string|int|object|array
    {
        $sql    = 'SELECT * FROM '.$this->table;

        $rq = self::$db->prepare($sql);
        $rq->execute();
        
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

?>