<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="picture">Upload image</label>
        <input id="picture" type="file" name="pictures[]" multiple="multiple"/>
        <button>Send</button>
    </form>
    <?php
    $uploadDir = "uploads/";
    for ($i = 0; $i < count($_FILES["pictures"]["name"]); $i++) {
        $extension = pathinfo($_FILES["pictures"]["name"][$i], PATHINFO_EXTENSION);
        $uploadFile = $uploadDir . uniqid() . "." . $extension;
        if (
            $_FILES["pictures"]["error"][$i] == UPLOAD_ERR_OK &&
            $_FILES["pictures"]["size"][$i] < 1000000 &&
            (
                $_FILES["pictures"]["type"][$i] == "image/jpg" ||
                $_FILES["pictures"]["type"][$i] == "image/png" ||
                $_FILES["pictures"]["type"][$i] == "image/gif"
            )
        ) {
            move_uploaded_file($_FILES["pictures"]["tmp_name"][$i], $uploadFile);
        }
    }
    $listPictures = new FilesystemIterator(dirname(__FILE__)."/uploads");
    echo "<div class='container-pictures'>";
        foreach ($listPictures as $namePicture)
        {
        echo "<figure>";
            echo "<img src=/uploads/".$namePicture->getFilename().">";
            echo "<figcaption>".$namePicture->getFilename()."</figcaption>";
            echo "<input type='button' value='Delete'>";
        echo "</figure>";
        }
    echo "</div>";  
    echo "<br>";
    $filename = '/uploads/5fa9a8c997b40.png';
    if (file_exists($filename)) {
        echo "Le fichier $filename existe.";
    } else {
        echo "Le fichier $filename n'existe pas.";
    }
    unclick ($filename);
    ?>
</body>
</html>
