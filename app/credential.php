<?php
include_once("./env.php");
ConnectEnv();

function database()
{
  return array(
    'live' => array(
      'servername' => $_ENV['DB_HOST'],
      'username' => $_ENV['DB_USERNAME'],
      'password' => $_ENV['DB_PASSWORD'],
      'dbname' => $_ENV['DB_DATABASE'],
      'sendmail' => true
    ),
  );
}


function email()
{
  return array(
    'SMTPAuth' => $_ENV['SMTP_AUTH'],
    'SMTPSecure' => $_ENV['SMTP_SECURE'],
    'Host' => $_ENV['SMTP_HOST'],
    'Port' => $_ENV['SMTP_PORT'],
    'Username' => $_ENV['AUTH_USERNAME'],
    'Password' => $_ENV['AUTH_PASSWORD'],
    "FromMail" => $_ENV['FROM_MAIL'],
    "FromName" => $_ENV['FROM_NAME'],
  );
}
