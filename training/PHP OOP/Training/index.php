<?php
include 'DbOption.php';
include 'DB.php';
include 'acsmdf.php';

$localhost = new DbOption('localhost','practicesql','root','admin');

$localDB  = new DB($localhost);
// $localDB->all();

            
// $insertdata = (array)["LASTNAME"=>"SUR","FIRSTNAME"=>"FN","AREACODE"=>"123","PHONE"=>"111-7777","ST"=>"RS","ZIP"=>"4103"];
$insertdata = (array)[
            ["LASTNAME"=>"SUR1","FIRSTNAME"=>"FN1","AREACODE"=>"1231","PHONE"=>"111-77771","ST"=>"RS1","ZIP"=>"41031"],
            ["LASTNAME"=>"SUR2","FIRSTNAME"=>"FN2","AREACODE"=>"1232","PHONE"=>"111-77772","ST"=>"RS2","ZIP"=>"41032"],
            ["LASTNAME"=>"SUR3","FIRSTNAME"=>"FN3","AREACODE"=>"1233","PHONE"=>"111-77773","ST"=>"RS3","ZIP"=>"41033"],
            ["LASTNAME"=>"SUR4","FIRSTNAME"=>"FN4","AREACODE"=>"1234","PHONE"=>"111-77774","ST"=>"RS4","ZIP"=>"41034"]
            ];  

// $localDB->table("friends")->insert($insertdata);

// $data = $localDB->table("friends")
// ->where("FIRSTNAME","LIKE","%FN%")
// ->where("ID","LIKE","%3%")
// ->get();


// $data = $localDB->table("friends")
// ->where("FIRSTNAME","LIKE","%FN%")
// ->where("ID","39")
// ->get();

$inputs = ["ID" => "45","PHONE"=>"476-0465","ST"=>"HTI"];

// update function
// $data = $localDB->table("friends")
// ->where("ID","44")
// ->update($inputs);

// access modifiers testing
// $accessmodi = new childClass();
// $accessmodi->setattr1("test");

// $data = $localDB->table("friends")
// ->where("FIRSTNAME","FN")
// ->delete();

// join funciton
$data = $localDB->table("friends")
// ->join("table",'fk.id','=','lk.id');

->join("table",function($join){
    $join->on('tablenew','fk.id','=','lk.id');
})
->get();


echo "<pre>";
print_r($data);
echo "</pre>";
?>