<?php include('./templates/header.php'); ?>
<?php include('./src/controllers/blog.php'); ?>

<?php $categoryFetch    = Database::query("SELECT * FROM tm_categories"); ?>

<ul id="category-placeholder">
    <?php while($blogCategory = Database::fetch($categoryFetch)) {  ?>
    <li class="category-placeholder--category">
        <?php   
        $categoryId = $blogCategory['id']; ?>
        <a href="<?php echo "http://localhost/CMS/blog.php?category=$categoryId" ?>">
            <?php echo $blogCategory['title'] ?>
        </a>
    </li>
    <?php } ?>
    
        <li class="category-placeholder--category">
        <a href="http://localhost/CMS/blog.php">
            Изчисти
        </a>
    </li>
    
    
</ul>

<div id="blog-post--content">

    <div class="post">
        <?php 

        $mysqlResult    = listAllBlogPost();
        while($blogPost = Database::fetch($mysqlResult)) {  ?>

        <span class="post-title"> <?php echo $blogPost['title']; ?></span>
        <div class="post-content">
            <p><?php echo $blogPost['content']; ?> </p>                        
        </div>                    

        <?php } ?>
    </div>
</div>

<?php include('./templates/footer.php'); ?>