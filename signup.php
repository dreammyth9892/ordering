<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>註冊介面</title>
    <script src="./js/jquery-2.1.1.min.js"></script> 
    <script src="./js/jquery.form.min.js"></script>
    <script src="./js/functions.js"></script>  
    <script>
$(document).ready(function(){
    $('#signup_form').ajaxForm({
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
    <form method="POST" action="signup_act.php" id="signup_form">
        <p> 帳號 <input type="text" name="account" /></p>
        <p> 密碼 <input type="password" name="password" /></p>
        <p> 確認密碼 <input type="password" name="password_confirm" /></p>
        <p> 暱稱 <input type="text" name="name" /></p>
        <input type="submit" value="送出"/>
    </form>
    <button onclick="location.href='login.php'">返回</button>
</body>
</html>
