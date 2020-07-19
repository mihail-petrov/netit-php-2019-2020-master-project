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
    
    static function setAuthenticatetUser($authenticatedCollectionData) {
        
        
        $_SESSION['user_data_collection']   = $authenticatedCollectionData['user_data_collection'];
        $_SESSION['user_role_collection']   = $authenticatedCollectionData['user_role_collection'];
        $_SESSION['is_authenticated']       = true;
    }
    
    static function isAuthenticated() {
        return (isset($_SESSION['is_authenticated'])) ? $_SESSION['is_authenticated'] : false;
    }
    
    static function isNotAuthenticated() {    
        return !Auth::isAuthenticated();
    }
        
    static function isUser() {
        
        return Auth::isAuthenticated() && 
               Auth::hasRole('USER');
    }
    
    static function isModerator() {
        return Auth::isAuthenticated() && 
               Auth::hasRole('MODERATOR');
    }
    
    static function isAdmin() {
        
        return Auth::isAuthenticated() && 
               Auth::hasRole('ADMIN');
    }
    
    static function signout() {
        session_destroy();
    }
    
    private static function hasRole($roleTitle) {
        
        foreach ($_SESSION['user_role_collection'] as $key => $value) {
            if($value['role_title'] == $roleTitle) return true;
        }
        
        return false;
    }    
}