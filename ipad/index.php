<?php
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
<div role="main" data-theme="b" class="ui-content ui-body-b">

	<div class="ui-grid-a">
	    <div class="ui-block-a">
		<!-- logo -->
		<img width="100%" src="images/homepage/foodchimp_logo_better.png">
		</div>
	    <div class="ui-block-b centerElement">
		<iframe width="100%" height="300" src="video/advert.mp4" frameborder="0" allowfullscreen></iframe>
		</div>
		<div class="ui-block-a"><a href="list.php" class="ui-btn ui-shadow ui-corner-all ui-btn-c">Order Food</a></div>
	    <div class="ui-block-b"><a href="login.php" class="ui-btn ui-shadow ui-corner-all ui-btn-d">Offer Food</a></div>
	</div>

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
