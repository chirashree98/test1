<?php

 $to = 'ratan@inwebinfo.com';
            $subject = "New account ";

            $message = "
            <html>
            <head>
            <title>New account </title>
            </head>
            <body>
            <p>Welcome to Profiwash</p>
            </body>
            </html>
            ";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: <admin@profiwash.com>' . "\r\n";
//$headers .= 'Cc: gsr.dev.15@gmail.com' . "\r\n";
            mail($to, $subject, $message, $headers);

?>