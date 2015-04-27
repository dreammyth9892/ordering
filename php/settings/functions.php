<?php
// password hash
function ordering_hash($string){
    return hash("sha256",$string."ggg") . hash("md5",$string."syd");
}
function start_session($expire = 0){
    if ($expire == 0) {
        $expire = ini_get('session.gc_maxlifetime');
    } else {
        ini_set('session.gc_maxlifetime', $expire);
    }
    if (empty($_COOKIE['PHPSESSID'])) {
        session_set_cookie_params($expire, "/", "", FALSE, TRUE);
        session_start();
    } else {
        session_start();
        setcookie('PHPSESSID', session_id(), time() + $expire,"/","",FALSE,TRUE);
    }
}
// convert null to emptry string
function null_to_empty_string($val){
    if(is_null($val)){
        return "";
    }
    else{
        return $val;
    }
}

function check_have_critical_character($source){
    return strlen($source) != strlen(strip_tags($source)); // 阻擋HTML關鍵字
}

function check_input_fields($fields,$data){
    // 空值欄位自動轉為空字串    
    $fields = array_map("null_to_empty_string",$fields);
    // check password match
    if(array_key_exists("password1",$fields)&&array_key_exists("password2",$fields)){
        if($fields['password1']!=$fields['password2']){
            $data->error.="密碼與確認密碼不符\n";
        }
    }
    //check for special char in username
    if(array_key_exists("account",$fields)){
        if (strlen($fields['account'])>32){
            $data->error.="'帳號'欄位長度過長 請縮短長度\n";
        }
        if (preg_match('/[^a-zA-Z0-9_]/', $fields["account"])){
            $data->error.="'帳號'欄位僅限英數字及底線\n";
        }
    }
    //check for special char in password1
    if(array_key_exists("password1",$fields)){
        if (strlen($fields['password1'])>128){
            $data->error.="'密碼'欄位長度過長 請縮短長度\n";
        }
        if (check_have_critical_character($fields['password1'])){
        //$data->error.="Special characters in password\n";
            $data->error.="'密碼'欄位內含違法字元\n";
        }
    }  
    //check for special char in password2
    if(array_key_exists("password2",$fields)){
        if (strlen($fields['password2'])>128){
            $data->error.="'確認密碼'欄位長度過長 請縮短長度\n";
        }
        if (check_have_critical_character($fields['password2'])){
            $data->error.="'確認密碼'欄位內含違法字元\n";
        }
    }
    if(array_key_exists("name",$fields)){
        // check for special char in realname
        if (strlen($fields['name'])>64){
            $data->error.="'暱稱'欄位長度過長 請縮短長度\n";
    }
        if (preg_match('/(*UTF8)[\'^£$%&*()}{@#~?!><>,|=_+¬]/', $fields['name'])||check_have_critical_character($fields['name'])){
            $data->error.="'暱稱'欄位內含違法字元\n";
        }
    }

}
?>
