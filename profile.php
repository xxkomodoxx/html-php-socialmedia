<?php
//inicio de secao
session_start();

//incluir as classes 
include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");
include("classes/post.php");
include("classes/image.php");

//checar login
$login = new Login();
$user_data = $login->check_login($_SESSION['mybook_userid']);

//para posts

if ($_SERVER['REQUEST_METHOD'] == "POST") {


    $post = new Post();
    $id = $_SESSION['mybook_userid'];
    $result = $post->create_post($id, $_POST, $_FILES);

    if ($result == "") {
        header("Location: profile.php");
        die;
    } else {
        echo "<div style ='text-align:center;font-size:12px;color:white;background-color:grey' >";
        echo "<br>The following erros occored <br><br>";
        echo $result;
        echo "</div>";
    }
}

//coletar posts
$post = new Post();
$id = $_SESSION['mybook_userid'];
$posts = $post->get_posts($id);

//conectar amigos

$user = new User();
$id = $_SESSION['mybook_userid'];
$friends = $user->get_friends($id);


$image_class = new Image();
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
            margin-top: -200px;
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
            background-color: white;
            min-height: 400px;
            margin-top: 20px;
            color: #aaa;
            padding: 8px;
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

        .image-container {
            position: relative;
            display: inline-block;
        }

        .edit-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #405d9b;
            font-size: 20px;
            cursor: pointer;
        }
    </style>
</head>

<body style="font-family: Tahoma; background-color: #d0d8e4">
    <br />

    <?php

    include("header.php")

    ?>

    <!--Cover area-->
    <div style="width: 800px; margin: auto; min-height: 400px">
        <div style="background-color: white; text-align: center; color: #405d9b">


            <?php

            $image = "fotos/placeholderbackground.jpeg";
            if (file_exists($user_data['cover_image'])) {

                $image = $image_class->get_thumb_cover($user_data['cover_image']);
            }
            ?>


            <img src="<?php echo $image ?>" style="width: 100%" />

            <span style="font-size: 12px">

                <?php

                $image = "fotos/user_male.jpg";
                if ($user_data['gender'] == "Female") {
                    $image = "fotos/user_female.jpg";
                }
                if (file_exists($user_data['profile_image'])) {

                    $image = $image_class->get_thumb_profile($user_data['profile_image']);
                }
                ?>
                <img src=" <?php echo $image ?>" id="profile_pic" /><br>
                <a href="change_pic.php?change=profile" style="text-decoration: none; color: #f0f;">Change Profile
                    Image</a> |
                <a href="change_pic.php?change=cover" style="text-decoration: none; color: #f0f;">Change Cover</a>
            </span>

            <br />

            <div style="font-size: 20px"><?php echo $user_data['first_name'] . " " . $user_data['last_name'] ?></div>
            <br />
            <a href="index.php">
                <div id="menu_buttons">Timeline</div>
            </a>
            <div id="menu_buttons">About</div>
            <div id="menu_buttons">Friends</div>
            <div id="menu_buttons">Photos</div>
            <div id="menu_buttons">Settings</div>
        </div>

        <!--bellow cover area-->
        <div style="display: flex">
            <!--Friends-->

            <div style="min-height: 400px; flex: 1">
                <div id="friends_bar">

                    Friends <br />


                    <?php

                    if ($friends) {


                        foreach ($friends as $FRIEND_ROW) {
                            # code...


                            include("user.php");
                        }
                    }

                    ?>


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
                    <form method="post" enctype="multipart/form-data">

                        <textarea name="post" placeholder=" What is on your mind ?"></textarea>
                        <input type="file" name="file">
                        <input id="post_button" type="submit" value="Post" />
                        <br />
                    </form>
                </div>

                <!-- posts -->

                <div id="post_bar">


                    <?php

                    if ($posts) {


                        foreach ($posts as $ROW) {
                            # code...

                            $user = new User();
                            $ROW_USER = $user->get_user($ROW['userid']);
                            include("post.php");
                        }
                    }

                    ?>


                </div>
            </div>
        </div>
    </div>
</body>

</html>