<?php

ini_set('display_errors', 1);
define('MAX_FILE_SIZE', 1 * 1024 * 1024 ); //1MB
define('THUMBNAIL_WIDTH', 400);
define('IMAGES_DIR', __DIR__ . '/images');
define('THUMBNAIL_DIR', __DIR__ . '/thumbs');

if (!function_exists('imagecreatetruecolor')) {
    echo 'GD not installed';
    exit;
}

function h($s) {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

require 'ImageUploader.php';

$uploader = new \MyApp\ImageUploader();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploader->upload();
}

    $images = $uploader->getImages();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Image Uploader</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
        }
        ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo h(MAX_FILE_SIZE); ?>">
        <input type="file" name="image">
        <input type="submit" value="upload">
    </form>
    <ul>
        <?php foreach ($images as $image): ?>
        <li>
            <a href="<?php echo h(basename(IMAGES_DIR) . '/' . basename($images));?>">
                <img src="<?php echo h($image); ?>">
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>