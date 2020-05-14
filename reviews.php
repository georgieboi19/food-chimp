<?php
var_dump($_POST);
error_reporting(E_ALL); ini_set('display_errors', 'On');
$pageName="Reviews";
include('head.php');
include('header.php');
include('db.php');

//$prodId = "1";
if (isset($_POST['submit'])){
  $prodId = $_POST['uProdId'];
}else{
  $prodId = $_GET['uProdId'];
}
$SQL="select * from userID where uID=".$prodId;
$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error());
$arrayp=mysqli_fetch_array($exeSQL);

$userid = $arrayp['userID'];

//$usersId = $arrayp['userID'];
$usersId = '1';
if (  $stmt = $conn->prepare("SELECT userName, userPic
        FROM Users WHERE uId=".$usersId)){
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($chefName, $chefPic);
        $stmt->fetch();
      }

foreach($conn->query('SELECT AVG(c_rating)
FROM Comments WHERE userId='.$userid) as $row) {
$average = floor($row['AVG(c_rating)']);
}
$output = '';
for($i=0; $i<$average; $i++){
  $output .= "<img class='starDisplay' src='images/sta.png' alt='star'>";
}
if (isset($_POST['submit'])){
  $c_name = $_POST['userName'];
  $c_rating = $_POST['rating'];
  $c_comment = $_POST['userComment'];
  $stmt = $conn->prepare("INSERT INTO Comments (prodId, c_name, c_rating, c_comment, userId)
  VALUES(?,?,?,?,?)");
  $stmt->bind_param('sssss',$prodId, $c_name, $c_rating, $c_comment, $userid);
  $stmt->execute();
  echo "<h2 class='blueText centerElement'>Review recorded!</h2>";
}
echo "<div role='main' data-theme='a' class='ui-content ui-body-a'>";
?>
  <div class="centerWidget2">
    <h2 class ='redText'><?php echo $arrayp['prodName']?></h2>

    <div class="ui-body ui-body-a ui-corner-all">
    <a href="chef.php"><div><img class="profile_avatar" src="images/profileimage.jpg"></div>
      <span class="cook_name_bar"><?php echo $chefName. " " .$output ?></span></a>
    </div>
<h2>Your Review</h2>
<p>Let <?php echo $chefName ?> know what you thought of her dish!</p>
<form action="" method="POST" enctype="multipart/form-data" class="centerElement">
<table>
<tr>
<td>Name</td>
</tr>
<tr>
<td><input type="text" name="userName"><input type="hidden" name="uProdId" value="<?php echo $prodId ?>"></td>
</tr>
<tr>
<td>Rating</td>
</tr>
<tr>
<td><div class="rating">
    <span><input type="radio" name="rating" id="str5" value="5"><label for="str5" style="padding-left: 13px;">&#9733;</label></span>
    <span><input type="radio" name="rating" id="str4" value="4"><label for="str4" style="padding-left: 13px;">&#9733;</label></span>
    <span><input type="radio" name="rating" id="str3" value="3"><label for="str3" style="padding-left: 13px;">&#9733;</label></span>
    <span><input type="radio" name="rating" id="str2" value="2"><label for="str2" style="padding-left: 13px;">&#9733;</label></span>
    <span><input type="radio" name="rating" id="str1" value="1"><label for="str1" style="padding-left: 13px;">&#9733;</label></span>
</div></td>
</tr>
<tr>
<td>Add your comment</td>
</tr>
<tr>
<td><textarea type=text name=userComment></textarea></td>
</tr>
<td><input type=submit value='Submit' name=submit></td>
</tr>
</table>
</form>
</div>
</div><!-- /content -->

<div data-role="footer" data-id="foo1" data-position="fixed">
	<div data-role="navbar">
		<ul>
			<li><a data-theme="c" data-icon="info" href="food.php?uProdId=<?php echo $prodId ?>">Info</a></li>
			<li><a class="ui-btn-active" data-theme="c" data-icon="comment" href="reviews.php?uProdId=<?php echo $prodId ?>">Comments</a></li>
			<li><a data-theme="c" data-icon="location" href="map.php?uProdId=<?php echo $prodId ?>">Map</a></li>
		</ul>
	</div><!-- /navbar -->
</div>

<?php

$SQL="select * from Comments where userId=".$userid;

$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));
echo "<div class='centerElement'>";
echo"<table style='border: 10px, color: black'>";

while ($arrayy=mysqli_fetch_array($exeSQL))
{
  $output2 = '';
  for($i=0; $i<$arrayy['c_rating']; $i++){
    $output2 .= "<img class='starDisplay' src='images/sta.png' alt='star'>";
  }
	echo "<tr>";
	echo "<td style='border: 10px'>";
	echo "<h3>".$arrayy['c_name']."</h3>";
	echo "</td>";
	echo "<td style='border: 0px'>";
	echo "<p><h2>".$output2."</h2>";
	echo "<p>".$arrayy['c_comment'];
	echo "</td>";
	echo "</tr>";
}
echo "</table>";
echo "</div>";


include('footer.php');
?>
