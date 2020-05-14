<?php
session_start();
$pageName="Login";
include('head.php');
include('header.php');
include('db.php');

echo "<div role='main' class='ui-content ui-body-b' data-theme='b'>";
if (isset($_REQUEST['submit'])){
  $email = $_POST['userEmail'];
  $pass = $_POST['userPass'];

  if ($stmt = $conn->prepare("SELECT uId, userName, userEmail, userHash
          FROM Users
         WHERE userEmail = ?")) {
          $stmt->bind_param('s', $email);
          $stmt->execute();
          $stmt->store_result();
          $stmt->bind_result($uId, $userName, $userEmail, $userPassword);
          $stmt->fetch();
  }

  if (password_verify($inPass, $userPassword)) {
      $_SESSION['logged_in'] = "1";
      $_SESSION['user_name'] = $userName;
      $_SESSION['user_id'] = $uId;
  $URL="https://georgeharrison-webb.co.uk/mue/index.php";
      echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
      echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
      die();
  }else{
    echo "Incorrect password or email address";
  }

}else{
  echo "<div class='centerWidget fullPage'>
  <img width='60%' src='images/LogIn/logo.png'>
  <h1 class='redText sign_text'>Sign In</h1>
  <form action='' class='centerElement' method=POST enctype=multipart/form-data>
  <table style='border: 5px'>
  <tr>
  <td style='color:black'>Email Address</td>
  </tr>
  <tr>
  <td><input type=email name=userEmail data-theme='c'></td>
  </tr>
  <tr>
  <td style='color:black'>Password</td>
  </tr>
  <tr>
  <td><input type=password name=userPass data-theme='c'></td>
  </tr>
  <td><input type=submit value='Sign In' name=submit class='ui-btn ui-shadow ui-corner-all ui-btn-a' data-theme='a'></td>
  </tr>
  </table>
  </form>
  <p style='color:black'>Don't have an account?</p><a class='sign_link' href='signup.php'><span class='sign_link'>Sign Up</span></a></div>";
}?>
</div>

<?php
include('footer.php');
?>
