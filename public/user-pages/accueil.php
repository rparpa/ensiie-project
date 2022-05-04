<html lang="fr">
<head>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../static/css/main.css">

    <script src="https://d3js.org/d3.v4.js"></script>
    <script src="https://d3js.org/d3.v4.js"></script>
    <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
    <script src="../static/js/check-auth.js"></script>
    <script src="../static/js/templates.js"></script>
    <script src="../static/js/structure.js"></script>
    <script src="../static/js/display-nav.js"></script>
    <script src="../static/js/apply-category-color.js"></script>
    <script src="../static/js/bar-chart.js"></script>


</head>
<body>
<?php
require_once '../../vendor/autoload.php';
use Db\Connection;
use Db\CategoryManager;

?>
<section id="structure">

</section>
<main class="search">
    <section class="my-card my-card-100">
        <section class="my-card-header">
            <svg xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 512 512">
                <path fill="var(--font-color)"
                      d="M32 160h319.9l.0791 72c0 9.547 5.652 18.19 14.41 22c8.754 3.812 18.93 2.078 25.93-4.406l112-104c10.24-9.5 10.24-25.69 0-35.19l-112-104c-6.992-6.484-17.17-8.217-25.93-4.408c-8.758 3.816-14.41 12.46-14.41 22L351.9 96H32C14.31 96 0 110.3 0 127.1S14.31 160 32 160zM480 352H160.1L160 279.1c0-9.547-5.652-18.19-14.41-22C136.9 254.2 126.7 255.9 119.7 262.4l-112 104c-10.24 9.5-10.24 25.69 0 35.19l112 104c6.992 6.484 17.17 8.219 25.93 4.406C154.4 506.2 160 497.5 160 488L160.1 416H480c17.69 0 32-14.31 32-32S497.7 352 480 352z"/>
            </svg>
            <span>Derniers trocs</span>
        </section>
        <section class="my-card-body">
            <section class="slider">
                <section class="slide-track" id="slide">
                </section>
            </section>
        </section>
    </section>
    <div class="stats">
        <section class="my-card">
            <section class="my-card-header">
                <svg xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 448 512">
                    <path fill="var(--font-color)"
                          d="M323.5 51.25C302.8 70.5 284 90.75 267.4 111.1C240.1 73.62 206.2 35.5 168 0C69.75 91.12 0 210 0 281.6C0 408.9 100.2 512 224 512s224-103.1 224-230.4C448 228.4 396 118.5 323.5 51.25zM304.1 391.9C282.4 407 255.8 416 226.9 416c-72.13 0-130.9-47.73-130.9-125.2c0-38.63 24.24-72.64 72.74-130.8c7 8 98.88 125.4 98.88 125.4l58.63-66.88c4.125 6.75 7.867 13.52 11.24 19.9C364.9 290.6 353.4 357.4 304.1 391.9z"/>
                </svg>
                <span>Catégories tendances</span>
            </section>
            <section class="my-card-body" id='cat-container'>
                <table class="rank">
                    <tbody>

                    <?php

                    $categoryManager = new CategoryManager(Connection::get());
                    $categories = $categoryManager->findAllOrderByNumberSwapTop5();

                    foreach ($categories as $key => $category) {
                        echo "<tr class='line'>";
                        if ($key == 0) {
                            echo "<td>";
                            echo "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 576 512'>
                                <path fill='var(--font-color)'
                                      d='M576 136c0 22.09-17.91 40-40 40c-.248 0-.4551-.1266-.7031-.1305l-50.52 277.9C482 468.9 468.8 480 453.3 480H122.7c-15.46 0-28.72-11.06-31.48-26.27L40.71 175.9C40.46 175.9 40.25 176 39.1 176c-22.09 0-40-17.91-40-40S17.91 96 39.1 96s40 17.91 40 40c0 8.998-3.521 16.89-8.537 23.57l89.63 71.7c15.91 12.73 39.5 7.544 48.61-10.68l57.6-115.2C255.1 98.34 247.1 86.34 247.1 72C247.1 49.91 265.9 32 288 32s39.1 17.91 39.1 40c0 14.34-7.963 26.34-19.3 33.4l57.6 115.2c9.111 18.22 32.71 23.4 48.61 10.68l89.63-71.7C499.5 152.9 496 144.1 496 136C496 113.9 513.9 96 536 96S576 113.9 576 136z'/>
                            </svg>";
                            echo "</td>";
                        } else {
                            echo "<td class='number'>" . ($key + 1) . "</td>";
                        }
                        echo "<td> <span class='category'>" . htmlspecialchars($category->getName(), ENT_QUOTES, 'UTF-8') . "</span> </td>";
                        echo "<td class='count'>" . htmlspecialchars($category->getNumberSwap(), ENT_QUOTES, 'UTF-8') . " trocs </td>";
                        echo "</tr>";
                    }
                    ?>

                    </tbody>
                </table>
            </section>
        </section>
        <section class="my-card">
            <section class="my-card-header">
                <svg xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 512 512">
                    <path fill="var(--font-color)"
                          d="M32 32C49.67 32 64 46.33 64 64V400C64 408.8 71.16 416 80 416H480C497.7 416 512 430.3 512 448C512 465.7 497.7 480 480 480H80C35.82 480 0 444.2 0 400V64C0 46.33 14.33 32 32 32zM160 224C177.7 224 192 238.3 192 256V320C192 337.7 177.7 352 160 352C142.3 352 128 337.7 128 320V256C128 238.3 142.3 224 160 224zM288 320C288 337.7 273.7 352 256 352C238.3 352 224 337.7 224 320V160C224 142.3 238.3 128 256 128C273.7 128 288 142.3 288 160V320zM352 192C369.7 192 384 206.3 384 224V320C384 337.7 369.7 352 352 352C334.3 352 320 337.7 320 320V224C320 206.3 334.3 192 352 192zM480 320C480 337.7 465.7 352 448 352C430.3 352 416 337.7 416 320V96C416 78.33 430.3 64 448 64C465.7 64 480 78.33 480 96V320z"/>
                </svg>
                <span>Trocs sur les 7 derniers jours</span>
            </section>
            <section class="my-card-body" id="container-bar-chart">
                <div id="graph"></div>
            </section>
        </section>
    </div>
</main>
</body>
</html>
