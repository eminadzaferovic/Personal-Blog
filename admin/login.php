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
<br><br><br><br><br>
<div align="center" class="container">
    <form class="form-inline" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label>Username</label>
        <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="username" id="name" size="30"/><br><br>


        <label>Password</label>
        <input type="password" class="form-control mb-2 mr-sm-2 mb-sm-0" name="password" id="pass" size="30"/><br><br/>
        <input type="submit" class="btn btn-default" name="submit" value="Login"/><br/><br/>

        <?php

        $username='Emina';
        $password='web';

        if(isset($_POST['submit'])){
            if($_POST['username']==$username && $_POST['password']==$password){
                $_SESSION['user']=$username;
                header('Refresh:1; url=admin.php');
                echo '<div class="alert alert-success">Thank you for logging in!</div>';
            }else{
                header('Refresh:1; url=../index.php');
                echo '<div class="alert alert-danger">Login Failed!</div>';
            }
        }

        ?>

    </form>
</div>
</body>

<?php include '../includes/script.php';?>
<?php ob_end_flush();?>

</html>
