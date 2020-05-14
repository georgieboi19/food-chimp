<?php
session_start();
error_reporting(E_ALL); ini_set('display_errors', 'On');
var_dump($_POST);
$pageName="Product";
include('head.php');
include('header.php');
include('db.php');

//$prodId = "1";

$prodId = $_GET['uProdId'];

$SQL="select * from userID where uID=".$prodId;
$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error());
$arrayp=mysqli_fetch_array($exeSQL);

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
FROM Comments GROUP BY userId') as $row) {
$average = floor($row['AVG(c_rating)']);
}
$output = '';
for($i=0; $i<$average; $i++){
  $output .= "<img class='starDisplay' src='images/sta.png' alt='star'>";
}
//$sql    = 'SELECT * AS avgColName FROM Comments;';
//$query  = mysqli_query($sql);
//$result = mysqli_fetch_assoc($query);
//echo $result['avgColName'];
//console.log("TEST");


echo "<div role='main' data-theme='a' class='ui-content ui-body-a'>";
?>
  <div class="ui-grid-a">
    <div class="ui-block-a">
		<img width="100%" src="images/<?php echo $arrayp['prodPic']?>">
	</div>
    <div class="ui-block-b centerElement">

		<!-- favourites button-->
		<form action="" method="post">

		<!-- CHECK DATABASE FAVOURITE LIST (set checkbox accordingly) -->
		<input type="checkbox" name="favourite" id="favourite" class="custom" value="Add"
			<?php $wishlist = $conn->query("SELECT uId FROM prodFavourite WHERE prodId=".$prodId);
			 //if food is in database
			if($wishlist->num_rows !== 0) {
				 echo 'checked="checked"';
			}?> onchange="this.form.submit()">
        <label for="favourite"><span class="ui-icon-heart ui-btn-icon-notext"></span></label>
		</form>
		<?php

			//USER WANTS TO ADD FOOD (on checkbox change)
			if(isset($_POST['favourite']) && $_POST['favourite'] == 'Add')
				{
					//FOOD NOT IN FAVOURITE LIST (database)
					if($wishlist->num_rows == 0){
						$message1 = "Added.";
						echo "<script type='text/javascript'>alert('$message1'); $('#favourite').prop('checked', true);</script>";

						$add_wishlist = $conn->prepare("INSERT INTO prodFavourite (usersId, prodId) VALUES(?,?)");
						$add_wishlist->bind_param('ii',$usersId, $prodId);
						$add_wishlist->execute();
						$add_wishlist ->close();
						//$add_wishlist = "INSERT INTO prodFavourite (usersId, prodId) VALUES ('.$_SESSION['user_id'].', '.$prodId.')";
						//$exeSQL1 = mysqli_query($conn, $add_wishlist) or die (mysqli_error());
				}

			//USER WANTS TO REMOVE FOOD (on checkbox change)
			}else
				{
				 	//$previous_location = $_SESSION['previous_location'];
					//if($previous_location !== "list"){

						//FOOD IN FAVOURTIE LIST (database)
						if($wishlist->num_rows !== 0){
							$message2 = "Removed.";
							echo "<script type='text/javascript'>alert('$message2'); $('#favourite').prop('checked', false);</script>";

							if($remove_wishlist = $conn->prepare("DELETE FROM prodFavourite WHERE usersId=? AND prodId=?")){
								$remove_wishlist->bind_param('ii',$usersId, $prodId);
								$remove_wishlist->execute();
								$remove_wishlist ->close();
								//$remove_wishlist = "DELETE FROM prodFavourite WHERE usersId=".$_SESSION['user_id']."AND prodId=".$prodId;
								//$exeSQL2 = mysqli_query($conn, $remove_wishlist);
							 }
						 }
					  //}
				  }
		?>

		<h2 class="redText"><?php echo $arrayp['prodName']?></h2>
		<h3 class="greenText">£<?php echo $arrayp['prodPrice']?></h2>
		<h3 class="greenText">1.5 miles away</h2>
    </div>
</div><!-- /grid-b -->

  <div class="ui-grid-a">
      <div class="ui-block-a"><p>Cuisine: <?php echo $arrayp['prodCuisine'] ?></p><p>Allergies: <?php echo $arrayp['prodAllergy'] ?></p></div>
      <div class="ui-block-c"><p>Calories: <?php echo $arrayp['prodCals'] ?></p><p>Serving: <?php echo $arrayp['prodServ'] ?></p></div>
</div>
<!-- echo "Prod pic is: ".$chefPic -->
<h2 class="redText">Description</h2>
<p><?php echo $arrayp['prodDLong']?></p>
<br>
<p>
<ul data-role="listview" data-theme="a">
    <li><a href="chef.php">
        <img class="profile_avatar" src="images/<?php echo $chefPic ?>">
        <h2><?php echo $chefName. " " .$output ?></h2>
        <p>View previous reviews and add yours</p>
    </a></li>
</ul>
<br>
</p>

<!-- <div class="ui-body ui-body-a ui-corner-all">
<a href="chef.php"><div><img class="profile_avatar" src="images/<?php echo $chefPic ?>"></div>
  <span class="cook_name_bar"><?php echo $chefName. " " .$output ?><p>View previous reviews and add yours</p></span>
<span class="ui-icon-carat-r ui-btn-icon-notext"></span></a>
</div>-->

</div><!-- /content -->

<!-- <div data-role="footer" data-id="foo1" data-position="fixed">
	<div data-role="navbar">
		<ul>
			<li><a class='ui-btn-active' data-theme="c" data-icon="info" href="food.php?uProdId=<?php echo $prodId ?>">Info</a></li>
			<li><a data-theme="c" data-icon="comment" href="reviews.php?uProdId=<?php echo $prodId ?>">Comments</a></li>
			<li><a data-theme="c" data-icon="location" href="map.php?uProdId=<?php echo $prodId ?>">Map</a></li>
		</ul>
	</div>
</div> -->

<div data-role="footer" data-id="foo1" data-position="fixed">
	<div data-role="navbar">
		<ul>
			<li><a class='ui-btn' data-theme="a" href="#">Order Now</a></li>
		</ul>
	</div>
	<div data-role="navbar">
		<ul>
			<li><a class='ui-btn-active' data-theme="c" data-icon="info" href="food.php?uProdId=<?php echo $prodId ?>">Info</a></li>
			<li><a data-theme="c" data-icon="comment" href="reviews.php?uProdId=<?php echo $prodId ?>">Comments</a></li>
			<li><a data-theme="c" data-icon="location" href="map.php?uProdId=<?php echo $prodId ?>">Map</a></li>
		</ul>
	</div><!-- /navbar -->
</div>

<?php
include('footer.php');
?>
