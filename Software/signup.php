
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
        <div class="card">
            <form action="sign-up.php" method="POST"  enctype="multipart/form-data" autocomplete="off" class="login">
                <div class="error-txt"></div>
            
                <div class="name">
                    <div class="field">
                        <label>User Name</label>
                        <input type="text" placeholder="First Name" name="uname">
                    </div>
    
                    <div class="field">
                        <label>Email Address</label>
                        <input type="text" placeholder="Enter your email address" name="email">
                    </div>
    
                    <div class="field">
                        <label>Password</label>
                        <input type="password" placeholder="Password" id="password" name="pass">
                    </div>
                    
                    <div class="field">
                        <label>Confirm Password</label>
                        <input type="password" placeholder="Password" id="password" name="confirm_pass">
                    </div>

                    <div class="field button">
                     <input type="submit" value="Submit">
                    </div>
                  
            </form>
            <div class="link">Already signed up? <a href="index.php">Login now </a></div>
        </div>
        </div>
        

    <script src="home.js"></script>
</body>
</html>