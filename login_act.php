<?php
require_once("php/settings/db_connect.php");
require_once("php/settings/functions.php");

$account = $_POST["account"];
$password = $_POST["password"];

$data=new stdClass();

if(!(preg_match('/\S/',$account)&&
     preg_match('/\S/',$password))){
    $data->error = "尚有空白欄位\n";     
}
$fields = array(
    "password1" => $password,
    "account" => $account
);
check_input_fields($fields,$data);

if($data->error){
    echo json_encode($data);
    exit();
}
$hashed_password=ordering_hash($password);
$sql = "select * from user where account=? and password=?";
$sth = $db->prepare($sql);
$sth->execute(array($account,$hashed_password));

if($result = $sth->fetchObject()){
    start_session(1209600);
    $_SESSION["uid"]=$result->uid;
    $_SESSION["account"]=$result->account;
    $data->message="登入成功";
    $data->redirect="main.php";
}else{
    $data->error="登入失敗: 無此帳號或密碼錯誤";
}
echo json_encode($data);

?>
