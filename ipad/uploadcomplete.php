<?php
session_start();
$pageName="Upload Complete";
include('head.php');
include('header.php');

echo "<div role='main' data-theme='b' class='ui-content ui-body-b'>";
?>
<div class="centerElement" style="margin:25%;">
<h1 class="greenText">Upload Complete</h1>

<p>Congratualtions!</p>
<p>Your dish has been added to our list.</p>

<a href="mydishes.php" class="ui-btn ui-btn-inline ui-btn-c">Back to My Dishes</a><br>
<a href="index.php" class="ui-btn ui-btn-inline ui-btn-c">Homepage</a>
</div>
</div>

<?php
include('footer.php');
?>
