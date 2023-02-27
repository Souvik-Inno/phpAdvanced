<?php

  /**
   *  @file contains class Emailer.
   *  PHPMailer package is required for sending mail.
   *  
   *  Class Pass is included which contains passwords.
   */
  require 'vendor/autoload.php';
  require 'classPass.php';
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  /**
   *  Class Emailer for email details.
   */
  class Emailer {

    /**
     *  @var string $fromEmail
     *    Contains sender email.
     */
    public $fromEmail;
    /**
     *  @var string $toEmail
     *    Contains reciever email.
     */
    public $toEmail;
    /**
     *  @var string $password
     *    Password of sender email.
     */
    public $password;
    /**
     *  @var string $apiKey
     *    Contains api key for email verification.
     */
    public $apiKey;
    /**
     *  @var string $message
     *    Contains email sent message.
     */
    public $message;

    /**
     *  Constructor defined to set fromEmail, password and apiKey.
     */
    public function __construct() {
      $pass = new Pass();
      $this->fromEmail = $pass->getFromEmail();
      $this->password = $pass->getPassword();
      $this->apiKey = $pass->getAPIKey();
    }

    /**
     *  Function to set toEmail.
     */
    public function setToEmail($email) {
      $this->toEmail = $email;
    }

    /**
     *  Function to send mail to desired email address.
     */
    public function sendMail() {
      $mail = new PHPMailer(true);
      try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $this->fromEmail;
        $mail->Password = $this->password;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
  
        // Set from address and to address.
        $mail->setFrom($this->fromEmail);
        $mail->addAddress($this->toEmail);
        if (!$this->checkEmail()) {
          $this->message = "*Invalid Mail Address Provided!";
          return;
        }
  
        // Content of the mail.
        $mail->isHTML(true);
        $mail->Subject = 'Welcome! Welcome!';
        $mail->Body    = '<strong>Welcome</strong> to the cult!';
        $mail->AltBody = 'Welcome to the cult!';

        $mail->send();
        $this->message = 'Message has been sent';
      }
      catch (Exception $e) {
        $this->message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
    }

    /**
     *  Function to validate email entered.
     */
    public function checkEmail() {
      $curl = curl_init();
      curl_setopt_array(
        $curl,
        array(
          CURLOPT_URL => "https://api.apilayer.com/email_verification/check?email={$this->toEmail}",
          CURLOPT_HTTPHEADER => array(
            "Content-Type: text/plain",
            "apikey: $this->apiKey"
          ),
          CURLOPT_RETURNTRANSFER => TRUE,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => TRUE,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET"
        )
      );
      $response = curl_exec($curl);
      $validator = json_decode($response);
      curl_close($curl);
      if ($validator->format_valid && $validator->smtp_check) {
        return TRUE;
      }
      else {
        return FALSE;
      }
    }

  }
?>
