<?php

if($_SERVER['REQUEST_METHOD'] === "POST") {

    $uploadDir = 'upload/pictures';
    $uploadFile = $uploadDir . basename($_FILES['avatar']['name']);
    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $extensions_ok = ['jpg', 'jpeg', 'png','webp' ];
    $maxFileSize = 1000000;

    if ((!in_array($extension, $extensions_ok))) {
        echo $errors[] = 'Select a picture with extension Jpg/Jpeg/Png';
    } elseif (file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize) {
        echo $errors[] = "Minimum file size= 1M!";
    }else {
        $uploadFile = uniqid('', true) . '.' . $extension;
        move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);
        echo 'Picture has been sent!';
        echo '<img src="' . $uploadFile . '">';
        echo $_POST['firstname']. PHP_EOL;
        echo $_POST['lastname']. PHP_EOL;
        echo $_POST['age']. 'years';
    }
}
?>
<form method="post" enctype="multipart/form-data">
    <input type="text" name="firstname" id="firstname" placeholder="Firstname"><br>
    <input type="text" name="lastname" id="lastname" placeholder="Lastname"><br>
    <label for="age">Age</label><br>
    <?php ?>
    <label for="imageUpload">Profile picture</label><br>
    <input type="file" name="avatar" id="imageUpload" /><br>
    <button name="send">Send</button>
</form>