<?php
session_start();
$_SESSION['previous_location'] = 'list';
$pageName="Results";

include('db.php');
include('head.php');
include('header.php');

echo "<div class='small'>";

$SQL = "SELECT * FROM userID";
$exeSQL = mysqli_query($conn, $SQL) or die (mysqli_error($conn));
?>

<!-- content -->
<div role="main" data-theme="b" class="ui-content ui-body-b">

	<!-- search bar -->
	<form class="ui-filterable ui-group-theme-d" data-theme="d">
		<input id="searchpostcode" placeholder="Search for food" data-type="search">
	</form>

	<!-- filters & sortby buttons -->
	<p>
		<div class="ui-grid-b">
			<div class="ui-block-a"><button class="ui-btn ui-btn-c ui-mini ui-widget ui-corner-all" id="btnfilters" data-theme="c">Filters</button></div>
			<div class="ui-block-b"></div>
			<div class="ui-block-c"><button class="ui-btn ui-btn-c ui-mini ui-widget ui-corner-all" id="btnsort" data-theme="c">Sort</button></div>
		</div>
	</p>

	<!-- filter options -->
	<fieldset data-role="controlgroup" data-type="horizontal" data-mini="true" id="filterable">
		<label for="cuisine-filter">Cuisine:</label>
		<select name="cuisine-filter" id="cuisine-filter" data-native-menu="false" multiple="multiple" data-iconpos="left" data-theme="b">
			<option value="all-cuisines" data-placeholder="true">All Cuisines</option>
			<option value="american">American</option>
			<option value="british">British</option>
			<option value="chinese">Chinese</option>
			<option value="indian">Indian</option>
			<option value="italian">Italian</option>
			<option value="japanese">Japanese</option>
			<option value="thai">Thai</option>
			<option value="other">Other</option>
		</select>
		<label for="allergy-filter">Allergy:</label>
		<select name="allergy-filter" id="allergy-filter" data-native-menu="false" multiple="multiple" data-iconpos="left" data-theme="b">
			<option value="no-allergy" data-placeholder="true">No Allergy</option>
			<option value="fish">Fish</option>
			<option value="shellfish">Shellfish</option>
			<option value="nuts">Nuts</option>
			<option value="milk">Milk</option>
			<option value="egg">Egg</option>
			<option value="gluten">Gluten</option>
		</select>
		<label for="budget-filter">Budget:</label>
		<select name="budget-filter" id="budget-filter" data-native-menu="false" data-iconpos="left" data-theme="b">
			<option value="no-budget" selected>No Budget</option>
			<option value="low-budget">£</option>
			<option value="medium-budget">££</option>
			<option value="high-budget">£££</option>
		</select>
	</fieldset>

	<!-- sort options -->
	<fieldset data-role="controlgroup" data-type="horizontal" data-theme="b" data-mini="true" id="sortable">
		<input type="radio" name="sorting" id="low-high" value="low-high">
		<label for="low-high">Price Low-High</label>
		<input type="radio" name="sorting" id="high-low" value="high-low">
		<label for="high-low">Price High-Low</label>
		<!-- <input type="radio" name="sorting" id="distnace" value="distnace">
		<label for="distnace">Distance</label> -->
	</fieldset>

	<!-- listview -->
	<p style="margin-top: 30px"><ul data-role="listview" data-filter="true" data-input="#searchpostcode" class="searchable" id="sortlist">
	<?php
	while ($arrayp = mysqli_fetch_array($exeSQL)) {
		echo "<li class='" . $arrayp['prodCuisine'] . " " . $arrayp['prodAllergy'] . " ";
		if ($arrayp['prodPrice'] < 4) {
			echo "low-budget";
		} else if ($arrayp['prodPrice'] > 4 && $arrayp['prodPrice'] < 8) {
			echo "medium-budget";
		} else {
			echo "high-budget";
		}
		echo "' data-sort-price='" . $arrayp['prodPrice'] . "'>";
		echo "<a href='food.php?uProdId=" . $arrayp['uID'] . "'>";
		echo "<img src='images/" . $arrayp['prodPic'] . "' class='ui-li-thumb'>";
		echo "<h4>" . $arrayp['prodName'] . "</h4>";
		echo "<p>" . $arrayp['prodDShort'] . "</p>";
		echo "<p class='ui-li-aside' id='price'>&pound;" . $arrayp['prodPrice'] . "</p></a></li>";
	}
	?>
	</ul></p>
	<!-- /listview -->
</div>
</div>
<div role="main" data-theme="b" class="ui-content ui-body-b">
<div class='big'>
	<?php
	$SQL = "SELECT * FROM userID";
	$exeSQL = mysqli_query($conn, $SQL) or die (mysqli_error($conn));

	?>

	<!-- content -->
	<div class='leftcolumn'>
		<!-- search bar -->
		<form class="ui-filterable ui-group-theme-d" data-theme="d">
			<input id="searchpostcode" placeholder="Search for food" data-type="search">
		</form>

		<!-- filters & sortby buttons -->
		<p>
			<div class="ui-grid-b">
				<div class="ui-block-a"><button class="ui-btn ui-btn-c ui-mini ui-widget ui-corner-all" id="btnfilters" data-theme="c">Filters</button></div>
				<div class="ui-block-b"></div>
				<div class="ui-block-c"><button class="ui-btn ui-btn-c ui-mini ui-widget ui-corner-all" id="btnsort" data-theme="c">Sort</button></div>
			</div>
		</p>

		<!-- filter options -->
		<fieldset data-role="controlgroup" data-type="horizontal" data-mini="true" id="filterable">
			<label for="cuisine-filter">Cuisine:</label>
			<select name="cuisine-filter" id="cuisine-filter" data-native-menu="false" multiple="multiple" data-iconpos="left" data-theme="b">
				<option value="all-cuisines" data-placeholder="true">All Cuisines</option>
				<option value="american">American</option>
				<option value="british">British</option>
				<option value="chinese">Chinese</option>
				<option value="indian">Indian</option>
				<option value="italian">Italian</option>
				<option value="japanese">Japanese</option>
				<option value="thai">Thai</option>
				<option value="other">Other</option>
			</select>
			<label for="allergy-filter">Allergy:</label>
			<select name="allergy-filter" id="allergy-filter" data-native-menu="false" multiple="multiple" data-iconpos="left" data-theme="b">
				<option value="no-allergy" data-placeholder="true">No Allergy</option>
				<option value="fish">Fish</option>
				<option value="shellfish">Shellfish</option>
				<option value="nuts">Nuts</option>
				<option value="milk">Milk</option>
				<option value="egg">Egg</option>
				<option value="gluten">Gluten</option>
			</select>
			<label for="budget-filter">Budget:</label>
			<select name="budget-filter" id="budget-filter" data-native-menu="false" data-iconpos="left" data-theme="b">
				<option value="no-budget" selected>No Budget</option>
				<option value="low-budget">£</option>
				<option value="medium-budget">££</option>
				<option value="high-budget">£££</option>
			</select>
		</fieldset>

		<!-- sort options -->
		<fieldset data-role="controlgroup" data-type="horizontal" data-theme="b" data-mini="true" id="sortable">
			<input type="radio" name="sorting" id="low-high" value="low-high">
			<label for="low-high">Price Low-High</label>
			<input type="radio" name="sorting" id="high-low" value="high-low">
			<label for="high-low">Price High-Low</label>
			<!-- <input type="radio" name="sorting" id="distnace" value="distnace">
			<label for="distnace">Distance</label> -->
		</fieldset>

		<!-- listview -->
		<p style="margin-top: 30px"><ul data-role="listview" data-filter="true" data-input="#searchpostcode" class="searchable" id="sortlist">
		<?php
		while ($arrayp = mysqli_fetch_array($exeSQL)) {
			echo "<li class='" . $arrayp['prodCuisine'] . " " . $arrayp['prodAllergy'] . " ";
			if ($arrayp['prodPrice'] < 4) {
				echo "low-budget";
			} else if ($arrayp['prodPrice'] > 4 && $arrayp['prodPrice'] < 8) {
				echo "medium-budget";
			} else {
				echo "high-budget";
			}
			echo "' data-sort-price='" . $arrayp['prodPrice'] . "'>";
			echo "<a href='food.php?uProdId=" . $arrayp['uID'] . "'>";
			echo "<img src='images/" . $arrayp['prodPic'] . "' class='ui-li-thumb'>";
			echo "<h4>" . $arrayp['prodName'] . "</h4>";
			echo "<p>" . $arrayp['prodDShort'] . "</p>";
			echo "<p>" . $chefName . "&nbsp;&nbsp;&starf;&starf;&starf;&starf;&star;</p>";
			echo "<p class='ui-li-aside' id='price'>&pound;" . $arrayp['prodPrice'] . "</p></a></li>";
		}
		?>
		</ul></p>
		<!-- /listview -->
	</div>
	<div class='rightcolumn'>
<?php
$SQL = "SELECT * FROM userID";
$exeSQL = mysqli_query($conn, $SQL) or die (mysqli_error($conn));

$prodId = "1";

//$prodId = $_GET['uProdId'];

$SQL1="select * from userID where uID=".$prodId;
$exeSQL1=mysqli_query($conn, $SQL1) or die (mysqli_error($conn));
$arrayp1=mysqli_fetch_array($exeSQL);

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

//Reviews page

if (isset($_POST['submit'])){
  //$prodId = $_POST['uProdId'];
}else{
  //$prodId = $_GET['uProdId'];
}

$SQL2="select * from userID where uID=".$prodId;
$exeSQL2=mysqli_query($conn, $SQL2) or die (mysqli_error($conn));
$arrayp2=mysqli_fetch_array($exeSQL2);

$userid = $arrayp2['userID'];

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
 ?>

	  <div class="ui-grid-a">
	    <div class="ui-block-a">
			<img width="100%" src="images/<?php echo $arrayp1['prodPic']?>">
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

			<h3 class="redText"><?php echo $arrayp1['prodName']?></h2>
			<h3 class="greenText">£<?php echo $arrayp1['prodPrice']?></h2>
			<h3 class="greenText">1.5 miles away</h2>
	    </div>
	</div><!-- /grid-b -->

	  <div class="ui-grid-a">
	      <div class="ui-block-a"><p>Cuisine: <?php echo $arrayp1['prodCuisine'] ?></p><p>Allergies: <?php echo $arrayp1['prodAllergy'] ?></p></div>
	      <div class="ui-block-c"><p>Calories: <?php echo $arrayp1['prodCals'] ?></p><p>Serving: <?php echo $arrayp1['prodServ'] ?></p></div>
	</div>
	<?php echo "Prod pic is: ".$chefPic ?>
	<h2 class="redText">Description</h2>
	<p><?php echo $arrayp1['prodDLong']?></p>

<a href="index.php" style="text-decoration= none;">
	<div class="ui-body cook_padding ui-body-a ui-corner-all">
		<table>
			<tr>
				<td>
					<div><img class="profile_avatar" src="images/<?php echo $chefPic ?>"></div>
	</td>
	<td>
	  <span class="cook_name_bar"><?php echo $chefName. " " .$output ?><p>View previous reviews and add yours</p></span>
</td>
<td>
	<span class="arrow_btn">&#62;</span>
</td>
</tr>
</table>
	</div>
	</a>
	<div id="map"></div>
	    <script>
	      function initMap() {
	        var uluru = {lat: 51.519447, lng: -0.127236};
	        var map = new google.maps.Map(document.getElementById('map'), {
	          zoom: 15,
	          center: uluru
	        });
	        var marker = new google.maps.Marker({
	          position: uluru,
	          map: map
	        });
	      }
	    </script>
	    <script async defer
	    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDHJSMHYOhouihJw618SYWsayqXfcK87nc&callback=initMap">
	    </script>

			<div class="centerElement">
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
		    <span><input type="radio" name="rating" id="str5" value="5"><label for="str5" style="padding-left: 13px;"> &#9733;</label></span>
		    <span><input type="radio" name="rating" id="str4" value="4"><label for="str4" style="padding-left: 13px;"> &#9733;</label></span>
		    <span><input type="radio" name="rating" id="str3" value="3"><label for="str3" style="padding-left: 13px;"> &#9733;</label></span>
		    <span><input type="radio" name="rating" id="str2" value="2"><label for="str2" style="padding-left: 13px;"> &#9733;</label></span>
		    <span><input type="radio" name="rating" id="str1" value="1"><label for="str1" style="padding-left: 13px;"> &#9733;</label></span>
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
		<?php

		$SQL="select * from Comments where userId=".$userid;

		$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));
		echo "<div class='centerElement'>";

		while ($arrayy=mysqli_fetch_array($exeSQL))
		{
		  $output2 = '';
		  for($i=0; $i<$arrayy['c_rating']; $i++){
		    $output2 .= "<img class='starDisplay' src='images/sta.png' alt='star'>";
		  }
			echo"<table style='background-color: white; margin-bottom: 1%; border-radius: 5px;'>";
			echo "<tr>";
			echo "<td style='border: 10px'>";
			echo "<h3>".$arrayy['c_name']."</h3>";
			echo "</td>";
			echo "<td style='border: 0px'>";
			echo "<p><h2>".$output2."</h2>";
			echo "<p>".$arrayy['c_comment'];
			echo "</td>";
			echo "</tr>";
			echo "</table>";
		}
		echo "</div>";
		?>
</div>
</div>
</div>
<?php
include('footer.php');
?>
