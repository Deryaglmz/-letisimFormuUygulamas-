<?php
header("Content-Type:text/html; charset=UTF-8");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function Filtrele($Deger){
    $IslemBir = trim($Deger);
    $Islemİki = strip_tags($IslemBir);
    $IslemUc = htmlspecialchars($Islemİki, ENT_QUOTES);
    $Sonuc = $IslemUc;
        return $Sonuc;
}
$GelenIsimSoyisim = Filtrele($_POST['adisoyadi']);
$GelenTelefon = Filtrele($_POST['telefon']);
$GelenEmailAdresi= Filtrele($_POST['emailadresi']);
$GelenKonu= Filtrele($_POST['konusu']);
$GelenMesaj= Filtrele($_POST['mesaj']);

$mail = new PHPMailer(true);
try {
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host       = 'smtp.example.com';
    $mail->SMTPAuth   = true;
    $mail->charset    = 'UTF-8';
    $mail->Username   = 'user@example.com';
    $mail->Password   = 'secret';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;
    $mail->SMTPOptions = array(
                             'ssl' => [
                                'verify_peer' => true,
                                'verify_depth' => 3,
                                'allow_self_signed' => true,
                                'peer_name' => 'smtp.example.com',
                                'cafile' => '/etc/ssl/ca_cert.pem',
        ],
    );
    $mail->setFrom($GelenEmailAdresi, $GelenIsimSoyisim);
    $mail->addAddress('deryaglmz0@gmail.com', 'Derya Gülmez');
    $mail->addReplyTo($GelenEmailAdresi, $GelenIsimSoyisim);
    $mail->isHTML(true);
    $mail->Subject = $GelenKonu;
    $mail->MsgHTML($GelenMesaj);
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ',$mail->ErrorInfo->ErrorInfo;
}
?>