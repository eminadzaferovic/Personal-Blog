<?php
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<?php
include 'includes/head.php';
include 'includes/validation.php';
?>

<body>

<!-- Navigation -->

<?php include 'includes/nav.php';?>

<!-- Page Header -->

<?php $pagetitle = 'Emina Džaferović'; $pagesubtitle = 'Guestbook'; include 'includes/header.php';?>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <h2>Feedback</h2><br/><br/>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label for="name">Nickname</label>
                        <input type="text" class="form-control" placeholder="Name" id="name" name="name" required data-validation-required-message="Please enter your nickname.">
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" placeholder="Email Address" id="email" name="email" required data-validation-required-message="Please enter your email address.">
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label for="site">Website</label>
                        <input type="url" class="form-control" placeholder="Website" id="site" name="site">
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label for="comment">Comment</label>
                        <textarea rows="5" class="form-control" placeholder="Comment..." id="comment" name="comment" required data-validation-required-message="Please enter a comment."></textarea>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <br>
                <div id="success"></div>
                <div class="row">
                    <div class="form-group col-xs-12">
                        <button type="submit" class="btn btn-default" id="submit" name="submit">Send</button><br><br>
                    </div>
                </div>
                <?php

                include 'includes/dbconnect.php';

                if(isset($_POST['submit']))
                {

                    $query = "INSERT INTO `informations` (`nickname`,`email`,`website`,`comment`) VALUES ('$name','$email','$website','$comment')";

                    if($query_run=mysqli_query($conn,$query)){
                        echo "<div class='alert alert-success'>Thank you. Your comment has been received.</div>";
                    }else{
                        echo "<div class='alert alert-danger'>".die($mysqli_error($conn))."</div>";
                    }

                }

                ?>
            </form>

        </div>
    </div>

    <?php

        $query_show_content = "SELECT `nickname`,`post_date`,`comment` FROM `informations` WHERE `isApproved`=1";

        if ($query_run = mysqli_query($conn, $query_show_content)) {
            echo "<div class='container'><h3>Comments:</h3><br><br>";
            while ($row = mysqli_fetch_assoc($query_run)) {
                $name = $row['nickname'];
                $post_date = $row['post_date'];
                $comment = $row['comment'];

                echo "<div class='container'><div class='row'><div class='col-sm-12'>
                        </div></div><div class='row'><div class='col-sm-1'>
                        <div class='thumbnail'>
                        <img class='img-responsive user-photo' src='img/user.png'></div></div>
                        
                        <div class='col-sm-5'><div class='panel panel-default'><div class='panel-heading'>
                        <strong>" . $name . "</strong> <span class='text-muted' style='font-size:12px;'>Commented on " . $post_date . "</span>
                        </div><div class='panel-body'>" . $comment . "</div></div></div></div><br><br>";
            }
        }

    mysqli_close($conn);

    ?>

</div>

<hr>

<!-- Footer -->
<?php include 'includes/footer.php';?>

<?php include 'includes/script.php'?>

</body>
<?php ob_end_flush();?>
</html>
