<?php
session_start();
error_reporting(E_ALL); ini_set('display_errors', 'On');
$pageName="Offer new food";
include('head.php');
include('header.php');
include('db.php');

if (isset($_REQUEST['submit'])){

  $allergies = '';
  if (isset($_POST['checkbox-mini-0'])){
    $allergies .='Nuts ';
  }
  if (isset($_POST['checkbox-mini-1'])){
    $allergies .='Soy ';
  }
  if (isset($_POST['checkbox-mini-2'])){
    $allergies .='Milk ';
  }
  if (isset($_POST['checkbox-mini-3'])){
    $allergies .='Fish ';
  }
  if (isset($_POST['checkbox-mini-4'])){
    $allergies .='Egg ';
  }
  if (isset($_POST['checkbox-mini-5'])){
    $allergies .='Shellfish ';
  }
  if (isset($_POST['checkbox-mini-6'])){
    $allergies .='Wheat ';
  }
  //flip checkbox values
  if (isset($_POST['flip-checkbox-1'])){
    $mon .= true;
  }
  if (isset($_POST['flip-checkbox-2'])){
    $tue .= true;
  }
  if (isset($_POST['flip-checkbox-3'])){
    $wed .= true;
  }
  if (isset($_POST['flip-checkbox-4'])){
    $thu .= true;
  }
  if (isset($_POST['flip-checkbox-5'])){
    $fri .= true;
  }
  if (isset($_POST['flip-checkbox-6'])){
    $sat .= true;
  }
  if (isset($_POST['flip-checkbox-7'])){
    $sun .= true;
  }
  $dishName = $_POST['dishname'];
  $price = $_POST['price'];
  $description = $_POST['Description'];
  $cuisine = $_POST['select-native-2'];
  $calories = $_POST['calories'];
  $servings = $_POST['servings'];
  $descriptionShort= substr($description,0,40);

  //$_SESSION['user_id'] = $uId;
  $uId = '1';

  $stmt = $conn->prepare("INSERT INTO userID (prodName, prodPrice, prodCuisine, prodDLong, userID, prodCals, prodServ, prodAllergy, prodDShort)
  VALUES(?,?,?,?,?,?,?,?,?)");
  $stmt->bind_param('sssssssss',$dishName, $price, $cuisine, $description, $uId, $calories, $servings, $allergies, $descriptionShort);
  $stmt->execute();

  if (  $stmt = $conn->prepare("SELECT LAST_INSERT_ID()
          FROM userID")){
          $stmt->execute();
          $stmt->store_result();
          $stmt->bind_result($insetedID);
          $stmt->fetch();
}
  //$insertId = $_SESSION['insertId'];

$URL="https://georgeharrison-webb.co.uk/mue/ipad/previewproduct.php";
echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}?>
<div role="main" class="ui-content ui-body-b centerElement" data-theme="b">

  <h2 class='redText'>Add a new dish</h2>

  <form action='' method=POST class="ui-group-theme-a" data-theme="a" enctype=multipart/form-data>

  <!-- grid -->
  <div class="ui-grid-a">

  <!-- left col -->
  <div class="ui-block-a">
    <table style='border: 5px'>

    <tr>
      <td style="color: black">Dish name:</td>
    </tr>
    <tr>
        <td><input type=text name=dishname></td>
    </tr>
    <tr>
      <td style="color: black">Price:</td>
    </tr>
    <tr>
      <td><input type=number name=price step=".01" min="0"></td>
    </tr>
    <tr>
      <td style="color: black">No of Available Dishes:</td>
    </tr>
    <tr>
      <td><input type=number name=servings></td>
    </tr>
    <tr>
      <td style="color: black">Description:</td>
    <tr>
    <tr>
        <td><textarea type=text name=Description></textarea></td>
    </tr>
    <tr>
      <td><span style="padding-top: 3px; padding-bottom: 9px;" class="ui-field-contain">
        <label for="select-native-2" style="color: black">Cuisine:</label>
        <select name="select-native-2" id="select-native-2" data-mini="true" data-theme="b">
          <option value="American">American</option>
          <option value="British">British</option>
          <option value="Chinese">Chinese</option>
          <option value="Indian">Indian</option>
          <option value="Italian">Italian</option>
          <option value="Japanese">Japanese</option>
          <option value="Mexican">Mexican</option>
          <option value="Spanish">Spanish</option>
          <option value="Thai">Thai</option>
          <option value="Other">Other</option>
        </select>
      </span></td>
    </tr>

  </table>
  </div> <!-- /left col -->

  <!-- right col -->
  <div class="ui-block-b">
  <h3 class="centerElement">Image Upload</h3>
  <p> For security, the file types permitted are jpg, png, jpeg or gif only</p>
    <!-- <div class="imageuploader"> -->
      <img src="images/upload-icon.jpg" alt="upload image" width="25%" style="border: 1px solid black; background-color:grey; padding: 10px 60px;">
      <input type="file" name="csv_file">
   <!-- </div> -->
  </div> <!-- /right col -->



  <div class="ui-block-a">

    <table>
      <tr>
        <td style="color: black">Approx. calories per portion:</td>
      </tr>
      <tr>
        <td><input type=number name=calories></td>
      </tr>
    </table>

    <table style='border: 5px'>
      <tr>
        <td style="color: black">Allergens:</td>
      </tr>
      <tr>
        <td><input type="checkbox" value='Nut ' name="checkbox-mini-0" id="checkbox-mini-0" data-mini="true" data-theme="b"><label for="checkbox-mini-0">Nut</label></td>
        <td><input type="checkbox" value='Soy ' name="checkbox-mini-1" id="checkbox-mini-1" data-mini="true" data-theme="b"><label for="checkbox-mini-1">Soy</label></td>
      </tr>
      <tr>
        <td><input type="checkbox" value='Milk ' name="checkbox-mini-2" id="checkbox-mini-2" data-mini="true" data-theme="b"><label for="checkbox-mini-2">Milk</label></td>
        <td><input type="checkbox" value='Fish ' name="checkbox-mini-3" id="checkbox-mini-3" data-mini="true" data-theme="b"><label for="checkbox-mini-3">Fish</label></td>
      </tr>
      <tr>
      <td><input type="checkbox" value='Egg ' name="checkbox-mini-4" id="checkbox-mini-4" data-mini="true" data-theme="b"><label for="checkbox-mini-4">Egg</label></td>
      <td><input type="checkbox" value='Shellfish ' name="checkbox-mini-5" id="checkbox-mini-5" data-mini="true" data-theme="b"><label for="checkbox-mini-5">Shelfish</label></td>
      </tr>
      <tr>
      <td><input type="checkbox" value='Wheat ' name="checkbox-mini-6" id="checkbox-mini-6" data-mini="true" data-theme="b"><label for="checkbox-mini-6">Wheat</label></td>
      <td></td>
      </tr>
  </table>

  </div>



  <div class="ui-block-b">

    <p>Availability:</p>
    <table style='border: 5px' cellpadding='10'>
      <tr>
        <td>Mon: <input type="checkbox" data-role="flipswitch" name="flip-checkbox-1" id="flip-checkbox-1" data-theme="b"></td>
        <td>Tue: <input type="checkbox" data-role="flipswitch" name="flip-checkbox-2" id="flip-checkbox-1" data-theme="b"></td>
        <td>Wed: <input type="checkbox" data-role="flipswitch" name="flip-checkbox-3" id="flip-checkbox-1" data-theme="b"></td>
      </tr>
      <tr>
        <td>Thu: <input type="checkbox" data-role="flipswitch" name="flip-checkbox-4" id="flip-checkbox-1" data-theme="b"></td>
        <td>Fri: <input type="checkbox" data-role="flipswitch" name="flip-checkbox-5" id="flip-checkbox-1" data-theme="b"></td>
        <td>Sat: <input type="checkbox" data-role="flipswitch" name="flip-checkbox-6" id="flip-checkbox-1" data-theme="b"></td>
      </tr>
      <tr>
        <td>Sun: <input type="checkbox" data-role="flipswitch" name="flip-checkbox-7" id="flip-checkbox-1" data-theme="b"></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td colspan="3" style="padding-top: 15px"><input type=submit value='Next' name=submit></td>
      </tr>
    </table>

  </div>

</div> <!-- grid -->

  </form>

</div><!-- /content -->

<?php
include('footer.php');
?>
