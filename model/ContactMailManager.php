<?php

namespace Olha\Blog\Model;

require_once("model/Manager.php");

class ContactMailManager extends Manager
{
    public function contactUs()
    {
        if (isset($_POST['submit'])) {
            $to = "ole4ka.safonova@gmail.com";
            $from = $_POST['email'];
            $name = $_POST['name'];
            $subject = "Message de blog";
            $message = $name . " Message:" . "\r\n" . $_POST['message'];

            $name = htmlspecialchars($name);
            $from = htmlspecialchars($from);
            $message = htmlspecialchars($message);
            $name = urldecode($name);
            $from = urldecode($from);
            $message = urldecode($message);
            $name = trim($name);
            $from = trim($from);
            $message = trim($message);
            $headers = "De:" . $from;

            mail($to, $subject, $message, $headers);
            echo "Le message est envoyé avec succès.";
        }
        else
        {
            echo "Le message n'est pas envoyé";
        }
    }


}