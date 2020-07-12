<?php

if(isset($_POST['user_request_tokken']) && $_POST['user_request_tokken'] == 1) {
 
    $userEmail      = $_POST['user_email'   ];
    $userPassword   = $_POST['user_pass'    ];
    
    $checkIfUserExistsQuery = "SELECT * "
                            . "FROM tb_users "
                            . "WHERE email = '$userEmail' AND password = '$userPassword'";
    
    $userRecord = Database::get($checkIfUserExistsQuery);
    
    if($userRecord) {
        $_SESSION['is_authenticated'] = true;
        return redirectTo('index');
    }
    
    return setFormError("signin"                        , 
                        "user_email"                    , 
                        "Login atempt is not succsessful");
}