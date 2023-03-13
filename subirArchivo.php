<?php
$target_dir = "uploads/";
if (isset($_POST['submit'])) {
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES["file"]["name"]) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
<ul>
<?php
$files = scandir($target_dir);
for ($i = 2; $i < count($files); $i++) {
    echo '<li><a href="' . $target_dir . $files[$i] . '">' . $files[$i] . '</a></li>';
}
?>
</ul>