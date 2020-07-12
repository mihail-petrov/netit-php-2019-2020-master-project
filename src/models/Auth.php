<?php

class Auth {
    
    static function isUserAlreadyExists($columnName) {

        $userName   = $columnName['user_name'];
        $userEmail  = $columnName['user_email'];


        $validateIfRegistartionUserAlreadyExistQuery = "SELECT * "
                                                     . "FROM tb_users "
                                                     . "WHERE name = '$userName' OR email = '$userEmail'";

        $requestResult       = Database::get($validateIfRegistartionUserAlreadyExistQuery);

        return ($requestResult != null);
    }

    static function createNewUserInDatabase($databaseColumn) {

        $userName   = $databaseColumn['user_name'   ];
        $userFname  = $databaseColumn['user_fname'  ];
        $userLname  = $databaseColumn['user_lname'  ];
        $userEmail  = $databaseColumn['user_email'  ];
        $userPass   = $databaseColumn['user_pass'   ];

        $createNewUserRequest = "INSERT INTO tb_users(name, fname, lname, email, password) "
                               . "VALUES('$userName', '$userFname', '$userLname', '$userEmail', '$userPass')";    

        return Database::query($createNewUserRequest);
    }
    
    static function assigneRoleToUser($userid, $roleId) {

        $assigneRoleToInsertedUserQuery = "INSERT INTO tb_user__role(user_id, role_id) "
                                        . "VALUES($userid, $roleId)";    

        return Database::query($assigneRoleToInsertedUserQuery);
    }
        
    static function createNewUser($databaseColumn) {
        
        $isUserrCreated = Auth::createNewUserInDatabase($databaseColumn);

        if($isUserrCreated) {
            return Auth::assigneRoleToUser(Database::getLastInsertedId(), 1);
        }
    }
}