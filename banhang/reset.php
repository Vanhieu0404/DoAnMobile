<?php

include "connect.php";


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

  $email = $_POST['email'];
  $query = 'SELECT * FROM `user` WHERE `email` = "'.$email.'" ';
$data = mysqli_query($conn, $query);
$result = array();
while ($row = mysqli_fetch_assoc($data)) {
    $result[] = ($row);
    // code...
}

  if (empty($result)) {
   $arr = [
      'success' => false,
      'message' => "Email Không Chính Xác! Vui Lòng Nhập Lại",
      'result' => $result
  ];
  }else{
      
      $email=($result[0]["email"]);
      $pass=($result[0]["pass"]);
      $link="<a href='http://192.168.1.5/banhang/reset_pass.php?key=".$email."&reset=".$pass."'>Click To Reset password</a>";

    $mail = new PHPMailer();
    $mail->CharSet =  "utf-8";
    $mail->IsSMTP();
    // enable SMTP authentication
    $mail->SMTPAuth = true;                  
    // GMAIL username
    $mail->Username = "nguyenvanhieu0404@gmail.com";
    // GMAIL password
    $mail->Password = "rwinebqvvpmjhuix"; 
    $mail->SMTPSecure = "ssl";  
    // sets GMAIL as the SMTP server
    $mail->Host = "smtp.gmail.com";
    // set the SMTP port for the GMAIL server
    $mail->Port = "465";
    $mail->From= "nguyenvanhieu0404@gmail.com"; // mail nguoi nhan 
    $mail->FromName='ADMIN App ban hang ';
    $mail->AddAddress($email, 'reciever_name');
    $mail->Subject  =  'Reset Password';
    $mail->IsHTML(true);
    $mail->Body    = $link;
    if($mail->Send())
    {
      $arr = [
        'success' => true,
        'message' => "Vui Lòng Kiểm Tra Gmail Của Bạn!! ",
        'result' => $result
    ];
    }
    else
    {
      $arr = [
        'success' => false,
        'message' => "Gửi Mail Không Thành Công!!",
        'result' => $result
    ];
  }
}

  print_r(json_encode($arr));

    

?>