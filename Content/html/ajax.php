<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title></title>
</head>
<body>
    <?php
    $dirs = array_filter(glob('../img/test2/*'), 'is_dir');

    if (isset($_POST['action'])) {
        insert();
    }

    function select() {
        echo "The select function is called.";
        exit;
    }

    function insert() {
        echo "The insert function is called.";
        exit;
    }
    ?>
</body>
</html>