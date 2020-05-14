<?php
session_start();
$_SESSION['previous_location'] = 'list';
$pageName="Results";

include('db.php');
include('head.php');
include('header.php');

// product info
$SQL = "SELECT * FROM userID";
$exeSQL = mysqli_query($conn, $SQL) or die (mysqli_error($conn));

// chef info
$SQL = "SELECT userName FROM Users";
$exeChefSQL = mysqli_query($conn, $SQL) or die (mysqli_error($conn));
$arrayc = mysqli_fetch_array($exeChefSQL);
$chefName = $arrayc['userName'];
	  
// // rating info
// foreach($conn->query('SELECT AVG(c_rating)
// FROM Comments GROUP BY userId') as $row) {
// $average = floor($row['AVG(c_rating)']);
// }
// $output = '';
// for($i = 0; $i < $average; $i++){
// $output .= "&starf;";
// }
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
		echo "<p>" . $chefName . "&nbsp;&nbsp;&starf;&starf;&starf;&starf;&star;</p>";
		echo "<p class='ui-li-aside' id='price'>&pound;" . $arrayp['prodPrice'] . "</p></a></li>";
	}
	?>
	</ul></p>
	<!-- /listview -->
</div>
<?php
include('footer.php');
?>
