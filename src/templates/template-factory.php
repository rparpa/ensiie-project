<?php

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

    echo "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path fill='white'
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

function templateItem($item)
{
    echo "<div class='item'>";
    echo "<button class='delete'>";
    echo "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512'>
            <path d='M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM394.8 466.1C393.2 492.3 372.3 512 346.9 512H101.1C75.75 512 54.77 492.3 53.19 466.1L31.1 128H416L394.8 466.1z'/>
            </svg>";
    echo "</button>";
    echo "<div class='image'>";
    echo "<img class='logo' src='../static/assets/stylo.jpg'/>";
    echo "<div class='categories' id='cat-container'>
    <span class='category'>EDUCATION</span>
    <span class='category'>CHEAT CODE</span>
    </div>";
    echo "</div>";
    echo "<div class='information'>";
    echo "<h3> Stylo Frixion bleu sans cartouche </h3>";

    echo "<span class='date'>Date d'ajout: 04/01/2002</span>";
    echo "<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>";

    echo "</div>";

    echo "</div>";
}