<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>For Testing purposes</title>
    <link href="../css/navbar.css" rel="stylesheet" />
    <link href="../css/sticky-footer.css" rel="stylesheet" />
    <link href="../css/blog.css" rel="stylesheet" />
    <link href="../css/bootstrap.min.css" rel="stylesheet" />
    <script src="../Scripts/jquery-3.0.0.js"></script>
    <script>
        $(document).ready(function () {
            var elements = $(".hidden").text();
            var array = elements.split(',');
            $(".gallery-element").click(function () {

            });
        });
    </script>
    <style>
        table {
            border: solid 2px black;
        }

        .gallery-element:hover {
            cursor: pointer;
        }

        td {
            border: solid 2px black;
        }

        .gallery-page {
            position: absolute;
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <main>
        <!--<h4>Lesson 1</h4>
        §asdfasdfasdfasdf
        <h4>Lesson 2</h4>
        <h5>A</h5>-->
        <?php
//echo fread (fopen("test.txt", "r"), filesize("test.txt"));
        ?>

        <h5>B</h5>
        <?php
        $dir = "../img/test";
        // Open a known directory, and proceed to read its contents
        //if (is_dir($dir))
        //{
        //    if ($dh = opendir($dir))
        //    {
        //        while (($file = readdir($dh)) !== false)
        //        {
        //            echo "filename: $file \n";
        //        }
        //        closedir($dh);
        //    }
        //}
        ?>
        <h5>C</h5>
        <p>Creating an Array</p>
        <?php
        $img_arr = [];
        $dir = "../img/test";
        if(is_dir($dir)){
            if($dh = opendir($dir)){
                $counter = 0;
                while(($file = readdir($dh)) !== false){
                    $img_arr[$counter] = $file;
                    $counter++;
                }
            }
        }
        foreach($img_arr as $val){
            var_dump($val);
        }
        ?>
        <h5>D</h5>
        <p>Another try</p>
        <?php
        $dir = "./";
        $myArr = scandir($dir);
        echo "$myArr";
        ?>
        <h5>E</h5>
        <p>Come oon php!</p>
        <?php
        $myArr = [];
        $counter = 0;
        foreach (glob("../img/test/*.jpg") as $filename) {
            $myArr[$counter] = $filename;
            $counter++;
        }
        foreach($myArr as $newFile){
            echo $newFile . "/n";
        }
        ?>

        <h4>Lesson 3</h4>
        <h5>A</h5>
        <p>Displaying a image, found by php</p>
        <?php
        $myImgArr = [];
        $counter = 0;
        foreach(glob("../img/test/*.jpg") as $filename){
            $myImgArr[$counter] = $filename;
            $counter++;
        }
        foreach($myImgArr as $file){
            //echo "<img src='" . $file . "' width='40'>";
        }
        ?>
        <h5>B</h5>
        <p>Making a gallery</p>

        <?php

        echo "<table><tbody><tr>";
        $dirs = array_filter(glob('../img/test2/*'), 'is_dir');

        foreach($dirs as $dir){
            $dirName = basename($dir);
            echo "<td><div class='gallery-element " .$dirName . "'>" . $dirName . "</div></td>";
        }
        echo "</tr></tbody></table>";
        echo "<div class='hidden'>";
        foreach($dirs as $dir){
            echo basename($dir) . ",";
        }
        echo "</div>";

        echo "<div class='gallery'>";
        $counter = 0;
        $rowCounter = 0;
        $firstCounter = 0;
        foreach($dirs as $dir){
            $dirName = basename($dir);
            echo "<div class='gallery-page " . $dirName . "' ";
            if($firstCounter === 0){
                echo "style='display:block;'";
                $firstCounter = 1;
            }else{
                echo "style='display:none;'";
            }
            echo "><table><tbody><tr>";
            foreach(glob("../img/test2/" . $dir . "/*.jpg") as $newFileName){
                echo "<td><img src='" . $newFileName . "'></td>";
                $counter++;
                if($counter === 3){
                    echo "</tr><tr>";
                    $rowCounter++;
                    $counter = 0;
                }
            }
            echo "</tr></tbody></table></div>";
        }

        echo "</div>";
        ?>
        <iframe src="ajax.php"></iframe>
    </main>
    <footer>
        asdfasfasdfafs
    </footer>
</body>
</html>