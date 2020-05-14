<?php
session_start();
$_SESSION['previous_location'] = 'list';
$pageName="My dishes";

include('head.php');
include('header.php');
include('db.php');


?>

<div role="main" data-theme="b" class="ui-content ui-body-b">

<!-- grid -->
<div class="ui-grid-a ui-responsive">

    <!-- left columns -->
    <div class="ui-block-a" style="width:50%" id="leftcol"><div class="ui-bar ui-bar-e" style="height:100%; width:90%">
<?php
      $uId = "10";

      //$_SESSION['user_id'] = $uId;
      $SQL = "SELECT * FROM userID WHERE userID=".$uId;
      $exeSQL = mysqli_query($conn, $SQL) or die (mysqli_error($conn));

      $SQL = "SELECT userName FROM Users WHERE uId=".$uId;
      $exeChefSQL = mysqli_query($conn, $SQL) or die (mysqli_error($conn));
      $arrayc = mysqli_fetch_array($exeChefSQL);
      ?>

      <h1 class="centerElement">My Dishes</h1>
      <a href="offerFood.php" class="ui-btn ui-shadow ui-corner-all ui-btn-a" data-theme="a">Create New Dish</a>

      <br>
      <form class="ui-filterable ui-group-theme-d" data-theme="d">
      	<label for="searchdish">Search your food:</label>
        	<input id="searchdish" placeholder="Enter keyword" data-type="search">
      </form>
      <br>

      <p><ul data-role="listview" data-input="#searchdish" class="searchable">

      <?php
      while ($arrayp = mysqli_fetch_array($exeSQL)) {
    		echo "<li class='" . $arrayp['prodCuisine'] . " " . $arrayp['prodAllergy'] . " ";
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

    </div></div><!-- /left column -->

    <!-- right column -->
    <div class="ui-block-b ui-block-span2" style="width:50%; background-color:white;" id="rightcol" data-theme="a"><div class="ui-bar ui-bar-e">
<?php
$prodId = "1";

//$prodId = $_GET['uProdId'];

$SQL="select * from userID where uID=".$prodId;
$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));
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

?>
  <div class="ui-grid-a">
    <div class="ui-block-a">
    <img width="100%" src="images/<?php echo $arrayp['prodPic']?>">
  </div>
    <div class="ui-block-b centerElement">

    <h2 class="redText"><?php echo $arrayp['prodName']?></h2><br>
    <h3 class="greenText">£<input type="number" value="<?php echo $arrayp['prodPrice']?>"></h3><br>
    <h3 class="greenText">1.5 miles away</h3>
    </div>
</div><!-- /grid-b -->

  <div class="ui-grid-a">
      <div class="ui-block-a"><p>Cuisine: <select>
    <option value="<?php echo $arrayp['prodCuisine'] ?>"></option>
  <option value="British"></option>
<option value="Chinese"></option>
<option value="Indian"></option>
</select></p><p>Allergies: <?php echo $arrayp['prodAllergy'] ?></p></div>
      <div class="ui-block-c"><p>Calories: <input type="text" value="<?php echo $arrayp['prodCals'] ?>"></p><p>Serving:<input type="number" value="<?php echo $arrayp['prodServ'] ?>"</p></div>
</div>
<!-- echo "Prod pic is: ".$chefPic -->
<h2 class="redText">Description</h2>
<p><textarea> <?php echo $arrayp['prodDLong']?></textarea></p>

<div class="ui-body ui-body-a ui-corner-all">
<a href="chef.php"><div><img class="profile_avatar" src="images/<?php echo $chefPic ?>"></div>
  <span class="cook_name_bar"><?php echo $chefName. " " .$output ?><p>View previous reviews and add yours</p></span>
<span class="ui-icon-carat-r ui-btn-icon-notext"></span></a>
</div>
<a class="ui-btn ui-btn-c" href="">Save</a>
</div></div><!-- /right column -->

</div><!-- /grid -->

</div>

<?php
include('footer.php');
?>
