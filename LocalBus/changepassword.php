<!-- *********Start php********** -->
<?php

session_start();
include './database.php';

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $flag = true;
        // general information
        $emailUser = $_POST['emailUser'];
        $oldpassword = $_POST['oldpassword'];
        $newpassword = $_POST['newpassword'];
        $confirmpassword = $_POST['confirmpassword'];

        $erroremailUser=$erroroldpassword=$errornewpassword=$errorconfirmpassword=$errormatchedpassword=$errorvalidmail=" ";
        // if input form is empty then show some specific error 
        if(empty($emailUser)){
            $erroremailUser="Please fill up the form";
            $flag = false;
        }

        if(empty($oldpassword)){
            $erroroldpassword="Please fill up the form";
            $flag=false;
        }
        if(empty($newpassword)){
            $errornewpassword="Please fill up the form";
            $flag = false;
        }

        if(empty($confirmpassword)){
            $errorconfirmpassword="Please fill up the form";
            $flag = false;
        }
        
    
        if($flag === true){
            if(!empty($emailUser) && !empty($oldpassword) && !empty($newpassword)&& !empty($confirmpassword)){
                if($newpassword===$confirmpassword){
                    $sql = "UPDATE admin SET password='$newpassword' WHERE Username='$emailUser' OR email='$emailUser' ";

                    $result=mysqli_query($conn, $sql);
                    if ($result) {
                       
                    echo "Changed password successfully";
                    } else {
                    echo "Error updating record: " . mysqli_error($conn);
                    }
                    }
                    else{
                        $errormatchedpassword="Password didn't matched.";
                        //echo "Password didn't matched.";
                        
                    }
                }
                
            } 
        
    else{
        //echo "404 Error !";
    }

    function sanitize($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
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
            <h1>Login Page</h1>
                <br>
                <br>
                <br>
                <fieldset>
                    <legend>Change Password </legend>
                    <!-- ---------------------------------------- -->
                    <form action="changepassword.php" method="post" novalidate>
                        <table>

                            <tr>
                                <td>
                                    <label for="emailUser">Email/Username</label>
                                </td>
                                <td>:</td>
                                <td>
                                    <input type="text" id="emailUser" name="emailUser" value="<?php if(isset($_POST['submit'])){echo $emailUser;} ?>"
                                        placeholder="Please enter your email...  "><br>
                                        <?php if(isset($_POST['submit'])){echo $erroremailUser;} ?>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="oldpassword">Old Password</label>
                                    
                                </td>
                                <td>:</td>
                                <td>
                                    <input type="oldpassword" id="oldpassword" name="oldpassword" value=""
                                        placeholder="Please enter your password...  "><br>
                                        <?php if(isset($_POST['submit'])){echo $erroroldpassword;} ?>
                                </td>
                            </tr>
                            </tr>
                            <tr>
                                <td>
                                    <label for="newpassword">New Password</label>
                                    
                                </td>
                                <td>:</td>
                                <td>
                                    <input type="newpassword" id="newpassword" name="newpassword" value=""
                                        placeholder="Please enter your password...  "><br>
                                        <?php if(isset($_POST['submit'])){echo $errornewpassword;} ?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label for="confirmpassword">Confirm Password</label>
                                    
                                </td>
                                <td>:</td>
                                <td>
                                    <input type="confirmpassword" id="confirmpassword" name="confirmpassword" value=""
                                        placeholder="Please enter your password...  "><br>
                                        <?php if(isset($_POST['submit'])){echo $errorconfirmpassword;echo $errormatchedpassword;} ?>
                                </td>
                            </tr>
                           
                           
                            <tr align="center">
                                
                                <td></td>
                                <td></td> 
                                <br>
                                <td><input type="submit" name="submit" value="Change Password" ></td>   
                            </tr>
                          

                            <tr>
                                <td></td>
                                <td></td> 
                                <td> <h4>Back to <a href="./login.php">Login page</a></h4></td>   
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