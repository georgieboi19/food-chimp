<?php
session_start();
$pageName="My Favourites List";

include('head.php');
include('header.php');
include('db.php');

$userId = "1";

//$userId = $_SESSION['user_id'];

//$SQL = "SELECT * FROM userID";
// uID, prodId, prodName, prodPic, prodPrice, prodDShort
//$exeSQL = mysqli_query($conn, $SQL) or die (mysqli_error());
//$arrayp = mysqli_fetch_array($exeSQL);
?>

<div role='main' data-theme="b" class="ui-content ui-body-b">
	<h1 class="centerElement">My Favourites List</h1>
	
	<!-- SEARCH -->
	<form class="ui-filterable ui-group-theme-d centerWidget2" data-theme="d">
		<label for="searchfavourite" style="color: black">Search saved food:</label>
  		<input id="searchfavourite" placeholder="Enter keyword" data-type="search">
	</form>
	<!-- FILTER -->
	<div class="centerWidget2">
   <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true" id="filters">
	<legend style="color: black; text-align: center; margin: auto;">Filter by:</legend>
		
	<!-- CUISINE -->
	<label for="cuisine-filter">Cuisine</label>
	<select name="cuisine-filter" id="cuisine-filter" data-iconpos="left" multiple="multiple" data-native-menu="false"   data-theme="b">
		<option>Cuisine</option>
		<option value="all-cuisines">All Cuisines</option>
		<option value="american">American</option>
		<option value="british">British</option>
		  <option value="italian">Italian</option>
		<option value="chinese">Chinese</option>
		<option value="indian">Indian</option>
		<option value="japanese">Japanese</option>
		<option value="thai">Thai</option>
		<option value="other">Other</option>
	 </select>
		
	 <!-- ALLERGY -->
	 <label for="allergy-filter">Allergy</label>
	 <select name="allergy-filter" id="allergy-filter" data-iconpos="left" multiple="multiple" data-native-menu="false" data-theme="b">
		<option>Allergy</option>
		<option value="no-allergy">No Allergy</option>
		<option value="fish">Fish</option>
		<option value="shellfish">Shellfish</option>
		<option value="nuts">Nuts</option>
		<option value="white-meat">White Meat</option>
		<option value="gluten">Gluten</option>
	  </select>
		
	  <!-- BUDGET -->
	  <label for="budget-filter">Budget</label>
	  <select name="budget-filter" id="budget-filter" data-iconpos="left" data-native-menu="false" data-theme="b">
		<option>Budget</option>
		<option value="no-budget">No Budget</option>
		<option value="low-budget">£</option>
		<option value="medium-budget">££</option>
		<option value="high-budget">£££</option>
	  </select>
		
	 </fieldset>
	</div>
	<br>
	
	<p><ul data-role="listview" data-filter="true" data-input="#searchfavourite" class="searchable">
	
	<?php
	
	// SELECT ALL FOOD ADDED TO WISHLIST BY USER 1
	$wishlist = "SELECT * FROM prodFavourite WHERE usersId=".$userId;
	$exe_wishlist = mysqli_query($conn, $wishlist);
	$count = 1;
	while($array_wishlist=mysqli_fetch_array($exe_wishlist)){
		
		//FIND IN FOODLIST ALL FOOD ADDED TO WISHLIST BY USER 1
		$foodlist = "SELECT * FROM userID WHERE uID=".$array_wishlist['prodId'];
		$exe_foodlist = mysqli_query($conn, $foodlist);
		$arrayp = mysqli_fetch_array($exe_foodlist);
		
		echo "<li data-icon='delete' class='" . $arrayp['prodCuisine'] . " " . $arrayp['prodAllergy'] . " ";
		if ($arrayp['prodPrice'] < 4) {
			echo "low-budget";
		} else if ($arrayp['prodPrice'] > 4 && $arrayp['prodPrice'] < 8) {
			echo "medium-budget";
		} else {
			echo "high-budget";
		}
		echo "'>";
		echo "<a href='editProduct.php?uProdId=" . $arrayp['uID'] . "'>";
		echo "<img src='images/" . $arrayp['prodPic'] . "' class='ui-li-thumb'>";
		echo "<h4>" . $arrayp['prodName'] . "</h4>";
		$message .= $count ++;
		$message .= ". ";
		$message .= $arrayp['prodName'];
		$message .= "\n";
		echo "<p>" . $arrayp['prodDShort'] . "</p>";
		echo "<p class='ui-li-aside'>&pound;" . $arrayp['prodPrice'] . "</p></a></li>";
	}
	
	//CREATE EMAIL FAVOURITE LIST FORM
	echo"<form class='centerWidget_fav' style='width: 40vw' action='' method=POST enctype=multipart/form-data>
	<label for='userEmail' style='color:black; text-align: center; margin-top: 1.5vw;'>Email your Favourite List:</label>
	<input type='email' id='userEmail' name='email_fav' data-theme='c' placeholder='email address'>
	<input type='submit' value='Send' name='submit' class='ui-btn ui-shadow ui-corner-all ui-btn-a' data-theme='a'>
	<form>";
	
	//EMAIL FAVOURITE LIST TO USER
	$email_address = "w1649234@my.westminster.ac.uk"; 	// FoodChimp Email Address 
	$myemail = $_POST['email_fav']; 	// User Email Address 
	
	
	$errors = "";
	
	// check if email address was entered
	if(empty($_POST['email_fav'])) {
		$errors .= "\n Error: all fields are required";
	}

	// check if email address has correct format
	if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $email_address)) {
		$errors .= "\n Error: Invalid email address";
	}

	if( empty($errors)){
		echo "<script type='text/javascript'>alert('$myemail');</script>";
		$to = $myemail;
		$email_subject = "Your FOODCHIMP Favourite List";
		$email_body = "Hello!\n \nThank you for visiting FoodChimp. Here is your list with all the dishes you've saved for later review: \n"."\n$message"."\n We hope you'll decide on the perfect dish for you! \n \n Team FoodChimp";
		$headers = "From: $myemail\n";
		$headers .= "Reply-To: $email_address";
		mail($to, $email_subject, $email_body, $headers);
	}
		
	?>
</div><!-- /content -->

<?php
include('footer.php');
?>