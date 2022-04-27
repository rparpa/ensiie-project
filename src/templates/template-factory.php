<?php

use models\Category;
use models\Item;

function templateSwap($s)
{
    echo "<div class='swap'>";
    echo "<span class='date'>" . $s . "</span>";
    echo "<div class='information'>";

    echo "<div class='objects'/>";
    echo "<div class='images'>";
    echo "<img src='../static/assets/op.png'/>";
    echo "</div>";
    echo "<span class='pseudo'>YANIS</span>";
    echo "</div>";

    echo "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path fill='var(--font-color)'
          d='M32 160h319.9l.0791 72c0 9.547 5.652 18.19 14.41 22c8.754 3.812 18.93 2.078 25.93-4.406l112-104c10.24-9.5 10.24-25.69 0-35.19l-112-104c-6.992-6.484-17.17-8.217-25.93-4.408c-8.758 3.816-14.41 12.46-14.41 22L351.9 96H32C14.31 96 0 110.3 0 127.1S14.31 160 32 160zM480 352H160.1L160 279.1c0-9.547-5.652-18.19-14.41-22C136.9 254.2 126.7 255.9 119.7 262.4l-112 104c-10.24 9.5-10.24 25.69 0 35.19l112 104c6.992 6.484 17.17 8.219 25.93 4.406C154.4 506.2 160 497.5 160 488L160.1 416H480c17.69 0 32-14.31 32-32S497.7 352 480 352z'/>
</svg>";
    echo "<div class='objects me'/>";
    echo "<div class='images'>";
    echo "<img src='../static/assets/stylo.jpg'/>";
    echo "</div>";
    echo "<span class='pseudo'>JONATHAN</span>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}

function templateItem(Item $item)
{
    echo "<div class='grid'>";
    echo "<section class='my-card'>";
    echo "<section class='my-card-header'>";
    echo "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512'><path fill='var(--font-color)' d='M50.73 58.53C58.86 42.27 75.48 32 93.67 32H208V160H0L50.73 58.53zM240 160V32H354.3C372.5 32 389.1 42.27 397.3 58.53L448 160H240zM448 416C448 451.3 419.3 480 384 480H64C28.65 480 0 451.3 0 416V192H448V416z'/></svg>";
    echo "<span>L'objet</span>";
    echo "</section>";
    echo "<section class='my-card-body'>";
    echo "<div class='item'>";
    echo "<div class='image'>";
    echo "<img class='logo' src='/images/items/" . htmlspecialchars($item->getPicture(), ENT_QUOTES, 'UTF-8') . "'/>";
    echo "<div class='categories' id='cat-container'>";
    foreach ($item->getCategories() as $category) {
        if ($category instanceof Category) {
            echo "<span class='category'>" . htmlspecialchars($category->getName(), ENT_QUOTES, 'UTF-8') . "</span>";
        }
    }
    echo "</div>";
    echo "</div>";
    echo "<div class='information'>";
    echo "<h3>" . htmlspecialchars($item->getName(), ENT_QUOTES, 'UTF-8') . " </h3>";

    echo "<span class='date'>Date d'ajout: " . htmlspecialchars($item->getCreationDate(), ENT_QUOTES, 'UTF-8') . " </span > ";
    echo "<p>" . htmlspecialchars($item->getDescription(), ENT_QUOTES, 'UTF-8') . "</p > ";

    echo "</div>";
    echo "</div>";
    echo "</section>";
    echo "</section>";

    echo "<section class='my-card'>";
    echo "<section class='my-card-header'>";
    echo "<svg xmlns='http://www.w3.org/2000/svg'
     viewBox='0 0 448 512'>
    <path fill='var(--font-color)' d='M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z'/>
    </svg>";
    echo "<span>Le propriétaire originel</span>";
    echo "</section>";
    echo "<section class='my-card-body'>";
    echo "<div class='user-profile'>";

    echo "<div class='adress'> ";
    echo "<span > <span class='label' > Nom et prénom : </span > JUSSEAUME Jonathan </span > ";
    echo "<span > <span class='label' > Adresse : </span > 10 rue du con de la ciudad, PARIS(75007) </span > ";
    echo "<div class='wishes'>";
    echo "<span> Souhaits : </span>";
    echo "<ul>";
    echo "<li> Stylo </li>";
    echo "<li class='category'>DVD</li>";
    echo "<li class='category'>LITTERATURE</li>";
    echo "</ul>";
    echo "</div>";
    echo "</div>";
    echo "<div class='user' > ";
    echo "<img src = '../static/assets/zoro.jpg' />";
    echo "<span>" . htmlspecialchars($item->getProprietary(), ENT_QUOTES, 'UTF-8') . "</span>";
    echo "</div> ";
    echo "</div> ";
    echo "</section>";
    echo "</section>";
    echo "</div> ";
}