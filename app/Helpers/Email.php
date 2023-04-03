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
      $mail->Host       = 'smtp.gmail.com';
      $mail->SMTPAuth   = true;
      $mail->Username   = 'iswanprah@gmail.com';
      $mail->Password   = 'DEVbpkad2020';
      $mail->SMTPSecure = 'ssl';
      $mail->Port       = '465';
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