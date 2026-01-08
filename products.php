<?php
/*
 * Jaxon Ford
 * 2026-01-04
 * I added products and a table that is created trough
 * looping through the objects. I also recreated the
 * navigation with arraying and looping the right item
 * in the correct location
 */

$products = [
    [
        "name" => "Classic Pepperoni",
        "price" => 12.99,
        "size" => "Medium",
        "description" => "Topped with pepperoni and cheese"
    ],
    [
        "name" => "Cheese",
        "price" => 10.99,
        "size" => "Medium",
        "description" => "Fresh basil, mozzarella, and tomato sauce"
    ],
    [
        "name" => "Meat Lovers",
        "price" => 15.99,
        "size" => "Large",
        "description" => "Pepperoni, sausage, ham, and bacon"
    ],
    [
        "name" => "Veggie Delight",
        "price" => 13.99,
        "size" => "Medium",
        "description" => "Loaded with peppers, onions, mushrooms, and olives"
    ],
    [
        "name" => "BBQ Chicken",
        "price" => 14.99,
        "size" => "Large",
        "description" => "Grilled chicken, BBQ sauce, and red onions"
    ]
];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jaxon's Pizza Palace - Menu</title>
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/products.css">
</head>
<body>
    <header>
        <h1>Jaxon's Pizza Palace</h1>
        <p>Fresh • Fast • Made Your Way</p>
    </header>
    <nav>
        <?php include("inc_navigation.php"); ?>
    </nav>
    <div class="container">
        <h2>Our Menu</h2>
        <p>Check out our delicious pizzas and specials below:</p>

        <table>
            <tr>
                <th>Pizza Name</th>
                <th>Price</th>
                <th>Size</th>
                <th>Description</th>
            </tr>
            <?php
            // Loop through products
            foreach ($products as $item) {
                echo "<tr>";
                echo "<td>{$item['name']}</td>";
                echo "<td>$" . number_format($item['price'], 2) . "</td>";
                echo "<td>{$item['size']}</td>";
                echo "<td>{$item['description']}</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>

    <footer>
        <?php include("inc_footer.php"); ?>
    </footer>
</body>
</html>

