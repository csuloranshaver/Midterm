<?php
    require_once('database.php');
    
    $customerID = 1004;
    
    $query = "SELECT products.productCode, products.name, customers.firstName, customers.lastName
                FROM registrations
                JOIN products ON registrations.productCode = products.productCode
                JOIN customers ON registrations.customerID = customers.customerID
                WHERE registrations.customerID = ?";
              
    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $customerID);
    $stmt->execute();
    
    $stmt->store_result();
    $stmt->bind_result($productCode, $name, $firstName, $lastName);
?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
    <div id="page">

    <div id="header">
        <h1>Registration Manager</h1>
    </div>

    <div id="main">

        <h1>Registrations</h1>

        <div id="content">
            <!-- display a table of customers -->
            <table>
                <tr>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                </tr>
                <?php while ($stmt->fetch()) : ?>
                <tr>
                    <td><?php echo $productCode; ?></td>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $firstName; ?></td>
                    <td><?php echo $lastName; ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>

    <div id="footer">
        <p>&copy; <?php echo date("Y"); ?> Soylent Green, Inc.</p>
    </div>

    </div><!-- end page -->
</body>
</html>
<?php
    $stmt -> free_result();
    $db -> close();
?>