<?php
session_start();
$pageName="Home";
include('head.php');
?>
<div data-role="page">

<!--Different HEADER only for HOME PAGE -->
<div data-role="header" class="ui-header ui-bar-inherit header_class">

<a href="#popupMenu" data-rel="popup" data-transition="slideup" class="ui-btn-right" data-icon="bars" data-theme="c">Menu</a>
<div data-role="popup" id="popupMenu" data-theme="b" data-history="false">
        <ul data-role="listview" data-inset="true" style="min-width:210px;">
            <li data-role="list-divider">Choose an action</li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="login.php">Sign in</a></li>
            <li><a href="signup.php">Sign up</a></li>
        </ul>
</div>

</div>

<!-- MAIN CONTENT -->
<div role="main" data-theme="b" class="ui-content ui-body-b" >

<!-- logo -->
<img width="100%" src="images/homepage/foodchimp_logo_better.png">

<!-- video, order, offer -->
<div class="redText centerElement">
	<h2><a href="video.php" class="ui-btn ui-icon-video ui-btn-icon-notext ui-corner-all ui-btn-c ui-btn-inline">No text</a>
	Watch our story</h2>
</div>
<a href="list.php" class="ui-btn ui-shadow ui-corner-all ui-btn-c" data-theme="c">Order Food</a>
<a href="<?php if($_SESSION['logged_in']!=1){echo "login.php";} else {echo "dashboard.php";}?>" class="ui-btn ui-shadow ui-corner-all ui-btn-d" data-theme="d">Offer Food</a>
<br>

<!-- brand info + gallery -->
<div class="centerImage">
	<h3 style="color:#253f58; text-align: center;">We connect people in search of delicious home-cooked food with the people living nearby who offer this service.</h3>
<div>
	<img width="100%" src="images/homepage/gallery.png">
</div>
</div>

</div>

<?php
include('footer.php');
?>
