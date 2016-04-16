<?php

if (isset($_POST['name'])) {$name = $_POST['name']; if ($name == '') {unset($name);}}
if (isset($_POST['email'])) {$email = $_POST['email']; if ($email == '') {unset($email);}}
if (isset($_POST['website'])) {$email = $_POST['website']; if ($email == '') {unset($website);}}
if (isset($_POST['body'])) {$body = $_POST['body']; if ($body == '') {unset($body);}}

if (isset($name) && isset($email) && isset($body)){

    $address = "ghtheme@gmail.com";
    $mes = "Name: $name \nE-mail: $email \nWebsite: $website \nText: $body";
    $send = mail ($address,$mes,"Content-type:text/plain; charset = UTF-8\r\nFrom:$email");
    if ($send == 'true')
    {echo "Message sent , you can now go to the main page and continue reading <a href='<?php get+home_url(); ?>'><?php the_title(); ?></a>";}
    else {echo "The error message is not sent!";}

}
else
{
    echo "You did not fill in all the fields , you need to go back!";
}