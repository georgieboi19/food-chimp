<?php
$pageName="My Dishes";
include('head.php');
include('header.php');
include('db.php');

$uId = 10;

//$_SESSION['user_id'] = $uId;
$SQL = "SELECT * FROM userID WHERE userID=".$uId;
$exeSQL = mysqli_query($conn, $SQL) or die (mysqli_error($conn));
?>

<div role='main' data-theme='b' class='ui-content ui-body-b'>

<h1 class="centerElement">My Dishes</h1>
<a href="offerFood.php" class="ui-btn ui-shadow ui-corner-all ui-btn-a" data-theme="a">Create New Dish</a>

<br>
<form class="ui-filterable ui-group-theme-d" data-theme="d">
	<label for="searchdish">Search your food:</label>
  	<input id="searchdish" placeholder="Enter keyword" data-type="search">
</form>
<br>

<p><ul data-role="listview" data-filter="true" data-input="#searchdish" class="searchable">

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
  echo "'>";
  echo "<a href='editProduct.php?uProdId=" . $arrayp['uID'] . "'>";
  echo "<img src='images/" . $arrayp['prodPic'] . "' class='ui-li-thumb'>";
  echo "<h4>" . $arrayp['prodName'] . "</h4>";
  echo "<p>" . $arrayp['prodDShort'] . "</p>";
  echo "<p class='ui-li-aside'>&pound;" . $arrayp['prodPrice'] . "</p></a></li>";
}
?>
</ul></p>
</div><!-- /content -->

<?php
include('footer.php');
?>
