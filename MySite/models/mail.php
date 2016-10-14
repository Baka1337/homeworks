<?php

class Mail extends Model{

    public static function send($email, $subject, $message, $template, $data = array()){
        $mail = new PHPMailer();
        $mail->setLanguage('ru', ROOT.DS.'lib'.DS.'PHPMailer'.DS.'language'.DS);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPAuth = 'ssl';
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8';
        $mail->Username = 'username';
        $mail->Password = 'password';
        $mail->setFrom('admin@your-site.com', 'Чайний-магазин');
        $mail->Subject = $subject;
        $mail->addAddress($email);

        ob_start();
        include VIEWS_PATH.DS.'mailer'.DS."{$template}";
        $html = ob_get_clean();

        $mail->Body = $html;
        $mail->isHTML(true);

        $mail->clearAddresses();
    }
}