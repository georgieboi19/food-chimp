<?php
session_start();
$pageName="Edit Profile";
include('head.php');
include('header.php');
include('db.php');

$uId = "3";
echo "<div role='main' class='ui-content ui-body-b' data-theme='b'>";
//$uId = $_SESSION['user_id'];

if ($stmt = $conn->prepare("SELECT userName, userEmail, userHash
        FROM Users
       WHERE uId = ?")) {
        $stmt->bind_param('s', $uId);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($userName, $userEmail, $userPassword);
        $stmt->fetch();
      }

if (isset($_REQUEST['submit'])){
$name = $_POST['fName'];
$email = $_POST['userEmail'];
$pass1 = $_POST['userPass1'];
$pass2 = $_POST['userPass2'];
$pass3 = $_POST['userPass3'];

        if(preg_match("/^[^@]+@[^@]+\.[a-z]{2,6}$/i",$email)){
          if ($pass1 != '' && $pass2 !='' && $pass3 !=''){
            if ($pass2 == $pass3){
              $hash = password_hash($pass, PASSWORD_DEFAULT);
              if (password_verify($pass1, $userPassword)) {
                echo "<h2 class='centerWidget fullPage'>Changes updated</h2></div>";
                include('footer.php');
                $stmt = $conn->prepare("UPDATE Users SET userName = ?, userEmail = ?, userHash = ?
                WHERE uId = ?");
                $stmt->bind_param('ssss',$name, $email, $hash, $uId);
                $stmt->execute();
                  die();
              }else{
                echo "Incorrect password";
              }
            }else{
              echo "Password doesnt match";
            }
          }else{
            //echo "<h2 class='centerWidget fullPage'>Changes updated</h2>
            //<a class='ui-btn' href='#'Back to Dashboard</a>";
            echo "<h2 class='centerWidget fullPage'>Changes updated</h2></div>";
            include('footer.php');
            $stmt = $conn->prepare("UPDATE Users SET userName = ?, userEmail = ?
            WHERE uId = ?");
            $stmt->bind_param('sss',$name, $email, $uId);
            $stmt->execute();
            die();
          }
      } else{
        echo "Wrong email format";
      }

}else{
echo "<div>
<h2 style='text-align: center'>Edit Account Details</h2>
<form name='editAcc' class='centerElement' action='' method=POST enctype=multipart/form-data onsubmit='return validateEditAcc()'>
<table style='border: 5px; max-width: 280px;' class='centerWidget4'>
<tr>
<td class='formLabel'>Full Name</td>
</tr>
<tr>
<td><input type=text name=fName value='".$userName."' placeholder='Full Name' required data-theme='a'></td>
</tr>
<tr>
<td><span id=msg1></span></td>
</tr>
<tr>
<td class='formLabel'>Email</td>
</tr>
<tr>
<td><input type=email name=userEmail value='".$userEmail."' placeholder='Email' required data-theme='a'></td>
</tr>
<tr>
<td><span id=msg2></span></td>
</tr>
<tr>
<td class='formLabel'>Old Password</td>
</tr>
<tr>
<td><input type=password name=userPass1 data-theme='a'></td>
</tr>
<tr>
<td class='formLabel'>New Password</td>
</tr>
<tr>
<td><input type=password name=userPass2 data-theme='a'></td>
</tr>
<tr>
<td class='formLabel'>Confirm New Password</td>
</tr>
<tr>
<td><input type=password name=userPass3 data-theme='a'></td>
</tr>
<tr>
<td><span id=msg3></span></td>
</tr>
<td>
<div class='ui-grid-a'>
<div class='ui-block-a'><a href='dashboard.php' class='ui-btn ui-btn-c ui-corner-all'>Back</a></div>
<div class='ui-block-b'><input type='submit' value='Save' data-wrapper-class='greenbtn'></div>
</div>
</td>
</tr>
</table>
</form></div>";
}
?>
</div><!-- /content -->
<?php
include('footer.php');
?>

<!-- <a href='dashboard.php' class='ui-btn ui-btn-c ui-corner-all formBtn'>Back</a>
<div id='formBtn2'><input type=submit value='Save' name=submit></div> -->