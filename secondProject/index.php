
<h1>Калькулятор</h1>

<form name="authForm" method="GET" action="<?=$_SERVER['PHP_SELF']?>">
    a:<input type="text" name="a">
    comand:<input type="text" name="comand">
    b:<input type="text" name="b">
    <input type="submit">
</form>
<?php
spl_autoload_register(function ($class_name) {
    require  'source/'. $class_name . '.php';
});

$calk= new Calkulator();

$a=isset($_GET['a']) ? $_GET['a'] : 0;
$b=isset($_GET['b']) ? $_GET['b'] : 0;
$comand=isset($_GET['comand']) ? $_GET['comand'] : '+';

if($comand=='+')$rez=$calk->dodv($a, $b);
if($comand=='-')$rez=$calk->vidn($a, $b);
if($comand=='*')$rez=$calk->mnoch($a, $b);
if($comand=='/')$rez=$calk->dilen($a, $b);
echo $a . ' ' . $comand . ' ' . $b . '=' . $rez ;