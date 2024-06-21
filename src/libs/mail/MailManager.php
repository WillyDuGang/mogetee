<?php

namespace src\libs\mail;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use src\core\View;
use src\libs\util\Format;

class MailManager
{

    public static function sendMailToAdminAndSender(
        string $sender,
        string $subject,
        string $template,
        array  $vars
    ): void
    {
        $mail = new PHPMailer(true);
        try {
            $mail->CharSet = 'UTF-8';
            $mail->setFrom('info@mogetee.nl', 'Moge Tee');
            $mail->addAddress(ADMIN_EMAIL);
            $mail->addCC($sender);
            $mail->addReplyTo($sender);
            $mail->isHTML(false);
            $mail->Subject = $subject;
            $mail->Body = View::getMailTemplate($template, $vars);
            $mail->send();
        } catch(Exception $e){
            self::redirectError();
        }
    }

    public static function sendMail(
        string $mailTo,
        string $subject,
        string $template,
        array $vars
    ): void
    {
        $mail = new PHPMailer(true);
        try {
            $mail->CharSet = 'UTF-8';
            $mail->setFrom('info@mogetee.nl', 'Moge Tee');
            $mail->addAddress($mailTo);
            $mail->isHTML(false);
            $mail->Subject = $subject;
            $mail->Body = View::getMailTemplate($template, $vars);
            $mail->send();
        } catch(Exception $e){
            self::redirectError();
        }
    }

    private static function redirectError(){
        View::redirect(null, ["Erreur survenue lors de l'envoi de l'email."], true)->goToError();
    }
}