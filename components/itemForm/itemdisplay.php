<?php
$host = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "jf_database";

$conn = new mysqli($host, $dbUser, $dbPass, $dbName);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$item_id = "";
$item = null;
$message = "";

// finds item id and executes script
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_id = $_POST["item_id"] ?? "";

    if (!empty($item_id) && is_numeric($item_id)) {
        $stmt = $conn->prepare("SELECT * FROM items WHERE item_id = ?");
        $stmt->bind_param("i", $item_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $item = $result->fetch_assoc();
        if (!$item) $message = "Item not found.";
        $stmt->close();
    } else {
        $message = "Please enter a valid item ID.";
    }
}

// Fetch all items for dropdown (extra credit)
$itemsList = $conn->query("SELECT item_id, item_name FROM items ORDER BY item_name");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Item Display - Jaxon's Pizza Palace</title>
    <link rel="stylesheet" href="../../styles/index.css">
    <link rel="stylesheet" href="../../styles/formStyle.css">
</head>
<body>
<header>
    <h1>Jaxon's Pizza Palace</h1>
    <p>View a Pizza Item</p>
</header>

<nav>
    <?php include("../../inc_navigation.php"); ?>
</nav>

<div class="container">
    <h2>Select a Pizza</h2>
    <form method="post">
        <label>Select an Item:</label>
        <select name="item_id">
            <option value="">-- Choose an item --</option>
            <!--shows all items in option menu-->
            <?php while($row = $itemsList->fetch_assoc()): ?>
                <option value="<?= $row['item_id'] ?>" <?= ($row['item_id'] == $item_id)?"selected":"" ?>>
                    <?= htmlspecialchars($row['item_name']) ?>
                </option>
            <?php endwhile; ?>
        </select>
        <input type="submit" value="Show Item">
    </form>

    <?php if ($message) echo "<p style='color:red;'>$message</p>"; ?>

    <?php if ($item): ?>
        <h2>Item Details</h2>
        <p><strong>Name:</strong> <?= htmlspecialchars($item['item_name']) ?></p>
        <p><strong>Description:</strong> <?= htmlspecialchars($item['description']) ?></p>
        <p><strong>Price:</strong> $<?= number_format($item['price'],2) ?></p>
        <p><strong>Size:</strong> <?= $item['size'] ?></p>
        <p><strong>Gluten Free:</strong> <?= $item['gluten_free'] ?></p>
        <p><strong>Toppings:</strong> <?= $item['toppings'] ?></p>
    <?php endif; ?>
</div>

<footer>
    <?php include("../../inc_footer.php"); ?>
</footer>
</body>
</html>
