<?php
?>
<div data-role="page">
<div data-role="header">
<h1><a href="https://georgeharrison-webb.co.uk/mue/index.php"><img width="80%" src="images/foodchimp.png"></a></h1>
<!-- HAMBURGER MENU -->
<a href="#popupMenu" data-rel="popup" data-transition="slideup" class="ui-btn-right" data-icon="bars" data-theme="c">Menu</a>
<div data-role="popup" id="popupMenu" data-theme="b" data-history="false">
        <ul data-role="listview" data-inset="true" style="min-width:210px;">
            <li data-role="list-divider">Choose an action</li>
            <li><a href="index.php">Home</a></li>
            <?php
            if ($_SESSION['logged_in'] == "1"){
              echo "<li><a href='logout.php'>Log out</a></li>";
              echo "<li><a href='dashboard.php'>Dashboard</a></li>";
            }else{
              echo"
              <li><a href='login.php'>Sign in</a></li>
              <li><a href='signup.php'>Sign up</a></li>";
            }
            ?>
        </ul>
</div>
<!--<a href="index.html" data-icon="bars" class="ui-btn-right" data-theme="c">Menu</a>-->
	<a class="ui-btn ui-icon-carat-l ui-btn-icon-notext ui-corner-all ui-btn-d ui-btn-left" data-rel='back' id="btnback">No text</a>
<!--<button class='ui-btn ui-btn-c ui-btn-left ui-corner-all' data-rel='back' id="btnback">Back</button>-->

<script>
  $('button#btnback').on('click', function(e){
    e.preventDefault();
    window.history.back();
  });
</script>

</div>
