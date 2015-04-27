<?php
require_once("php/settings/db_connect.php");
require_once("php/settings/functions.php");

$account = $_POST["account"];
$password = $_POST["password"];
$password_confirm = $_POST["password_confirm"];
$name = $_POST["name"];

$data=new stdClass();

if(!(preg_match('/\S/',$account)&&
     preg_match('/\S/',$password)&&
     preg_match('/\S/',$password_confirm)&&
     preg_match('/\S/',$name))){
    $data->error .= "尚有空白欄位\n";
}
$fields = array(
    "password1" => $password,
    "password2" => $password_confirm,
    "account" => $account,
    "name" => $name
);
check_input_fields($fields,$data);

if($data->error){
    echo json_encode($data);
    exit();
}
// check for existing user
$sql = "select * from user where account=?";
$sth = $db->prepare($sql);
$sth->execute(array($account));
if($result = $sth->fetchObject()){
     $data->error.="註冊失敗: 該帳號已被註冊\n";
}
if($data->error){
    echo json_encode($data);
    exit();
}
$hashed_password=ordering_hash($password);
$sql = "INSERT INTO user(account,password,name,admin) VALUES(? ,?, ? ,?)";
$sth = $db->prepare($sql);
$sth->execute(array($account,$hashed_password,$name, 0));

$data->message="註冊成功";
$data->redirect="login.php"; 
echo json_encode($data);
?>
