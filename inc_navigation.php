<?php
$navCaptions = ["Home", "Menu", "Order Now", "Contact Us"];
$navLinks = ["index.php", "products.php", "order.php", "contact.php"];
// Loop through nav arrays to create links
foreach ($navLinks as $index => $link) {
    echo "<a href='{$link}'>{$navCaptions[$index]}</a>";
}