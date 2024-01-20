<?php

class Signup
{

    private $error = "";

    public function evaluate($data)
    {

        foreach ($data as $key => $value) {
            # code...
            if (empty($value)) {
                $this->error = $this->error . $key . " is empty ! <br>";
            }

            if ($key == "email") {
                if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $value)) {
                    $this->error = $this->error . "Invalid email address !<br>";
                }
            }

            if ($key == "first_name") {
                if (is_numeric($value)) {
                    $this->error = $this->error . "Invalid name can't be numeric !<br>";
                }
                if (strstr($value, " ")) {
                    $this->error = $this->error . "Invalid name can't have spaces !<br>";
                }
            }
            if ($key == "last_name") {
                if (is_numeric($value)) {
                    $this->error = $this->error . "Invalid last name can't be numeric !<br>";
                }
                if (strstr($value, " ")) {
                    $this->error = $this->error . "Invalid name can't have spaces !<br>";
                }
            }
        }

        if ($this->error == "") {

            // no error 
            $this->create_user($data);
        } else {
            return $this->error;
        }
    }

    public function create_user($data)
    {

        $first_name = ucfirst($data['first_name']);
        $last_name = ucfirst($data['last_name']);
        $gender = $data['gender'];
        $email = $data['email'];
        $password = $data['password'];
        $cover_image = $data['cover_image'];
        $profile_image = $data['profile_image'];

        // create this
        $url_address = strtolower($first_name) . "." . strtolower($last_name);
        $userid = $this->create_userid();

        $query = "INSERT INTO users 
        (userid,first_name,last_name,gender,email,password,url_address,profile_image,cover_image) 
        VALUES
        ('$userid', '$first_name', '$last_name', '$gender', '$email', '$password', '$url_address','$profile_image','$cover_image')";


        $DB = new Database();
        $DB->save($query);
    }

    private function create_userid()
    {

        $length = rand(4, 19);
        $number = "";
        for ($i = 0; $i < $length; $i++) {
            # code...
            $new_rand = rand(0, 9);
            $number = $number . $new_rand;
        }
        return $number;
    }
}
