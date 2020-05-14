<?php
session_start();
$pageName="Preview Product";
include('head.php');
include('header.php');
include('db.php');

$prodId = "1";

//$prodId = $_GET['uProdId'];

$usersId = '1';

      if (  $stmt = $conn->prepare("SELECT LAST_INSERT_ID()
              FROM userID")){
              $stmt->execute();
              $stmt->store_result();
              $stmt->bind_result($insetedID);
              $stmt->fetch();
      }

      if (  $stmt = $conn->prepare("SELECT userName, userPic
              FROM Users WHERE uId=".$prodId)){
              $stmt->execute();
              $stmt->store_result();
              $stmt->bind_result($chefName, $chefPic);
              $stmt->fetch();
            }

            $SQL="select * from userID where uID=".$prodId;
            $exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error());
            $arrayp=mysqli_fetch_array($exeSQL);


echo "<div role='main' data-theme='b' class='ui-content ui-body-b'>";
?>

		<img class="centerImage" width="30%" src="images/<?php echo $arrayp['prodPic']?>">
		<div class="centerElement"><h2><?php echo $arrayp['prodName']?></h2>
		<h3>£<?php echo $arrayp['prodPrice']?></h3></div>


  <div class="ui-grid-a centerElement">
      <div class="ui-block-a"><p>Cuisine: <?php echo $arrayp['prodCuisine'] ?></p><p>Allergies: <?php echo $arrayp['prodAllergy'] ?></p></div>
      <div class="ui-block-c"><p>Calories: <?php echo $arrayp['prodCals'] ?></p><p>Serving: <?php echo $arrayp['prodServ'] ?></p></div>
</div>
<!-- echo "Prod pic is: ".$chefPic -->
<h2 class="redText">Description</h2>
<p><?php echo $arrayp['prodDLong']?></p>

<label for="flip-checkbox-1">Mon:</label>
    <input type="checkbox" data-role="flipswitch" name="flip-checkbox-1" id="flip-checkbox-1">
<label for="flip-checkbox-2">Tue:</label>
    <input type="checkbox" data-role="flipswitch" name="flip-checkbox-2" id="flip-checkbox-1">
<label for="flip-checkbox-3">Wed:</label>
    <input type="checkbox" data-role="flipswitch" name="flip-checkbox-3" id="flip-checkbox-1">
<label for="flip-checkbox-4">Thu:</label>
    <input type="checkbox" data-role="flipswitch" name="flip-checkbox-4" id="flip-checkbox-1">
<label for="flip-checkbox-5">Fri:</label>
    <input type="checkbox" data-role="flipswitch" name="flip-checkbox-5" id="flip-checkbox-1">
<label for="flip-checkbox-6">Sat:</label>
    <input type="checkbox" data-role="flipswitch" name="flip-checkbox-6" id="flip-checkbox-1">
<label for="flip-checkbox-7">Sun:</label>
    <input type="checkbox" data-role="flipswitch" name="flip-checkbox-7" id="flip-checkbox-1">
<br>
<div class="ui-grid-a centerElement">
    <div class="ui-block-a"><a href="dashboard.php" class="ui-btn ui-btn-inline ui-btn-c">Cancel</a></div>
    <div class="ui-block-c"><a href="uploadcomplete.php" style="background-color:#AEC33A;" class="ui-btn ui-btn-inline ui-btn-c">Confirm</a></div>
</div>

</div>

<?php
include('footer.php');
?>
