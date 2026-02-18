<?php
$base = "/php/CIS134JaxonPizzaBusinessProject/";

$navCaptions = ["Home", "Menu", "Order Now", "Contact Us", "Display Orders", "Display Items"];
$navLinks = ["index.php", "products.php", "order.php", "contact.php", "components/orderForm/ordersdisplay.php", "components/itemForm/itemdisplay.php"];
// Loop through nav arrays to create links
foreach ($navLinks as $index => $link) {
    echo "<a href='{$base}{$link}'>{$navCaptions[$index]}</a>";
}