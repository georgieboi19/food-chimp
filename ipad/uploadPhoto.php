<?php
session_start();
$pageName="Home";
include('head.php');
include('header.php');
include('db.php');

$insetID = "23";

if (isset($_POST['submit'])) {
            echo "<p>" . $_POST['csv_file'] . " => file input successful</p>";
            $target_dir = "images/";
            $file_name = $_FILES['csv_file']['name'];
            $file_tmp = $_FILES['csv_file']['tmp_name'];

            if (move_uploaded_file($file_tmp, $target_dir . $file_name)) {
                echo "<h1>File Upload Success</h1>";
            } else {
                echo "<h1>File Upload not successful</h1>";
            }
        }

echo "<div role='main' class='ui-content ui-body-b' data-theme='b'>";
echo $_SESSION['user_id'];
?>
<h2 class="redText centerElement">Image Upload</h2>
  <h3> For security, the file types permitted are jpg, png, jpeg or gif only</h3>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" class="ui-group-theme-a" data-theme="a">
    <div class="imageuploader">
      <img src="images/upload-icon.jpg" alt="upload image">
     <input type="file" name="csv_file">
   </div>
    <input type="submit" value="Upload" name="submit">
</form>


</div><!-- /content -->

<?php
include('footer.php');
?>
