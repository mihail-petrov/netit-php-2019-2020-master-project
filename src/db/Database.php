<?php

class Database {

    static $dbConnection = NULL;
    
    
    static function dbConnect() {
        
        if(Database::$dbConnection == NULL) {
           Database::$dbConnection  =  mysqli_connect("localhost", "root", "", "mycms");
        }
        
        return Database::$dbConnection;
    }

    static function query($query) { 

        // Connet to database
        $connection = Database::dbConnect();
        // $connection = mysqli_connect("localhost", "root", "", "mycms");

        if(!$connection) {
            echo mysqli_connect_error();
            return;
        }

        $databaseResult = mysqli_query($connection, $query);

        if(!$databaseResult) {
            echo '<div class="db-error">';
            echo mysqli_error($connection);
            echo '</div>';
        }

        return $databaseResult;
    }

    /**
     * This function returns last id
     * @name getLastInsertedId
     * @author Mihail Petrov
     * @return type
     */
    static function getLastInsertedId() { 
        return mysqli_insert_id(Database::dbConnect());
    }
    
    static function get($databaseQuery) {
        
        $databaseResultSet = Database::query($databaseQuery);
        return mysqli_fetch_assoc($databaseResultSet);
    }
    
    static function fetch($databaseResultSet) {
        return mysqli_fetch_assoc($databaseResultSet);
    }
}