<?php

if(isset($_POST['user_request_tokken']) AND $_POST['user_request_tokken'] == 1) {
    
    $userName           = isset($_POST['user_name'           ]) ? $_POST['user_name'    ] : '';
    $userFname          = isset($_POST['user_fname'          ]) ? $_POST['user_fname'   ] : '';
    $userLname          = isset($_POST['user_lname'          ]) ? $_POST['user_lname'   ] : '';
    $userEmail          = isset($_POST['user_email'          ]) ? $_POST['user_email'   ] : '';
    $userPass           = isset($_POST['user_pass'           ]) ? $_POST['user_pass'    ] : '';
    $userPassRepeat     = isset($_POST['user_pass_repeat'    ]) ? $_POST['user_pass_repeat'    ] : '';
    
    
    if(strlen($userName)    < 3)        return;
    if(strlen($userFname)   < 3)        return;
    if(strlen($userLname)   < 3)        return;
    if(strlen($userLname)   < 5)        return;
    if($userPass != $userPassRepeat)    return;
    
    $createNewUserRequest = "INSERT INTO tb_users(name, fname, lname, email, password) "
                            . "VALUES('$userName', '$userFname', '$userLname', '$userEmail', '$userPass')";


    if(query($createNewUserRequest)) {
        echo "User created succesfully";
    }
}


