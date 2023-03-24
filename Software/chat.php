<?php
session_start();
include 'dbh.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="main">
             <h1 style="background-color:#6495ed; color:white;">
                <?php
                echo $_SESSION['name'];
                ?>
                -Online
             </h1>

             <div class="output">
                <?php
                $sql = "select * from posts";
                $result= $conn->query($sql);

                
                if($result->num_rows>0){
                    while($row=$result->fetch_assoc()){
                        $msg=($row['msg']);


                        if(isset($_POST['btn-asymmetric'])) {

                            $cipherfile = "./whateverittakes.mp3.enc";
                            $decryptedfile = "./whateverittakesdec.mp3";

                        // openssl genrsa -out private.key 2048
                        // openssl rsa -in private.key -out public.pem -outform PEM -pubout
                        // load private & public key
                        $public_key = openssl_pkey_get_public(file_get_contents('./public.pem'));
                        $private_key = openssl_pkey_get_private(file_get_contents('./private.key'));
                        
                        // generate random aes encryption key
                        $key = openssl_random_pseudo_bytes(32); // 32 bytes = 256 bit aes key
                            $handle = fopen($cipherfile, "rb");
                            // read 256 bytes long encryptedKey
                            $decryptionkeyLoad = fread($handle, 256);
                            // decrypt the encrypted key with private key
                            openssl_private_decrypt($decryptionkeyLoad, $decryptionkey, $private_key, OPENSSL_PKCS1_OAEP_PADDING);
                            // read 16 bytes long iv
                            $ivLoad = fread($handle, 16);
                            // read ciphertext
                            $dataLoad = fread($handle, filesize($cipherfile));
                            fclose($handle);
                            $decrypt = openssl_decrypt($dataLoad, 'AES-256-CBC', $decryptionkey, OPENSSL_RAW_DATA, $ivLoad);
                            file_put_contents($decryptedfile, $decrypt);

                            echo "". $row["name"]."". "::".$decrypt."<br>";
                            echo "<br>";
                        }

                        else{
                            $decryption_iv = '1234567891011121'; 
                            $decryption_key = "SoftwareSecurity"; 
                            $ciphering = "AES-128-CTR"; 
                            $options = 0; 
                            $decryption=openssl_decrypt($msg, $ciphering,$decryption_key, $options, $decryption_iv);
    
                            echo "". $row["name"]."". "::".$decryption."<br>";
                            echo "<br>";
                        }
                    }
                }
                else{
                    echo "No message yet";
                }
                $conn->close();
                ?>
             </div>
                
                <form method="POST" action="send.php">
                    <input style="border:none; font-size:15px"type="text" name="msg" placeholder="Type your message here..." class="txtarea"><br>
                    <input style= "border:none; font-size:18px; width:100%; height:50px; margin-top:15px; background-color:#6495ed; color:white; cursor: pointer; font-size:20px"type="submit" value="Send" class="btn">
                    <input type="submit" value="Asymmetric" name="btn-asymmetric" style="border:none; font-size:18px; float:right;  margin-top:-100px; width:150px; cursor:pointer">
                </form><br>
            
                <form action="logout.php">
                    <input style="width: 100%; background-color:#6495ed; color:white; font-size:20px; border:none; margin-top:-25px" type="submit" value="Logout">
                </form>
        </div>

         
    </div>
   <script src="home.js"></script> 
</body>
</html>