<?php
    require_once("php/settings/db_connect.php");
    require_once("php/settings/functions.php");
    start_session(1209600);
    if(!isset($_SESSION["uid"])){
        header( 'Location: ./main.php' ) ;
    }
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>主頁面</title>
    <script src="./js/jquery-2.1.1.min.js"></script> 
    <script src="./js/jquery.form.min.js"></script>
    <script src="./js/functions.js"></script>  
    <script>
    </script>
</head>
<body>
    目前的訂單

    新增訂單
    我的訂單
    餐廳們

</body>
</html>
