<?php
ini_set("display_errors", "On");
error_reporting(E_ALL | E_STRICT);

//
//$m = new MongoClient("mongodb://admin:admin@localhost:27017");
//$db = $m->test;
//$collection = $db->test1;
//$array = array('name'=>'melon','age'=>'24','sex'=>'Male','birth'=>array('year'=>'1988','month'=>'07','day'=>'13'));
//$collection->insert($array);
//$cursor = $collection->find();
//foreach ($cursor as $id => $value) {
//    echo "$id: "; var_dump($value); echo "<br>";
//}

$arr = array('a'=>'aaa','b'=>'bbb','c'=>'ccc');
extract($arr);
echo $a.$b.$c;