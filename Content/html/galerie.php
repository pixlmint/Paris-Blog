<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-125439772-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'UA-125439772-1');
    </script>
    <title>For Testing purposes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <script src="../Scripts/jquery-3.0.0.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet" />
    <link href="../css/navbar.css" rel="stylesheet" />
    <link href="../css/sticky-footer.css" rel="stylesheet" />
    <link href="../css/blog.css" rel="stylesheet" />
    <link href="../css/galerie.css" rel="stylesheet" />
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
        .hacked-row {
            display: block !important;
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
        $dirs = array_filter(glob('../img/test2/*'), 'is_dir');
        echo "<div class='row'>\n<div class='col-sm-8'>";
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
            echo "><div class='row'>\n";
            $newArr = [glob($dir . "/*")];
            foreach($newArr as $secondNewArr){
                foreach($secondNewArr as $newFileName){
                    echo "<div class='col-sm-4'>\n<img src='". $newFileName . "'></div>";
                    $counter++;
                    if($counter === 3){
                        echo "</div><div class='row'>";
                        $rowCounter++;
                        $counter = 0;
                    }
                }
            }
            echo "</div>\n</div>";

        }
        echo "</div></div>";

        echo "<div class='col-sm-3 blog-sidebar'>";
        foreach($dirs as $dir){
            $dirName = basename($dir);
            echo "<ol class='list-unstyled'>\n<li class='gallery-element " .$dirName . "'>" . $dirName . "</li></ol>";
        }
        echo "</div>";
        echo "<div class='hidden'>";
        foreach($dirs as $dir){
            echo basename($dir) . ",";
        }
        echo "</div>";

        echo "</div>";
        ?>
    </main>
</body>
</html>