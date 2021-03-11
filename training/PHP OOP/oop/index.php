<?php

include 'DbOption.php';
include 'DB.php';

$localhost = new DbOption("localhost","employee_information","root","lynadmin");

$localDB = new DB($localhost);



//ASSIGNMENT :)
//UPDATE FUNCTION

// $data = ["emp_number" => "12345678","emp_fullname" => "Joker"];



// $localDB->table('users')
//         ->where("id","1")
//         ->update($data);


// $data = $localDB->table('users')->where("id","1")->get();     

// print_r($data);
//UPDARE users set emp_number = "00028731", emp_fullname = "joker" WHERE emp_number = "028731"















//Multiple ROW
// $data = [
//     ["emp_number" => "7892581","emp_fullname" => "Mardy"],
//     ["emp_number" => "8958792","emp_fullname" => "Patrick"],
//     ["emp_number" => "3222458","emp_fullname" => "Reimond"],
//     ["emp_number" => "6878966","emp_fullname" => "Mark"],
// ];


// $localDB->table("users")->insert($data);

// // //CHAINING METHOD
// $data = $localDB->table("users")->all();

//Assignment
$data = $localDB->table("users")
                //table,foreignkey,operator,localkey
                ->join("section","section.id","=","users.section_id")
                ->leftJoin("section","section.id","=","users.section_id")
                ->rightJoin("section","section.id","=","users.section_id")
                //Table,Function
                ->leftJoin("tblsection", function($join){
                    $join->on('section.id', '=', 'users.sec_id'); //ON
                    $join->orOn('section.id', '=', 'users.sec_id'); //OR
                    $join->on('section.id', '=', 'users.sec_id'); //AND
                    $join->on('section.id', '=', 'users.sec_id'); //AND
                })

                  ->rightJoin("tblsection", function($join){
                    $join->on('section.id', '=', 'users.sec_id'); //ON
                    $join->orOn('section.id', '=', 'users.sec_id'); //OR
                   
                })
              
              
                ->get();

/*
SELECT * from users 
JOIN section ON section.id = users.section_id 
LEFT JOIN tblsection ON section.id = users.sec_id 
OR section.id = users.sec_id 
AND section.id = users.sec_id 
AND section.id = users.sec_id
*/
$localDB->method1(1,3);
echo '<pre>';
print_r($data);
echo '</pre>';




















// $data = $localDB->table("users")
                
//                 ->where("emp_fullname","Like","%jerome%")
//                 ->get();
// echo '<pre>';
// print_r($data);
// echo '</pre>';
//$data = ["emp_number"=>12345,"name"=>"leen","field1"=>1234588];

//$localDB->table("users")->insert($data);

//$insertdata = ["emp_number" => "12345","emp_fullname" => "Darwin","section" => "SD3"]

//$localDB->table("users")->insert($insertdata);

//INSERT INTO users(emp_number,emp_fullname,section) VALUES(12345,Darwin,SD3)


































// abstract class Animal
// {
//      //Acess Modifier
//     //Public , Protected,  Private
//     //ABSTRACTION
//     //Polymorphism
//     //Many Forms

//     public $name;
//     public $breed;
//     public $age;

//     public function __construct($name,$breed,$age)
//     {
//         $this->name = $name;
//         $this->breed = $breed;
//         $this->age = $age;
//     }

//     abstract public function sound();

// }

// class Giraffe extends Animal
// {   

//     public function sound()
//     {
//         echo 'numnum';
//     }

// }

// class Dog extends Animal
// {   
//     public function sound()
//     {
//         echo 'Arf';
//     }
// }

// class Cat extends Animal
// {
//     public function sound()
//     {
//         echo 'Meow';
//     }
// }

// function makesound(Animal $animal)
// {
//     $animal->sound();
// }

// $doggy = new Dog("Doggy","Askal",2);
// var_dump($doggy);
// makesound($doggy);

// $kitty = new Cat("Kitty","puskal",1);
// makesound($kitty);