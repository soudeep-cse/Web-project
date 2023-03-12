<?php

session_start();
include './database.php';

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $flag = true;

    // Account Information 
    $to_email = $_POST['email'];
    

    $erroremail=$errorvalidmail=" ";
    
    if(empty($to_email)){
        $erroremail="Please fill up the form";
        $flag = false;
    }else{
        if(!filter_var($to_email, FILTER_VALIDATE_EMAIL)){
            $errorvalidmail="This is not correct email format..";
            $flag = false;
        }
    }
   
    if($flag === true){
        if(isset($_POST['submit'])){
            if(!empty($to_email)){
            $sql = "Select * from `local_bus_ticketing_system`.`admin` WHERE  email='$to_email'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            if ($row>0) {
				
					$rec_password = $row['password'];
					$to  = $to_email;
					$subject = 'Forget password';
					$body = "Your password is: ".$rec_password;
					$headers = 'From: s.shahriar32322323@gmail.com';
					if(mail($to, $subject, $body, $headers)){
					//header('Location: ./login.php'.'Check your email for your password');
					}
							
			} 
            else{
                    echo "Failed to send the password";
                }
            } 
        }       
    }   
}
?>




 <!-- **************Form part************ -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
        include './navbar.php';
    ?>
    
    <table align="center">
     
        <tr>
            <td>
            <h1>Forgot Password</h1>
                <br>
                <br>
                <br>
                <fieldset>
                    <legend>Forgot Password </legend>
                    <!-- ---------------------------------------- -->
                    <form action="forgotpassword.php" method="post" novalidate>
                        <table>

                            <tr>
                                <td>
                                    <label for="email">Provide Valid Email: </label>
                                </td>
                                
                                <td>
                                    <input type="email" id="email" name="email" value="<?php if(isset($_POST['submit'])){echo $to_email;} ?>"
                                        placeholder="Please enter your email...  "><br>
                                    <?php if(isset($_POST['submit'])){echo $erroremail; echo $errorvalidmail;} ?>
                                        
                                    
                                </td>
                            
                                
                            <tr align="center">
                                
                                <td></td>
                                
                                <td><input type="submit" name="submit" value="Recover Password" ><br></td>
                                <td></td> 
                                
                                   
                            </tr>

                           

                            <tr>
                                <td></td>
                                <td> <h4>Back to <a href="./login.php">Login page</a></h4></td>
                                <br><br>

                        </tr>
                        
                        </table>
                    </form>

                </fieldset>
            </td>
        </tr>

    </table>
    <?php 
    include './footer.php';
    ?>
</body>

</html>