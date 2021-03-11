<?php

include 'CamelCaseSplitable.php';

class DB
{
    public  $_db,
            $_pdo,
            $_tblname, 
            $_where = "", 
            $_join = [],
            $_joingrtable = "",
            $_on = false,
            $_whereParam = []; // DBOption instances
            
    use CamelCaseSplitable;


    public function __construct(DbOption $db)
    {
        $this->_db = $db;
        $this->connect();
    }


    private function connect()
    {
        try
        {
            $this->_pdo = new PDO("mysql:host={$this->_db->host};dbname={$this->_db->dbname}",$this->_db->username,$this->_db->password);

            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->_pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);

          
        }catch(PDOException $e)
        {
            throw new Exception( $e->getMessage());
        }
        
    }

    public function table($tblname)
    {
        $this->_tblname = $tblname;

        return $this;
    }

    /**
     * Getting all record
     */
    public function all()
    {
         $stmt = $this->_pdo->query("SELECT * from {$this->_tblname}");

        return $stmt->fetchAll();
    }


    /**
     * THIS IS METHOD IS INSERTING A RECORD
     * @param Array $datas
     */
    private function _insert(Array $datas)
    {


        $fields = "(`" . implode("`,`",array_keys($datas)) . "`)";
        $bind = "(:" . implode(",:",array_keys($datas)) . ")";
        
        
        try{

            $stmt = $this->_pdo->prepare("INSERT INTO `{$this->_tblname}` {$fields} VALUES {$bind} ");


            $stmt = $this->binding($stmt,$datas);

            $stmt->execute();

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }



    public function insert(Array $datas)
    {
    
        if(count($datas) != count($datas, COUNT_RECURSIVE)){

            foreach($datas as $data){
                $this->_insert($data);
            }

        }else{
           
            $this->_insert($datas);

        }
        //echo "INSERT INTO `{$this->_tblname}` {$fields} VALUES {$bind} ";
    }

    /**
     * Where Method
     * @param string $field
     * field of the table
     * @param string $operator
     * Operator to be used
     * @param string $value
     * Value of where condition
     */


    private function binding($stmt,Array $datas){

        foreach($datas as $key=>$value){

            $stmt->bindValue(":{$key}",$value,(is_string($value)) ? PDO::PARAM_STR : PDO::PARAM_INT);

        }

        return $stmt;
    }
   

    public function where($field,$operator,$value = null)
    {
        if($value == null)
        {
            $value = $operator;
            $operator = "=";
        }


        if($this->_where == "")
        {
            $this->_where = " WHERE `{$field}` {$operator} :whr{$field}";
        }else{
            $this->_where .= " AND `{$field}` {$operator} :whr{$field}";
        }
        $this->_whereParam["whr" . $field] =  $value;
        return $this;

    }

    public function get()
    {

        $join = implode("",$this->_join);
        
        echo "SELECT * from {$this->_tblname} {$join} {$this->_where}";

        // $stmt = $this->_pdo->prepare("SELECT * from {$this->_tblname} {$join} {$this->_where}");

       
        // $stmt = $this->binding($stmt,$this->_whereParam);
        
        // $stmt->execute();

        // $this->_where = "";
        // $this->_join = "";
        // $this->_whereParam = [];

        // return $stmt->fetchAll();
     
    }

    //["emp_number" => 28731 , "name" => jerome]
    //"emp_number"
    //"name"
    public function update(Array $datas)
    {

        $set = " SET ";
        foreach(array_keys($datas) as $field){
            $set .="`{$field}` = :updt{$field}";
            
            if($field !== array_key_last($datas))
                $set .=",";
        }

        
        echo "UPDATE {$this->_tblname} {$set}  {$this->_where}";
        try{
            //Update :updtempnumber WHEre :whrempnumber
            $stmt = $this->_pdo->prepare("UPDATE {$this->_tblname} {$set}  {$this->_where}");
        
            
            $stmt = $this->binding($stmt,  $this->createPrefix($datas,"updt")  );
            $stmt = $this->binding($stmt,  $this->_whereParam );

            $stmt->execute();

            
        }
        catch(PDOException $e)
        {
            throw new Exception($e->getMessage());
        }
        $this->_where = "";
        $this->_whereParam = [];


    }
   //updt
    private function createPrefix($array,$prefix='')
    {
            //emp_number
            //name
            $key_array = array_keys($array);

            //updtemp_number,updtname
            $key_string = $prefix.implode(',' . $prefix ,$key_array);

            //updtemp_number
            //updtname
            $key_array = explode(',', $key_string);
            //updtemp_number => value
            //updtname => value
            $array = array_combine($key_array, $array);
            return $array;
    }




















    private function clearOn()
    {
        $this->_on = false;
    }


    //VERSION 1;
    // public function join()
    // {   
        
        
    //     $args = func_get_args();

    //     //$this->clearOn();
    //     if(count($args) > 2){

    //         $table = $args[0];
    //         $foreignkey = $args[1];
    //         $operator = $args[2];
    //         $localkey = $args[3];
    //         //[
    //         //    "JOIN {$table} ON {$foreignkey} {$operator} {$localkey}",
    //         //    "LEFT JOIN {$table} ON {$foreignkey} {$operator} {$localkey}"
    //         //    "RIGHT JOIN {$table} ON {$foreignkey} {$operator} {$localkey}"
    //          //   ]
    //         $this->_join[] = " JOIN {$table} ON {$foreignkey} {$operator} {$localkey}";
            

    //     }else{

    //         $this->_joinGroup( $args[0],"JOIN", $args[1]);
    //     }
        
    //     return $this;
    // }

    // public function leftJoin($table, $foreignkey, $operator, $localkey)
    // {
        
    //     $args = func_get_args();
    //     $this->clearOn();
    //     if(count($args) > 2){

    //         $table = $args[0];
    //         $foreignkey = $args[1];
    //         $operator = $args[2];
    //         $localkey = $args[3];

    //         $this->_join[] = " LEFT JOIN {$table} ON {$foreignkey} {$operator} {$localkey}";

    //     }else{

    //         $this->_joinGroup( $args[0],"LEFT JOIN", $args[1]);

    //     }
        
    //     return $this;
    // }

    // public function rightJoin($table, $foreignkey, $operator, $localkey)
    // {
    //     $args = func_get_args();
    //     $this->clearOn();
    //     if(count($args) > 2){

    //         $table = $args[0];
    //         $foreignkey = $args[1];
    //         $operator = $args[2];
    //         $localkey = $args[3];

    //         $this->_join[] = " RIGHT JOIN {$table} ON {$foreignkey} {$operator} {$localkey}";

    //     }else{

    //         $this->_joinGroup( $args[0],"RIGHT JOIN", $args[1]);

    //     }   
    //     return $this;
    // }




    public function _joinGroup($table,$type,$multipleOn)
    {                   
        //[LEFT JOIN, table on key = key,  AND key = key,  OR key = key]
        //LEFT JOIN table on key = key AND key = key OR key = key
        $this->_join[] = " {$type} ";
        $this->_joingrtable = $table;
        $multipleOn( $this );
        return $this;
    }


    public function on($foreignkey, $operator, $localkey)
    {   
        if($this->_on == false){

            $this->_join[] = " {$this->_joingrtable} ON {$foreignkey} {$operator} {$localkey}";
           
            $this->_on = true;
        }else{
            $this->_join[] = " AND {$foreignkey} {$operator} {$localkey}";
        }
        
        return $this;
    }

    public function orOn($foreignkey, $operator, $localkey)
    {   
        if($this->_on == false){
            $this->_join[] = " {$this->_joingrtable} ON {$foreignkey} {$operator} {$localkey}";
            $this->_on = true;
        }else{
            $this->_join[] = " OR {$foreignkey} {$operator} {$localkey}";
        }
        
        return $this;
    }

    //OBJECT->METHOD1(1,3)
    //VERSION 2
    public function __call($name,$arguments)
    { 

      
        $camelcase = $name;
        //leftJoin
        //sql left join right join
        $name = strtoupper($name);
        //LEFTJOIN
        //RIGHTJOIN
        //JOIN
        $joinfunction = ["JOIN","RIGHTJOIN","LEFTJOIN"];

        
        if(in_array($name,$joinfunction)){
            
            $this->clearOn();
                                        //"LEFT JOIN"
            $typejoin = strtoupper(implode(" " ,$this->ccsplit($camelcase)));
            if(count($arguments) > 2){

                $table = $arguments[0];
                $foreignkey = $arguments[1];
                $operator = $arguments[2];
                $localkey = $arguments[3];

                $this->_join[] = " {$typejoin} {$table} ON {$foreignkey} {$operator} {$localkey}";

            }else{
                                    //table , typejoin , function()
                $this->_joinGroup( $arguments[0],$typejoin, $arguments[1]);
            
            }

            return $this;

        }

       
    }
}