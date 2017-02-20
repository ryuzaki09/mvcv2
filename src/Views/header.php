<!Doctype html>
<html>
<head>
    <title><?php echo (isset($title)) ? $title : "Home"; ?></title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <?php
    if (isset($js) && is_array($js)){
        foreach ($js as $jsFile) {
            echo "<script src='$jsFile'></script>";
        }
    }
    ?>
</head>
<body>
