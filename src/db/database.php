<?php

// SELECT * FROM tb_blog_post
function query($query) { 
    
    // Connet to database
    $connection = mysqli_connect("localhost", "root", "", "mycms");
    
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