<?php
$host = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "jf_database";

$conn = new mysqli($host, $dbUser, $dbPass, $dbName);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
// selects all orders
$sql = "SELECT o.order_id, o.quantity, o.order_date, o.total_cost, i.item_name, i.description
        FROM orders o
        JOIN items i ON o.item_id = i.item_id
        ORDER BY o.order_date DESC";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orders Display - Jaxon's Pizza Palace</title>
    <link rel="stylesheet" href="../../styles/index.css">
    <link rel="stylesheet" href="../../styles/formStyle.css">
</head>
<body>
<header>
    <h1>Jaxon's Pizza Palace</h1>
    <p>All Orders</p>
</header>

<nav>
    <?php include("../../inc_navigation.php"); ?>
</nav>

<div class="container">
    <h2>All Orders</h2>
    <table border="1">
        <tr>
            <th>Order ID</th>
            <th>Item Name</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Order Date</th>
            <th>Total Cost</th>
        </tr>
        <!--displays all orders-->
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['order_id'] ?></td>
                <td><?= htmlspecialchars($row['item_name']) ?></td>
                <td><?= htmlspecialchars($row['description']) ?></td>
                <td><?= $row['quantity'] ?></td>
                <td><?= $row['order_date'] ?></td>
                <td>$<?= number_format($row['total_cost'],2) ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>

<footer>
    <?php include("../../inc_footer.php"); ?>
</footer>
</body>
</html>