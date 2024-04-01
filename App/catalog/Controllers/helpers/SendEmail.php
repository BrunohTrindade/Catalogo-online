<?php

namespace Catalog\Controllers\helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class SendEmail
{
  private array $email;
  private array $dataInfoEmail; // recebe as credenciais do email
  private bool $result;
  private string $fromEmail; // email do remetente
  private array $data;

  public function getResult(): bool
  {
    return $this->result;
  }

  public function sendEmail($data): void
  {
    
    $this->dataInfoEmail['host'] = "sandbox.smtp.mailtrap.io";
    $this->dataInfoEmail['fromEmail'] = "bruno_henriquet@live.com";
    $this->fromEmail = $this->dataInfoEmail['fromEmail'];
    $this->dataInfoEmail['fromName'] = "EP PISCINAS";
    $this->dataInfoEmail['userName'] = "50566cada10363";
    $this->dataInfoEmail['password'] = "d77e6525bcd570";
    $this->dataInfoEmail['port'] = 2525;

    $this->data['toEmail'] = $data['email'];
    $this->data['toName'] = $data['name'];
    $this->data['subject'] = "Recuperação de senha - EP PISCINAS";
    $this->data['contentHTML'] = "Olá <b>{$data['name']}</b><br><p>Sua nova senha de acesso é: </p> <p> <b>{$data['pass']}<b></p> ";
    // $this->data['contentText'] = "Olá Cesar\n\nCadastro realizado com succeso!";

    $this->sendEmailPhpMailer();
  }

  private function sendEmailPhpMailer(): void
  {

    $mail = new PHPMailer(true);

    try {

      // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
      $mail->CharSet = "UTF-8";

      $mail->isSMTP();
      $mail->Host       = $this->dataInfoEmail['host'];
      $mail->SMTPAuth   = true;
      $mail->Username   = $this->dataInfoEmail['userName'];
      $mail->Password   = $this->dataInfoEmail['password'];
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port       = $this->dataInfoEmail['port'];

      //Recipients
      $mail->setFrom($this->dataInfoEmail['fromEmail'], $this->dataInfoEmail['fromName']);
      $mail->addAddress($this->data['toEmail'], $this->data['toName']);     //Add a recipient

      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = $this->data['subject'];
      $mail->Body    = $this->data['contentHTML'];
      // $mail->AltBody = $this->data['contentText'];

      $mail->send();

      $this->result = true;
    } catch (\Exception $e) {
      $this->result = false;
    }
  }
}
