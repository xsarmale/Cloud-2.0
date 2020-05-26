<?php

$ENCRYPTION_KEY = 'Scuze ca te-am facut fraier, fraiere !!!';
$ENCRYPTION_ALGORITHM = 'AES-256-CBC';

function EncryptThis($ClearTextData) {
	
    global $ENCRYPTION_KEY;
    global $ENCRYPTION_ALGORITHM;
    $EncryptionKey = base64_decode($ENCRYPTION_KEY);
    $InitializationVector  = openssl_random_pseudo_bytes(openssl_cipher_iv_length($ENCRYPTION_ALGORITHM));
    $EncryptedText = openssl_encrypt($ClearTextData, $ENCRYPTION_ALGORITHM, $EncryptionKey, 0, $InitializationVector);
    return base64_encode($EncryptedText . '::' . $InitializationVector);
	
}

function DecryptThis($CipherData) {
	
    global $ENCRYPTION_KEY;
    global $ENCRYPTION_ALGORITHM;
    $EncryptionKey = base64_decode($ENCRYPTION_KEY);
    list($Encrypted_Data, $InitializationVector ) = array_pad(explode('::', base64_decode($CipherData), 2), 2, null);
    return openssl_decrypt($Encrypted_Data, $ENCRYPTION_ALGORITHM, $EncryptionKey, 0, $InitializationVector);
	
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_encryption")) {
    // Once clear text data is encrypted, it can be saved to a database table.
    // This example will only echo the result to the screen.
    $Before = $_POST['ClearTextDataInput'];
    $After = EncryptThis($_POST['ClearTextDataInput']); 
}
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_decryption")) {
    // Cipher text can be from your MySQL data or from a user input via a web form.
    // This example will use user input cipher text to decrypt.
    $Before = $_POST['CipherDataInput'];
    $After = DecryptThis($_POST['CipherDataInput']); 
}

?>