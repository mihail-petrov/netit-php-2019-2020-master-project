<?php

if(Auth::isNotAuthenticated()) {
    redirectTo("signin");
}

function listAllBlogPost() {
    
    $myCategory = null;
    if(isset($_GET['category'])) {
        
        $myCategory = $_GET['category'];
        return Database::query("SELECT * FROM tb_blog_post a,
                                tb_blog_post__categories b
                                WHERE a.id = b.blog_post_id AND 
				b.category_id = $myCategory");
    }    
    
    return Database::query("SELECT * FROM tb_blog_post");
}

function listAllBlogCategory() {    
    return Database::query("SELECT * FROM tm_categories");
}