<?php
error_reporting(E_ALL); ini_set('display_errors', 'On');
$pageName="User Checkout";

session_start();
include('db.php');

include('head.php');
include('header.php');

$usersId = "1";
$SQL = "SELECT * FROM Users WHERE uId = " . $usersId;
$exeSQL = mysqli_query($conn, $SQL) or die (mysqli_error($conn));
$arrayu = mysqli_fetch_array($exeSQL);
$currentScore = $arrayu['usersPoints'];
$discount = $arrayu['discount'];
$price = 8.99;
$newprice = 0;

// echo "<p>Discount: " . $discount . "</p>";
// echo "<p>Current Score: " . $currentScore . "</p>";

if ($currentScore >= 10) {
    $updatePoints = "UPDATE Users SET usersPoints = '1', discount = 1 WHERE uId = " . $usersId;
} else {
    $updatePoints = "UPDATE Users SET usersPoints = usersPoints + 1 WHERE uId = " . $usersId;
}
$exeUpdatePointsSQL = mysqli_query($conn, $updatePoints) or die (mysqli_error($conn));
?>

<div class="ui-content ui-body-b" data-theme="b" id="breadcrumb">
    <h3>Place Order &rsaquo; Pay &rsaquo; <span class="greenText">Confirm</span></h3>
</div>

<!-- content -->
<div role="main" class="ui-body-b" data-theme="b">
    <div class="ui-content ui-body-b" id="container-info">
        <h2 class="centerElement">Your Order</h2>
        <table id="checkout">
            <tr>
                <td><p>Creamy Clam, Crab and Vegetables Soup</p></td>
                <td>1</td>
                <td>
                    <p>&pound;<?php 
                            if ($currentScore == 1 && $discount == 1) {
                                echo $newprice = round($price * 0.8, 2);
                            } else {
                                echo $price;
                            }?>
                    </p>
                </td>
            </tr>
            <tr>
                <td><?php 
                    if ($currentScore == 1 && $discount == 1) {
                        echo "<span class='redText'>20% discount applied!</span>";
                    } else {
                        echo "";
                    }
                    ?>
                </td>
                <td id="sum">Total</td>
                <td id="sum">&pound;<?php 
                            if ($currentScore == 1 && $discount == 1) {
                                echo $newprice = round($price * 0.8, 2);
                            } else {
                                echo $price;
                            }?>
                </td>
            </tr>
        </table>
    </div>

    <div class="ui-content ui-body-b" data-theme="b"></div>

    <div class="ui-content ui-body-b centerElement" id="container-info">
        <h2>Deliveried to:</h2>
        <p>Mr John Smith<br>
        101<br>
        New Cavendish Street<br>
        Fitzrovia<br>
        London<br>
        W1W 6XH
        </p>

        <h2>Estimated Wait:</h2>
        <p>30 - 35 minutes</p>

        <h2 class="greenText">Congratulations!</h2>

        <?php
        if ($currentScore >= 10) {
            echo "<p id='loyalty'>You have unlocked 20% discount!</p>";
            echo "<p><strong>User Score: " . $currentScore . "/10</strong></p>";
            echo "<p>20% discount on your next order!</p>";
        } else if ($currentScore == 1 && $discount == 1) {
            echo "<p id='loyalty'>20% discount has been applied to your current order, 1 point has also been added to your User Score.</p>";   
            echo "<p><strong>User Score: " . $currentScore . "/10</strong></p>";
            $remain = 10 - $currentScore;
            echo "<p>" . $remain . " more point(s) and you'll get 20% discount on your next order!</p>";
            $updatePoints = "UPDATE Users SET discount = 0 WHERE uId = " . $usersId;
            $exeUpdatePointsSQL = mysqli_query($conn, $updatePoints) or die (mysqli_error($conn));
        } else {
            echo "<p id='loyalty'>1 point has been added to your User Score.</p>";
            echo "<p><strong>User Score: " . $currentScore . "/10</strong></p>";
            $updateUsersPoints = "UPDATE Users SET usersPoints = usersPoints + 1 WHERE uId = " . $usersId;
            $remain = 10 - $currentScore;
            echo "<p>" . $remain . " more point(s) and you'll get 20% discount on your next order!</p>";
        }
        ?>
    </div>

</div><!-- /content -->

<?php
include('footer.php');
?>
