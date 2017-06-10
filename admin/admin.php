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
<body>
<?php



    if(isset($_GET['logout'])){
        session_unset();
        session_destroy();
    }

    if(isset($_SESSION['user'])) {

        echo "<br><h1 align='center'>Welcome ".$_SESSION['user']."! </h1><br>";

        include '../includes/dbconnect.php';

        $query = "SELECT `id`,`nickname`,`email`,`website`,`comment`,`post_date` FROM `informations` WHERE `isApproved`=0 ";

        if ($query_run = mysqli_query($conn, $query)) {
            echo "<div class='container'>";
            echo "<table class='table table-hover' border='1px' align='center'>";
            echo "<thead class='thead-inverse'>";
            echo "<tr>";
            echo "<th style='text-align: center'>ID</th>";
            echo "<th style='text-align: center'>Nickname</th>";
            echo "<th style='text-align: center'>Email</th>";
            echo "<th style='text-align: center'>Website</th>";
            echo "<th style='text-align: center'>Comment</th>";
            echo "<th style='text-align: center'>Operation</th>";
            echo "</tr>";
            echo "</thead><br><br>";
            echo "<tbody>";
            while ($row = mysqli_fetch_assoc($query_run)) {

                $id = $row['id'];
                $name = $row['nickname'];
                $email = $row['email'];
                $website = $row['website'];
                $comment = $row['comment'];

                echo "<tr><td>" . $id . "</td><td>" . $name . "</td><td>" . $email . "</td><td>" . $website . "</td><td>" . $comment . "</td><td style='text-align: center'><a href='admin.php?del=$id'>Delete</a>&nbsp;&nbsp;<a href='update.php?edit=$id'>Edit</a>&nbsp;&nbsp;<a href='admin.php?approve=$id'>Approve</a></td></tr>";
            }
            echo "</tbody>";
            echo "</table>";


            if(isset($_GET['del'])){
                $id=$_GET['del'];
                $query_del="DELETE FROM `informations` WHERE `id`='$id'";
                mysqli_query($conn,$query_del);
            }

            if(isset($_GET['approve'])){
                $id=$_GET['approve'];
                $query_approve="UPDATE `informations` SET `isApproved`=1 WHERE `id`='$id'";

                if(mysqli_query($conn,$query_approve)) {
                    header('Refresh:1;url=admin.php');
                    echo "<div class='alert alert-success'>You have approved record number " . $id . "</div>";
                }else{
                    echo "<div class='alert alert-success'>" . mysqli_error($conn) . "</div>";
                }
            }

        } else {
            echo "<div class='alert alert-danger'>" . die($mysqli_error($conn)) . "</div>";
        }
        echo "</div>";

    }else{
        header('Location: ../index.php');

    }
?>
<br><br>
<button style="font-size:16px" class="btn btn-link" type="button"><a href="admin.php?logout=true">Log Out</a></button><br><br>

</body>
<?php
include '../includes/script.php';
ob_end_flush();
?>
</html>