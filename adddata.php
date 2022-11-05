<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');

if($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    return 0;
} //Esikysely

$input = json_decode(file_get_contents('php://input'));
$description = filter_var($input->description,FILTER_UNSAFE_RAW);
$amount = filter_var($input->amount,FILTER_UNSAFE_RAW); //lisätty amount.

try{
 $db = new PDO('mysql:host=localhost;dbname=shoppinglist;charset=utf8','root',''); 
 $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

 $query = $db->prepare('insert into item(description, amount) values(:description, :amount)'); //lisätty amount.
 $query->bindValue(':description',$description,PDO::PARAM_STR);
 $query->bindValue(':amount',$amount,PDO::PARAM_INT); //lisätty amount.
 $query->execute(); 

 header('HTTP/1.1 200 OK');
 $data = array('id'=> $db->lastInsertId(),'description'=> $description, 'amount'=> $amount); //lisätty amount.
 print json_encode($data);
 }catch(PDOException $pdoex){
    header('HTTP/1.1 500 Internal Server Error');
    $error = array('error'=>$pdoex->getMessage());
    print json_encode($error);
 }

//Testattu ja datan lisääminen toimii Postmanin kautta.