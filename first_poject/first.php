<?php

 abstract class People
 {
 abstract function outData();
 }

class realPeople extends People{
public $rost=170;
public $weight=65;
private$name;
 public function setName($arg="default"){
    $this->name=$arg;
}
    function outData()
    {
        echo $this->name ." weight:". $this->weight ." rost:". $this->rost;
    }
    function getName(){
     return $this->name;
    }
}
$people=new realPeople();
 $people->setName(" Olexsey");
$people->rost=192;
$people->weight=89;
$people->outData();

$people2 = new realPeople();
$people2->setName($people->getName());
$people2->outData();