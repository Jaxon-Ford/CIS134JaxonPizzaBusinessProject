<?php
/*
 * Jaxon Ford
 * itemform.php
 * Form for adding a pizza item
 */

$host = "localhost";
$dbUser = "root";           // Change if needed
$dbPass = "";               // Change if needed
$dbName = "jf_database";    // Your database name

$conn = new mysqli($host, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = "";
$price = "";
$size = "";
$description = "";
$glutenFree = "";
$toppings = [];

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {



    // NAME VALIDATION (required)
    if (empty($_POST["name"])) {
        $errors["name"] = "Pizza name is required.";
    } else {
        $name = htmlspecialchars(trim($_POST["name"]));
    }

    // PRICE VALIDATION (required + numeric)
    if (empty($_POST["price"])) {
        $errors["price"] = "Price is required.";
    } elseif (!is_numeric($_POST["price"])) {
        $errors["price"] = "Price must be a number.";
    } elseif ($_POST["price"] <= 0) {
        $errors["price"] = "Price must be greater than 0.";
    } else {
        $price = $_POST["price"];
    }

    // SIZE VALIDATION (radio required)
    if (empty($_POST["size"])) {
        $errors["size"] = "Please select a size.";
    } else {
        $size = $_POST["size"];
    }

    // DESCRIPTION VALIDATION (required)
    if (empty($_POST["description"])) {
        $errors["description"] = "Description is required.";
    } else {
        $description = htmlspecialchars(trim($_POST["description"]));
    }

    // SELECT (Gluten Free)
    if (!empty($_POST["glutenFree"])) {
        $glutenFree = $_POST["glutenFree"];
    }

    // CHECKBOX (toppings optional)
    if (!empty($_POST["toppings"])) {
        $toppings = $_POST["toppings"];
    }

    if (empty($errors)) {

        // Convert toppings array to string
        $toppingsStr = !empty($toppings) ? implode(", ", $toppings) : "None";

        $sql = "INSERT INTO items (item_name, description, price, size, gluten_free, toppings)
        VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ssdsss", $name, $description, $price, $size, $glutenFree, $toppingsStr);

            if ($stmt->execute()) {
                echo "<h2>Pizza Successfully Added to Database!</h2>";
            } else {
                echo "<h2 style='color:red;'>Database Error: " . $stmt->error . "</h2>";
            }
            $stmt->close();
        } else {
            echo "<h2 style='color:red;'>Database Error: " . $conn->error . "</h2>";
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Pizza - Jaxon's Pizza Palace</title>
    <link rel="stylesheet" href="../../styles/index.css">
    <link rel="stylesheet" href="../../styles/formStyle.css">
</head>
<body>

<header>
    <h1>Jaxon's Pizza Palace</h1>
    <p>Add a New Pizza Item</p>
</header>

<nav>
    <?php include("../../inc_navigation.php"); ?>
</nav>

<div class="container">

<?php
// If form submitted AND no errors → show success
if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($errors)) {
    echo "<h2>Form Accepted!</h2>";
    echo "<p><strong>Pizza Name:</strong> $name</p>";
    echo "<p><strong>Price:</strong> $" . number_format($price, 2) . "</p>";
    echo "<p><strong>Size:</strong> $size</p>";
    echo "<p><strong>Description:</strong> $description</p>";
    echo "<p><strong>Gluten Free:</strong> $glutenFree</p>";

    if (!empty($toppings)) {
        echo "<p><strong>Extra Toppings:</strong> " . implode(", ", $toppings) . "</p>";
    } else {
        echo "<p><strong>Extra Toppings:</strong> None</p>";
    }

} else {
?>

<h2>Create a New Pizza</h2>

<form method="post" action="itemform.php">

    <!-- NAME -->
    <label>Pizza Name:</label><br>
    <input type="text" name="name" value="<?= $name ?>"><br>
    <span style="color:red;"><?= isset($errors["name"]) ? $errors["name"] : "" ?></span><br><br>

    <!-- PRICE -->
    <label>Price:</label><br>
    <input type="text" name="price" value="<?= $price ?>"><br>
    <span style="color:red;"><?= isset($errors["price"]) ? $errors["price"] : "" ?></span><br><br>

    <!-- SIZE (Radio Buttons) -->
    <label>Size:</label><br>
    <input type="radio" name="size" value="Small" <?= ($size=="Small")?"checked":"" ?>> Small
    <input type="radio" name="size" value="Medium" <?= ($size=="Medium")?"checked":"" ?>> Medium
    <input type="radio" name="size" value="Large" <?= ($size=="Large")?"checked":"" ?>> Large
    <br>
    <span style="color:red;"><?= isset($errors["size"]) ? $errors["size"] : "" ?></span><br><br>

    <!-- DESCRIPTION -->
    <label>Description:</label><br>
    <input type="text" name="description" value="<?= $description ?>"><br>
    <span style="color:red;"><?= isset($errors["description"]) ? $errors["description"] : "" ?></span><br><br>

    <!-- SELECT -->
    <label>Gluten Free Option:</label><br>
    <select name="glutenFree">
        <option value="No" <?= ($glutenFree=="No")?"selected":"" ?>>No</option>
        <option value="Yes" <?= ($glutenFree=="Yes")?"selected":"" ?>>Yes</option>
    </select>
    <br><br>

    <!-- CHECKBOX -->
    <label>Extra Toppings:</label><br>
    <input type="checkbox" name="toppings[]" value="Extra Cheese"> Extra Cheese<br>
    <input type="checkbox" name="toppings[]" value="Mushrooms"> Mushrooms<br>
    <input type="checkbox" name="toppings[]" value="Olives"> Olives<br><br>

    <input type="submit" value="Submit Pizza">

</form>

<?php } ?>

</div>

<footer>
    <?php include("../../inc_footer.php"); ?>
</footer>

</body>
</html>
