<?php
include 'CamelCase.php';

class DB
{
    public $_db;
    public $_pdo;
    public $_table;
    public $_data;
    public $_Op;
    public $_stmts;
    public $_where;
    public $_wherebind = [];
    public $_set;
    public $_updatebind;
    public $_joinparms;
    public $_jointable;
    public $_on = false;
    use CamelCase;
    public function __construct(DbOption $db)
    {
        $this->_db = $db;
        $this->connect();
    }

    private function connect()
    {
        $this->_pdo = new PDO("mysql:host={$this->_db->host};dbname={$this->_db->dbname}", "{$this->_db->username}", "{$this->_db->password}");
        $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->_pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        //echo "Success!";
    }

    public function all()
    {
        $stmt = $this->_pdo->query("SELECT * FROM {$this->_table}");
        $getstmt = $stmt->fetchAll();
        echo json_encode($getstmt);
    }

    public function table($table)
    {
        $this->_table = $table;
        return $this;
    }

    /**
     * THIS METHOD IS FOR DYNAMIC INSERTING WHETHER ITS SINGLE OR MULTIPLE DATA
     * @param arrays @insertdata
     */
    private function _insert($insertdata)
    {
        $value = [];
        $keys = [];

        foreach ($insertdata as $key => $val) {
            array_push($value, $insertdata[$key]);
            array_push($keys, $key);
        }
        $ImpKeys = implode(",", $keys);
        $ImpVals = "'" . implode("','", $value) . "'";
        $bind = ":" . implode(",:", array_keys($insertdata));
        try {
            $stmt = $this->_pdo->prepare("INSERT INTO {$this->_table} ($ImpKeys) VALUES ($bind)");

            foreach ($insertdata as $key => $val) {
                $stmt->bindValue(":{$key}", $val, (is_string($val)) ? PDO::PARAM_STR : PDO::PARAM_INT);
            }
            $stmt->execute();
            echo "Success!";
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    /**
     * THIS METHID IS FOR INSETING DATA
     * @param arrays @datas
     */
    public function insert($insertdata)
    {
        if (array_key_exists('0', $insertdata)) {

            foreach ($insertdata as $data) {
                $this->_insert($data);
            }
        } else {
            $this->_insert($insertdata);
        }
    }
    // public static function testing()
    // {
    //     echo "Static function called!";
    // }

    /**
     *  @param array field
     * @param array operator
     * @param array value
     */
    public function where()
    {
        $args_count = func_num_args();
        $args_list = func_get_args();
        if ($args_count != 3) {
            $val = array_pop($args_list);
            array_push($args_list, '=', $val);
        }
        $last = array_key_last($args_list);

        if ($this->_where == '') {
            $this->_where .= "WHERE {$args_list[0]} {$args_list[1]} :{$args_list[0]}_w";
        } else {
            $this->_where .= " " . "AND {$args_list[0]} {$args_list[1]} :{$args_list[0]}_w";
        }

        $this->_wherebind[$args_list[0] . "_w"] = $args_list[2];
        return $this;
    }
    /**
     * METHOD FOR GET FUNCTION
     */
    public function get()
    {
        // try {
        //     $table = $this->_table;
        //     $where = $this->_where;
        //     $data = $this->_pdo->prepare("SELECT * FROM $table $where");
        //     print_r($data);

        //     $this->bindings($this->_wherebind, $data);
        //     $data->execute();
        //     return $data->fetchAll();
        // } catch (PDOException $th) {
        //     echo $th->getMessage();
        // }

        $join = implode(" ",$this->_join);
        echo "SELECT * FROM {$this->table} {$join}";
    }

    /**
     * @param array $data
     * new values of fields
     */
    public function update($data)
    {
        // return print_r($data);
        try {
            $table = $this->_table;
            $where = $this->_where;
            foreach ($data as $key => $val) {
                if ($this->_set == '') {
                    $this->_set .= "$key = :$key";
                    $this->_updatebind[$key] = $val;
                } else {
                    $this->_set .= "," . "$key = :$key";
                    $this->_updatebind[$key] = $val;
                }
            }
            // echo $this->_set;
            $stmt = $this->_pdo->prepare("UPDATE $table SET $this->_set $this->_where");
            $this->bindings($this->_updatebind, $stmt);
            $this->bindings($this->_wherebind, $stmt);
            print_r($stmt);
            // print_r($this->_updatebind);
            $stmt->execute();
            echo "<br>Success!";
            return $this;
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    /**
     * METHOD FOR DELETION DB VALUE FUNCTION
     */
    public function delete()
    {
        return "hello";
    }

    /**
     * METHOD FOR BINDING
     * @param arrays $datas
     * global variable _wherebind
     * @param object $stmt
     * pdo statements
     */
    public function bindings($datas, $stmt)
    {
        foreach ($datas as $key => $val) {
            $stmt->bindValue(":{$key}", $val, (is_string($val)) ? PDO::PARAM_STR : PDO::PARAM_INT);
            // print_r($data);
        }
        return $this;
    }


    public function __call($name, $arguments)
    {

     $camelcase = $name;
     $name = strtoupper($name);
     $joinfunction = ["JOIN","RIGHTJOIN","LEFTJOIN"];
     
     if(in_array($name,$joinfunction)){
        $typejoin = strtoupper(implode(" ",$this->camelsplit($camelcase)));
        if(count($arguments) > 2)
        {
            $table = $arguments[0];
            $foreignkey = $arguments[1];
            $operator = $arguments[2];
            $localkey = $arguments[3];
            $this->_joinparms[] = "$typejoin $table ON $foreignkey $operator $localkey";
        }
        else
        {
            $this->_joinGroup($arguments[0],$typejoin, $arguments[1]);
        }
        return $this;
     }

    }


    public function on($foreignkey,$operator,$localkey)
    {
        if($this->_on == false)
        {
            $this->_joinparms[] = "{$this->_jointable} ON {$foreignkey} {$operator} {$localkey}";
            $this->_on = true;
        }
        else

        {
            $this->_join[] = "AND {$foreignkey} {$operator} {$localkey}";
        }
        return $this;
    }

    public function _joinGroup($table,$type,$multipleOn)
    {
        $this->_joinparms[] = "$type";
        $this->_jointable = $table;
        $multipleOn ($this);
        return $this;
    }
    

    // public function join()
    // {
    //     $args_list = func_get_args();
    //     $atgs_count = func_num_args();
    //     $obj = $args_list[1];
    //     print_r($obj);
    //     echo "<pre>";
    //     print_r($args_list);
    //     echo "</pre>";
    //     // $args_list[1]->join();
    //     // return $table. $fk. $operator. $localkey;
    //     if ($atgs_count == 4) {
    //         echo "normal";
    //     } elseif ($atgs_count == 2) {
    //         foreach ($args_list as $i => $val) {
    //             if (!is_object($val)) {
    //                 echo "array";
    //             } else {
    //                 echo "closure";
    //             }
    //         }
    //     }
    // }
}
// class test
// {
//     public function calldb()
//     {
//         DB::testing();
//     }
// }
