<?php
$nameErr = $emailErr = $commentErr = $websiteErr = "";
$name = $email = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    if (empty($_POST["name"])) {
        $nameErr = "Nickname is required";
        echo '<div class="alert alert-danger">'.$nameErr.'</div>';
        echo nl2br($nameErr);
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = '<div class="alert alert-danger">Only letters and white space allowed</div>';
            echo nl2br($nameErr);
        }
    }
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        echo '<div class="alert alert-danger">'.$emailErr.'</div>';
        echo nl2br($emailErr);
    } else {
        $email = test_input($_POST["email"]);
    }

    $website = test_input($_POST["site"]);

    if (empty($_POST["comment"])) {
        $commentErr = "Comment is required";
        echo '<div class="alert alert-danger">'.$commentErr.'</div>';
        echo nl2br($commentErr);
    } else {
        if (!preg_match("/^[a-zA-Z ]*$/", $comment)) {
            $commentErr = '<div class="alert alert-danger">Only letters and white space allowed</div>';
            echo nl2br($commentErr);
        }
        elseif (strlen($_POST['comment'])>255){
            $commentErr = '<div class="alert alert-danger">Message should not exceed 255 characters!</div>';
            echo nl2br($commentErr);
        }
        else{
            $comment = test_input($_POST["comment"]);
        }
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>