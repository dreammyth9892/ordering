<?php
    require_once("php/settings/db_connect.php");
    require_once("php/settings/functions.php");
    start_session(1209600);
    if(isset($_SESSION["uid"])){
        header( 'Location: ./main.php' ) ;
    }
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>登入介面</title>
    <script src="./js/jquery-2.1.1.min.js"></script> 
    <script src="./js/jquery.form.min.js"></script>
    <script src="./js/functions.js"></script>  
    <script>
$(document).ready(function(){
    $('#login_form').ajaxForm({
        dataType:'json',
        success:function(data){
            if(data.error){
                 alert(data.error);
            }else{
                 alert(data.message);
                 redirect("./"+data.redirect);
            }
        }
    });
});
    </script>
</head>
<body>
    <form method="POST" action="login_act.php" id="login_form">
        <p> 帳號 <input type="text" name="account" /></p>
        <p> 密碼 <input type="password" name="password" /></p>
        <input type="submit" value="送出"/>
    </form>
    <button onclick="location.href='signup.php'">註冊</button>
</body>
</html>
