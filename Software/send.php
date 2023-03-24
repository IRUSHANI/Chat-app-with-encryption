<?php
session_start();
include 'dbh.php';
$msg=$_POST['msg'];
$name=$_SESSION['name'];


if(isset($_POST['btn-asymmetric'])){
    $plainfile = $msg;
    $cipherfile = "./whateverittakes.mp3.enc";
    $decryptedfile = "./whateverittakesdec.mp3";

// load private & public key
$public_key = openssl_pkey_get_public(file_get_contents('./public.pem'));
$private_key = openssl_pkey_get_private(file_get_contents('./private.key'));

// generate random aes encryption key
$key = openssl_random_pseudo_bytes(32); // 32 bytes = 256 bit aes key

// now encrypt the aes encryption key with the public key
openssl_public_encrypt($key, $encryptedKey, $public_key, OPENSSL_PKCS1_OAEP_PADDING);

// save 256 bytes long encrypted key
file_put_contents($cipherfile, $encryptedKey);
// aes cbc encryption
// generate random iv
$iv = openssl_random_pseudo_bytes(16);
// save 16 bytes long iv
file_put_contents($cipherfile, $iv, FILE_APPEND);
$data = file_get_contents($plainfile);
$cipher = openssl_encrypt($data, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
// save cipher
file_put_contents($cipherfile, $cipher, FILE_APPEND);
echo 'encryption finished' . PHP_EOL;

$sql="insert into posts(msg,name)values('$cipher','$name')";
$result = $conn->query($sql);

header("location:chat.php");
}

else{

    $simple_string =$msg; 
    $ciphering = "AES-128-CTR"; 
    $iv_length = openssl_cipher_iv_length($ciphering); 
    $options = 0; 
    $encryption_iv = '1234567891011121'; 
    $encryption_key = "SoftwareSecurity"; 
    $encryption = openssl_encrypt($simple_string, $ciphering,$encryption_key, $options, $encryption_iv); 


        $sql="insert into posts(msg,name)values('$encryption','$name')";
        $result = $conn->query($sql);
        
        header("location:chat.php");

}


?>