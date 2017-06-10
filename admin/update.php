<?php
session_start();
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Emina Džaferović</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Theme CSS -->
    <link href="../css/clean-blog.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>


</head>
<?php
include '../includes/validation.php';
?>

<body>
<!-- Main Content -->

<?php

include '../includes/dbconnect.php';

if(isset($_GET['edit']) && isset($_SESSION['user'])){
    $id=$_GET['edit'];
    $query="SELECT `nickname`,`email`,`website`,`comment` FROM `informations` WHERE `id`='$id'";

    if($query_run=mysqli_query($conn,$query)){
        echo "<div class=\"container\"><div class=\"row\">
        <div class=\"col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1\">
            <h2>Feedback</h2><br/><br/><form action='' method='post'>";

        while($row=mysqli_fetch_assoc($query_run)){
            $name=$row['nickname'];
            $email=$row['email'];
            $site=$row['website'];
            $comment=$row['comment'];


            echo "<div class=\"row control-group\">
                    <div class=\"form-group col-xs-12 floating-label-form-group controls\">
                        <label for=\"name\">Nickname</label>
                        <input type=\"text\" class=\"form-control\" value='$name' id=\"name\" name=\"name\" required data-validation-required-message=\"Please enter your nickname.\">
                        <p class=\"help-block text-danger\"></p>
                    </div>
                </div>";

            echo "<div class=\"row control-group\">
                    <div class=\"form-group col-xs-12 floating-label-form-group controls\">
                        <label for=\"email\">Email Address</label>
                        <input type=\"email\" class=\"form-control\" value='$email' id=\"email\" name=\"email\" required data-validation-required-message=\"Please enter your email address.\">
                        <p class=\"help-block text-danger\"></p>
                    </div>
                </div>";

            echo "<div class=\"row control-group\">
                    <div class=\"form-group col-xs-12 floating-label-form-group controls\">
                        <label for=\"site\">Website</label>
                        <input type=\"url\" class=\"form-control\" value='$site' id=\"site\" name=\"site\">
                        <p class=\"help-block text-danger\"></p>
                    </div>
                </div>";

            echo "<div class=\"row control-group\">
                    <div class=\"form-group col-xs-12 floating-label-form-group controls\">
                        <label for=\"comment\">Comment</label>
                        <textarea rows=\"5\" class=\"form-control\" id='comment' name='comment'>$comment</textarea>
                        <p class=\"help-block text-danger\"></p>
                    </div>
                </div>";

            echo "<div class=\"form-group col-xs-12\">
                        <br><button type=\"submit\" class=\"btn btn-default\" id=\"submit\" name=\"submit\">Update</button><br><br>
                    </div><br><br><br><br><br>";

            }}


        if(isset($_POST['submit'])){

            $name_update=$_POST['name'];
            $email_update=$_POST['email'];
            $website_update=$_POST['site'];
            $comment_update=$_POST['comment'];

            $update="UPDATE `informations` SET `nickname`='$name_update',`email`='$email_update',`website`='$website_update',`comment`='$comment_update' WHERE `id`='$id'";
            if(mysqli_query($conn,$update)){
                header('Location:admin.php');
                echo "<div class='alert alert-success'>You're data has been updated!</div>";
            }else{
                echo "<div class='alert alert-danger'>".(mysqli_error($conn))."</div>";
            }
        }

        echo "</form></div></div></div>";
}
?>

<hr>

<!-- Footer -->
<?php include '../includes/footer.php';?>

<?php
include '../includes/script.php';
ob_end_flush();
?>

</body>

</html>
