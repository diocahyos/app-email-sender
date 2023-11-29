<?php
require_once './vendor/autoload.php';
include('credential.php');
$db = database();
$email_cred = email();

use PHPMailer\PHPMailer\PHPMailer;

// Create connection
// $conn = new mysqli($db['live']['servername'], $db['live']['username'], $db['live']['password'], $db['live']['dbname']);

// Check connection
// if (!$conn->connect_error) {

// $data = array();
// $sql = "SELECT * FROM user";
// $result = mysqli_query($conn, $sql);
// if (mysqli_num_rows($result) > 0) {
// $data = mysqli_fetch_assoc($result);
// $first_date = $data['first_date'];
// $second_date = $data['second_date'];

// $table = '<tr>
//       <td>' . $data['submit_at'] . '</td>
//       <td>' . $data['CompCode'] . '</td>
//       <td>' . $data['ReqId'] . '</td>
//       <td>' . $data['InputterName'] . '</td>
//       <td>IDR ' . $data['TotalAmount'] . '</td>
//     </tr>';

// while ($row = mysqli_fetch_assoc($result)) {
//   $table .= '<tr>
//       <td>' . $row['submit_at'] . '</td>
//       <td>' . $row['CompCode'] . '</td>
//       <td>' . $row['ReqId'] . '</td>
//       <td>' . $row['InputterName'] . '</td>
//       <td>IDR ' . $row['TotalAmount'] . '</td>
//     </tr>';
// }

$mail = new PHPMailer();

$mail->IsSMTP();
$mail->SMTPAuth = $email_cred['SMTPAuth'];
$mail->SMTPSecure = $email_cred['SMTPSecure'];
$mail->Host = $email_cred['Host'];
$mail->Port = $email_cred['Port'];
$mail->Username = $email_cred['Username'];
$mail->Password = $email_cred['Password'];
$mail->SetFrom($email_cred['FromMail'], $email_cred['FromName']);
// $mail->AddBCC('rikominami90@gmail.com');
$mail->addAddress("dio.cahyo@idstar.co.id");
$mail->Subject = "Contoh Sending Email menggunakan PHP";

$body = <<<EOD
      <html lang='en'>
        <head>
          <meta charset='UTF-8' />
          <meta name='viewport' content='width=device-width, initial-scale=1.0' />
          <title>Email Sender</title>
          <style>
            .content-table {
              border-collapse: collapse;
              text-align: center;
              line-height: 2;
              width: 100%;
            }
            .content-table td {
              border-top: 1px solid black;
              border-bottom: 1px solid black;
              padding: 0 10px;
            }
          </style>
        </head>
        <body style='font-family: sans-serif; font-size: 14px; witdh: 100vw;'>
          <div
            style='
              border-radius: 5px;
              background-color: #f3f3f3;
              width: 1000px;
              margin: 0 auto;
              padding: 20px;
            '
          >
            <div style='border-radius: 20px; background-color: white; padding: 50px'>
            <table>
            <tr>
              <td colspan='2'>
                <div style='margin-top: 20px'>
                  Contoh sending email melalui php beserta table
                </div>
              </td>
            </tr>
            <tr>
              <td colspan='2'>
                <div style='margin-top: 30px'>
                  <table class='content-table'>
                    <thead>
                      <tr>
                        <th style='border-right: 1px solid black'>Name</th>
                        <th style='border-right: 1px solid black'>Email</th>
                        <th style='border-right: 1px solid black'>Phone Number</th>
                        <th style='border-right: 1px solid black'>Position</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Dio Cahyo S</td>
                        <td>123170033@student.upnyk.ac.id</td>
                        <td>08319203849</td>
                        <td>Backend Developer</td>
                      </tr>
                      <tr>
                        <td>Kotori Minami</td>
                        <td>kotominami@gmail.com</td>
                        <td>08319201234</td>
                        <td>UI/UX Developer</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </td>
            </tr>
          </table>
            </div>
          </div>
        </body>
      </html>
      EOD;
$mail->Body = $body;
$mail->isHTML(true);


if (!$mail->send()) {
  echo "Message could not be sent.";
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Success send email";
}
// }

//   $conn->close();
// }
