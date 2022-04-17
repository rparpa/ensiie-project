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
    echo "<div class='all-info'>";
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
    echo "<h3> " . htmlspecialchars($item->getName(), ENT_QUOTES, 'UTF-8') . " </h3>";

    echo "<span class='date'>Date d'ajout: " . htmlspecialchars($item->getCreationDate(), ENT_QUOTES, 'UTF-8') . "</span>";
    echo "<p>" . htmlspecialchars($item->getDescription(), ENT_QUOTES, 'UTF-8') . "</p>";

    echo "</div>";
    echo "</div>";
    echo "<div class='item'>";
    echo "<div class='user-profile'>";

    echo "<div class='adress'>";
    echo "<span> <span class='label'> Nom et prénom : </span> JUSSEAUME Jonathan </span>";
    echo "<span> <span class='label'>Adresse : </span> 10 rue du con de la ciudad, PARIS (75007)</span>";
    echo "</div>";
    echo "<div class='user'>";
    echo "<img src='../static/assets/zoro.jpg'/>";
    echo "<span>" . htmlspecialchars($item->getProprietary(), ENT_QUOTES, 'UTF-8') . "</span>";
    echo "</div>";
    echo "</div>";
    echo "<div class='wishes'>";

    echo "</div>";

    echo "</div>";
    echo "</div>";
}