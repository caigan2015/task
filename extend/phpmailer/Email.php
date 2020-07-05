<?php
namespace phpmailer;

use Think\Exception;
use think\Log;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/23
 * Time: 16:51
 */

class Email
{
    static public function send($to,$title,$content){
        date_default_timezone_set('PRC');//set time
        if(!$to) return false;
        try {
//Create a new PHPMailer instance
            $mail = new PHPMailer;
//Tell PHPMailer to use SMTP
            $mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
            $mail->SMTPDebug = 0;
//Ask for HTML-friendly debug output
            $mail->Debugoutput = 'html';
//Set the hostname of the mail server
            $mail->Host = config('email.host');
//Set the SMTP port number - likely to be 25, 465 or 587
            $mail->Port = config('email.port');
//Whether to use SMTP authentication
            $mail->SMTPAuth = true;
//Username to use for SMTP authentication
            $mail->Username = config('email.username');;
//Password to use for SMTP authentication
            $mail->Password = config('email.password');;//客户端授权密码
//Set who the message is to be sent from
            $mail->setFrom(config('email.username'), 'caigan');
//Set an alternative reply-to address
//$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
            $mail->addAddress($to, 'CHOI');
//Set the subject line
            $mail->Subject = $title;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
            $mail->msgHTML($content);
//Replace the plain text body with one created manually
//$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
            if (!$mail->send()) {
//                echo "Mailer Error: " . $mail->ErrorInfo;
                return false;
            } else {
//                echo "Message sent success!";
                return true;
            }
        }catch (PHPMailerException $e){
            Log::error('邮件发送错误：'.$e->errorMessage());
        }
    }
}
?>