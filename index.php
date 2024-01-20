<?php
//inicio de secao
session_start();

//incluir as classes 
include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");
include("classes/post.php");

//checar login
$login = new Login();
$user_data = $login->check_login($_SESSION['mybook_userid']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile | Mycharm</title>
    <style type="text/css">
        #bluebar {
            height: 50px;
            background-color: #405d9b;
            color: #d9dfeb;
        }

        #search_box {
            width: 400px;
            height: 20px;
            border-radius: 5px;
            border: none;
            padding: 4px;
            font-size: 14px;
            background-image: url(fotos/search.png);
            background-repeat: no-repeat;
            background-position: right;
        }

        #profile_pic {
            width: 150px;
            border-radius: 50%;
            border: solid 2px white;
        }

        #menu_buttons {
            width: 100px;
            display: inline-block;
            margin: 2px;
        }

        #friends_img {
            width: 75px;
            float: left;
            margin: 8px;
        }

        #friends_bar {
            min-height: 400px;
            margin-top: 20px;
            padding: 8px;
            text-align: center;
            font-size: 20px;
            color: #405d9b;

        }

        #friends {
            clear: both;
            font-size: 12px;
            font-weight: bold;
            color: #405d9b;
        }

        textarea {
            width: 100%;
            border: none;
            font-family: tahoma;
            font-size: 14px;
            height: 60px;
        }

        #post_button {
            float: right;
            background-color: #405d9b;
            border: none;
            color: white;
            padding: 4px;
            font-size: 14px;
            border-radius: 2px;
            width: 50px;
        }

        #post_bar {
            margin-top: 20px;
            background-color: white;
            padding: 10px;
        }

        #post {
            padding: 4px;
            font-size: 13px;
            display: flex;
        }
    </style>
</head>

<body style="font-family: Tahoma; background-color: #d0d8e4">
    <br />

    <!--top bar-->
    <?php

    include("header.php")

    ?>


    <!--Cover area-->
    <div style="width: 800px; margin: auto; min-height: 400px">


        <!--bellow cover area-->
        <div style="display: flex">
            <!--Friends-->

            <div style="min-height: 400px; flex: 1">
                <div id="friends_bar">
                    <img id="profile_pic" src="fotos/selfie.jpg"><br>
                    <a href="profile.php" style="color: #405d9b; text-decoration: none"><?php echo $user_data['first_name'] . "<br>" .  $user_data['last_name'] ?></a>
                </div>
            </div>

            <!--posts area-->

            <div style="
            min-height: 400px;
            flex: 2.5;
            padding: 20px;
            padding-right: 0px;
          ">
                <div style="
              border: solid thin #aaa;
              padding: 10px;
              background-color: white;
            ">
                    <textarea placeholder=" What is on your mind ?"></textarea>
                    <input id="post_button" type="submit" value="Post" />
                    <br />
                </div>

                <!-- posts -->

                <div id="post_bar">
                    <!-- post 1 -->

                    <div id="post">
                        <div>
                            <img src="fotos/user1.jpg" style="width: 75px; margin-right: 4px" />
                        </div>
                        <div>
                            <div style="font-weight: bold; color: #405d9b">First guy</div>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                            Explicabo tempora est, distinctio sequi iure incidunt non
                            numquam velit sit alias perspiciatis suscipit repellendus ipsum
                            veritatis dicta hic natus, ea beatae.
                            <br /><br />
                            <a href="">like</a> . <a href="">Comment</a> .
                            <span style="color: #999">MAY 05 2023</span>
                        </div>
                    </div>

                    <!-- post 2 -->

                    <div id="post">
                        <div>
                            <img src="fotos/user4.jpg" style="width: 75px; margin-right: 4px" />
                        </div>
                        <div>
                            <div style="font-weight: bold; color: #405d9b">First guy</div>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                            Explicabo tempora est, distinctio sequi iure incidunt non
                            numquam velit sit alias perspiciatis suscipit repellendus ipsum
                            veritatis dicta hic natus, ea beatae.
                            <br /><br />
                            <a href="">like</a> . <a href="">Comment</a> .
                            <span style="color: #999">MAY 05 2023</span>
                        </div>
                    </div>
                    <!-- post 3-->

                    <!--post 4-->
                </div>
            </div>
        </div>
    </div>
</body>

</html>