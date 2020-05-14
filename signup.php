<?php
$pageName="Home";
include('head.php');
include('header.php');
include('db.php');
echo "<div role='main' class='ui-content ui-body-b' data-theme='b'>";
  if (isset($_REQUEST['submit'])){
    $name = $_POST['userName'];
    $email = $_POST['userEmail'];
    $pass = $_POST['userHash'];
    $hash = password_hash($pass, PASSWORD_DEFAULT);

    echo "<div class='fullPage centerWidget'> <h2 class='greenText'>Sign Up Complete</h2>
    <p>Congraulations!<br> You have successfully signed up.</p><a class='ui-btn ui-shadow ui-corner-all ui-btn-a ui-btn-extra' data-theme='a' href='dashboard.php'>Dashboard</a><a class='ui-btn ui-shadow ui-corner-all ui-btn-a ui-btn-extra' data-theme='a' href='index.php'>Home Page</a></div>";
    if(preg_match("/^[^@]+@[^@]+\.[a-z]{2,6}$/i",$email)){
    $result = $conn->query("SELECT * FROM Users WHERE userEmail='$email'") or die($conn->error);
    if ( $result->num_rows > 0 ) {
      echo "Email address is already registered";
    }else{
        $stmt = $conn->prepare("INSERT INTO Users (userName, userEmail, userHash)
        VALUES(?,?,?)");
        $stmt->bind_param('sss',$name, $email, $hash);
        $stmt->execute();
        $to = $email;
        $subject = 'Signed up!';
        $message_body = '
        Hello, '.$name.',

        Thank you for signing up to Food Chimp! 
        We hope you enjoy ordering!
		
		-Team FoodChimp';

        mail( $to, $subject, $message_body );
      }
    } else{
      echo "Sorry invalid email";
  }
  } else{
    echo "<div class='centerWidget_other2 fullPage_other2'>
    <h1 class='redText sign_text'>Sign Up</h1>
    <form action='' class='centerElement' method=POST enctype=multipart/form-data>
    <table style='border: 5px'>
	  <tr>
  	  <td style='color:black'>Full Name</td>
  	</tr>
    <tr>
      <td><input type=text name=userName data-theme='c'></td>
    </tr>
	  <tr>
  	  <td style='color:black'>Email</td>
  	</tr>
    <tr>
      <td><input type=email name=userEmail data-theme='c'></td>
    </tr>
	  <tr>
  	  <td style='color:black'>Password</td>
  	</tr>
    <tr>
      <td><input type=password name=userHash data-theme='c'></td>
    </tr>
	  <tr>
  	  <td style='color:black'>Confirm Password</td>
  	</tr>
    <tr>
      <td><input type=password name=userPas data-theme='c'></td>
    </tr>
    <tr>
      <td><input type='checkbox' name='checkbox-agree' id='checkbox-agree' class='ui-shadow ui-corner-all' data-theme='b' data-mini='true'>
      <label for='checkbox-agree'>I agree to the <a href='#'>Terms and Conditions</a>.</label></td>
    </tr>
    <tr>
      <td><input type=submit value='Sign Up' name=submit class='ui-btn ui-shadow ui-corner-all ui-btn-a' data-theme='a'></td>
    </tr>
    </table>
    </form>
    <p style='color:black'>Already have an account?</p><a class='sign_link' href='login.php'><span class='sign_link'>Sign In</span></a></div>";
  }
?>
</div><!-- /content -->

<?php
include('footer.php');
?>
