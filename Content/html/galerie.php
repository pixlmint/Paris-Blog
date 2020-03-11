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
    <title>Galerie</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <script src="../Scripts/jquery-3.0.0.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet" />
    <link href="../css/navbar.css" rel="stylesheet" />
    <link href="../css/sticky-footer.css" rel="stylesheet" />
    <link href="../css/blog.css" rel="stylesheet" />
    <link href="../css/galerie.css" rel="stylesheet" />
    <link href="../css/mycss.css" rel="stylesheet" />
    <script>
	function toggleGalleryPage(page) {
	    $('.gallery_page').css('display', 'none');
	    $('#' + page).css('display', 'block');
	}
    </script>
    <script>
        var width = innerWidth;
        if (width < 600) {
            $(".side-navigation-btn").css("display", "block");
            $(".side-navigation").html($(".sidebar-module").html());
            $(".sidebar-module").html("");
        }

        $(document).ready(function () {
            var counter = 0;

            $(".side-navigation-btn").click(function () {
                counter++;
                if (counter % 2 === 1) {
                    $(".side-navigation").css("display", "block");
                    $(".side-navigation-btn").addClass("unmovable");
                    $(".side-navigation-btn").css("content", "url('Content/img/up.png')");
                } else {
                    $(".side-navigation").css("display", "none");
                    $(".side-navigation-btn").removeClass("unmovable");
                    $(".side-navigation-btn").css("content", "url('Content/img/down.png')");
                }
            });

            var lastScrollTop = 0;
            $(window).scroll(function (event) {
                var st = $(this).scrollTop();
                if (st > lastScrollTop) {
                    $(".side-navigation-btn").css("position", "absolute");
                } else {
                    $(".side-navigation-btn").css("position", "fixed");
                }
                lastScrollTop = st;
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
    <div class="side-navigation-btn"></div>
    <div class="side-navigation"></div>
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
        $dirs = array_filter(glob('../img/*'), 'is_dir');
        echo "<div class='row'>\n<div class='col-sm-8'>";
        echo "<div class='gallery'>";
        $counter = 0;
        $rowCounter = 0;
        $firstCounter = 0;
        foreach($dirs as $dir){
        	$dirName = basename($dir);
                echo "<div class='gallery_page' id='" . str_replace('.', '_', $dirName) . "' ";
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

        echo "<div class='col-sm-3 blog-sidebar sidebar-module'>";
        foreach($dirs as $dir){
            $dirName = basename($dir);
            echo "<ol class='list-unstyled'>\n<li onclick='toggleGalleryPage($(this).attr(\"id\"))' class='gallery-element' id='" . str_replace('.', '_', $dirName) . "'>" . $dirName . "</li></ol>";
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
