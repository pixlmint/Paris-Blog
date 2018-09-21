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
                for (i = 0; i < array.length; i++) {
                    if ($(this).hasClass(array[i])) {
                        $(".gallery-page." + array[i]).css("display", "block");
                    } else {
                        $(".gallery-page." + array[i]).css("display", "none");
                    }
                }
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
    <header class="blog-header py-3">
        <div class="container">
            <div class="row align-items-center hacked-row">
                <div class="centered text-center">
                    <a class="blog-header-logo text-dark" href="../../index.html">Mon séjours à Paris</a>
                </div>
            </div>

            <div class="nav-scroller py-1 mb-2">
                <nav class="nav d-flex <!--justify-content-between-->">
                    <a class="p-2 text-muted" href="about-me.html">De Moi</a>
                    <a class="p-2 text-muted" href="galerie.html">Galerie</a>
                </nav>
            </div>
        </div>

    </header>
    <main>
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
            $newArr = [glob($dir . "/*")];
            foreach($newArr as $secondNewArr){
                foreach($secondNewArr as $newFileName){
                    echo "<td><img src='". $newFileName . "'></td>";
                    $counter++;
                    if($counter === 3){
                        echo "</tr><tr>";
                        $rowCounter++;
                        $counter = 0;
                    }
                }
            }
            echo "</tr></tbody></table></div>";
        }

        echo "</div>";
        ?>
    </main>
</body>
</html>