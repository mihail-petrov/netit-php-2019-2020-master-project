<?php

if(Auth::isNotAuthenticated()) {
    redirectTo("signin");
}

function listAllBlogPost() {

    $myCategory = null;
    
    if(isset($_GET['post_search_tokken']) AND $_GET['post_search_tokken'] == 1) {

        $searchQuery            = $_GET['q'];
        $searchDescriptorColumn = $_GET['q_selector'];
        
        $categoryQuery          = $myCategory ? " b.category_id = $myCategory     AND " : "";
        $requestQuery           = "SELECT * FROM tb_blog_post a,
                                            tb_blog_post__categories b
                                            WHERE a.id = b.blog_post_id     AND 
                                            $categoryQuery 
                                            a.$searchDescriptorColumn LIKE '%$searchQuery%'";                                                
                
        // $requestQuery           = "SELECT * FROM tb_blog_post WHERE $searchDescriptorColumn LIKE '%$searchQuery%'";
        return Database::query($requestQuery);
    }
    
    
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

