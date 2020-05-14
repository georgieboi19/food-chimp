<?php
session_start();
$pageName="Dashboard";
include('head.php');
include('header.php');
include('db.php');

$prodId = "1";
$usersid = "1";

//$prodId = $_GET['uProdId'];
//$usersid = $_SESSION['user_id'];
$SQL="select * from userID where uID=".$prodId;
$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));
$arrayp=mysqli_fetch_array($exeSQL);

if (  $stmt = $conn->prepare("SELECT usersPoints
        FROM Users WHERE uId=".$usersid)){
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($points);
        $stmt->fetch();
      }

foreach($conn->query('SELECT AVG(c_rating)
FROM Comments') as $row) {
$average = floor($row['AVG(c_rating)']);
}
$output = '';
if($average > 0){
for($i=0; $i<$average; $i++){
  $output .= "<img class='starDisplay' src='images/sta.png' alt='star'>";
}
}else{
  $output .="No rating yet";
}
?>
<div role="main" class='ui-content ui-body-b' data-theme='b'>
  <div class="centerElement">
    <h1 style="color:black">Dashboard</h1>
    <div style="color:black">Your customer score: <?php echo $points ?>/10<br>
     Your cook rating: <?php echo $output ?></div>
    <br>
    <a href="editProfile.php"><img src="images/edit_acc.png"></a>
    <a href="favourites.php"><img src="images/view_fav.png"></a>
    <a href="list.php"><img src="images/order_foo.png"></a>
    <a href="mydishes.php"><img src="images/offer_foo.png"></a>
  </div>
	<br>
	<span style="margin-left: 11px"><img width="40px" src="images/dashboardBLACK (4).png">
	<a class='sign_link' href='logout.php'><span class='sign_link'>Log Out</span></a></span>
	
</div><!-- /content -->

<?php
include('footer.php');
?>
