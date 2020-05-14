<?php
$pageName="Home";
include('head.php');
include('header.php');
include('db.php');

//$prodId = "1";

$prodId = $_GET['uProdId'];
$SQL="select * from userID where uID=".$prodId;
$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error());
$arrayp=mysqli_fetch_array($exeSQL);


echo "<div role='main' data-theme='a' class='ui-content ui-body-a'>";
?>

<div class="ui-grid-a">
    <div class="ui-block-a"><h2 class='redText'> <?php echo $arrayp['prodName'] ?></h2></div>
    <div class="ui-block-c"><h2 class='greenText'>1.5 Miles</h2></div>
</div>

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
</div><!-- /content -->

<div data-role="footer" data-id="foo1" data-position="fixed">
	<div data-role="navbar">
		<ul>
			<li><a data-theme="c" data-icon="info" href="food.php?uProdId=<?php echo $prodId ?>">Info</a></li>
			<li><a data-theme="c" data-icon="comment" href="reviews.php?uProdId=<?php echo $prodId ?>">Comments</a></li>
			<li><a class="ui-btn-active" data-theme="c" data-icon="location" href="map.php?uProdId=<?php echo $prodId ?>">Map</a></li>
		</ul>
	</div><!-- /navbar -->
</div>

<?php
include('footer.php');
?>
