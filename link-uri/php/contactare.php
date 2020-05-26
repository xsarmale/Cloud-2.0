<?php

$target="mailsentdone";
$linkname="C:\wamp64\www\Cloud vs 2.0\link-uri";

if ( isset( $_POST['submit'] ) )
{
   
// the message

$msg = $_POST['textbox'];
$mail1 = $_POST['imail'];    
$nume = $_POST['iname'];
$subj = $_POST['subjesct'];  
    
$to = "proiectscoala@gmail.com";
$subject = $subj;
$message = "Persoana cu numele $nume are urmatorul mesaj \n '$msg'";
$headers = 'From: proiectscoala@gmail.com'  . "\r\n" .
           "Reply-To: $mail1". "\r\n" .
           'X-Mailer: PHP/' . phpversion();
  
// send email
$success = mail($to, $subject, $message, $headers);

if(!$success)
{
    echo"Eroare la trimitere";
}else{
    header('Location: ..\mailsentdone.html');
}
}else
{
    echo "Error";
}

?>