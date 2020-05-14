<?php
$pageName="About the Chef";
include('head.php');
include('header.php');
include('db.php');

$uId = 1;

//$_SESSION['user_id'] = $uId;
$SQL="select * from userID where userID=".$uId;
$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));

?>

<div role='main' data-theme='d' class='ui-content ui-body-d'>
	
<h2 class="redtext">About the Chef</h2>
 <div>
    <div><img class="profile_avatar" style="width: 30%" src="images/christopher-campbell-rDEOVtE7vOs-unsplash.png"></div>
	<span class="cook_name_bar"><h3>Katty</h3></span>
	<img class='starDisplay' src='images/sta.png' alt='star'>
	<img class='starDisplay' src='images/sta.png' alt='star'>
	<img class='starDisplay' src='images/sta.png' alt='star'>
	<img class='starDisplay' src='images/sta.png' alt='star'>
	 <p style="clear: both">I use simple, fresh ingredients and transform them into sophisticated and elegant meals you'll enjoy!</p>
    </div>

<!-- filters & sortby buttons -->
	<p>
		<div class="ui-grid-b">
			<div class="ui-block-a redText"><h3>My Dishes</h3></div>
			<div style="padding-right: 5px" class="ui-block-b"><button class="ui-btn ui-btn-c ui-mini ui-widget ui-corner-all" id="btnfilters" data-theme="c">Filters</button></div>
			<div style="padding-left: 5px" class="ui-block-c"><button class="ui-btn ui-btn-c ui-mini ui-widget ui-corner-all" id="btnsort" data-theme="c">Sort</button></div>
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
	</fieldset> <br>
	
<p><ul data-role="listview" data-filter="true" data-input="#searchdish" class="searchable">
	
<?php
while ($arrayp = mysqli_fetch_array($exeSQL)) {
  echo "<li data-theme='b' data-role='listview' class='" . $arrayp['prodCuisine'] . " " . $arrayp['prodAllergy'] . " ";
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
  echo "<p>" . $arrayp['prodDShort'] . "</p>";
  echo "<p class='ui-li-aside'>&pound;" . $arrayp['prodPrice'] . "</p></a></li>";
}
echo "<br>";
?>
</div><!-- /content -->

<?php
include('footer.php');
?>
