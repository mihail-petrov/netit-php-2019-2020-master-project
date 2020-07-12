<?php session_start(); ?>
<?php include './src/db/Database.php';      ?>
<?php include './src/models/Auth.php';      ?>
<?php include './src/util/form.php';        ?>
<?php include './src/util/redirect.php';    ?>

<html>
    
<head>
    <title>title</title>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
      
<div id="header">
    <h1>@CMS</h1>
    <div>
        <ul>
            <li><a href="signin.php">Sign in</a></li>
            <li><a href="signup.php">Sign up</a></li>
        </ul>
    </div>
</div>
<div id="content">