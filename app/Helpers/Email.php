<?php

namespace App\Helpers;

class Email
{
  private $send = [];
  private $body = null;

  public function body($data)
  {
    $this->body = $data;
    return $this;
  }

  public function to($email)
  {
    $this->send[] = trim($email);
    return $this;
  }

  public function send()
  {
    try {
      $mail= new \PHPMailer\PHPMailer\PHPMailer(true);
      $mail->isSMTP();
      $mail->Host       = 'live.smtp.mailtrap.io';
      $mail->SMTPAuth   = 'PLAIN';
      $mail->Username   = 'api';
      $mail->Password   = 'c98b4c2e2f050001149b3cf1412ba94a';
      $mail->SMTPSecure = 'ssl';
      $mail->Port       = '587';
      $mail->SMTPDebug  = 0;
      $mail->setFrom('iswanprah@gmail.com', 'Idwebhost Tes');
      
      foreach ($this->send as $row) {
        $mail->addAddress($row);
      }

      $mail->Body = $this->body;
      $mail->isHTML(true);
      $mail->Subject = 'Test Dev Laravel Iswan';
      
      if (!$mail->send()) {
        echo $mail->ErrorInfo;
        return false;
      }

    } catch (\PHPMailer\PHPMailer\Exception $e) {
			//print_r($this->send);
      //echo $e->getMessage();
      return false;
    }

    return true;
  }
}