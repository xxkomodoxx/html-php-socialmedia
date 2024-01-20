<?php

include("classes/connect.php");
include("classes/signup.php");

$first_name = "";
$last_name = "";
$gender = "";
$email = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $signup = new Signup();
    $result = $signup->evaluate($_POST);

    if ($result != "") {

        echo "<div style ='text-align:center;font-size:12px;color:white;background-color:grey' >";
        echo "<br>The following erros occored <br><br>";
        echo $result;
        echo "</div>";
    } else {
        header("Location: login.php");
        die;
    }


    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyCharm | Signup</title>
    <style>
        #bar {
            height: 100px;
            background-color: rgb(59, 89, 152);
            color: #d9dfeb;
            padding: 4px;
        }

        #signup_button {
            background-color: #42b72a;
            width: 70px;
            text-align: center;
            padding: 4px;
            border-radius: 4px;
            float: right;
        }

        #login_bar {
            background-color: white;
            width: 800px;
            margin: auto;
            margin-top: 50px;
            padding: 10px;
            padding-top: 50px;
            text-align: center;
            font-weight: bold;
        }

        .form-input {
            height: 40px;
            width: 300px;
            border-radius: 4px;
            border: solid 1px #ccc;
            padding: 4px;
            font-size: 14px;
        }

        #button {
            width: 300px;
            height: 40px;
            border-radius: 4px;
            font-weight: bold;
            border: none;
            background-color: rgb(59, 89, 152);
            color: white;
        }
    </style>
</head>

<body style="font-family: Tahoma;background-color: #e9ebee;">
    <div id="bar">
        <div style="font-size: 40px;">MyCharm</div>
        <div id="signup_button"><a href="login.php"> SignIN </a></div>
    </div>

    <div id="login_bar">
        <span>Signup to MyCharm</span><br><br>

        <form method="post" action="">
            <input value="<?php echo $first_name ?>" name="first_name" type="text" class="form-input" placeholder="First Name"><br><br>
            <input value="<?php echo $last_name ?>" name="last_name" type="text" class="form-input" placeholder="Last Name"><br><br>

            <span style="font-weight: normal;">Gender:</span><br>
            <select name="gender" class="form-input">
                <option><?php echo $gender ?></option>
                <option>Male</option>
                <option>Female</option>
            </select><br><br>

            <input value="<?php echo $email ?>" name="email" type="text" class="form-input" placeholder="Email"><br><br>

            <input value="<?php echo $password ?>" name="password" type="password" class="form-input" placeholder="Password"><br><br>
            <input name="password2" type="password" class="form-input" placeholder="Retype Password"><br><br>

            <input type="submit" id="button" value="Sign up">
        </form>
    </div>
</body>

</html>