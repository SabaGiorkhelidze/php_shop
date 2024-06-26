<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>List of Clients</h2>
        <a href="/myshop/create.php" class="btn btn-primary" role="button">New Client</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                require __DIR__ . '/config.php';
                                // create a connection
                $connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

                if($connection->connect_error){
                    die("Connection Failed: " . $connection->connect_error);
                }

                $sql= "SELECT * FROM clients";
                $result = $connection->query($sql);

                if(!$result){
                    die("Invalid Query: " . $connection->error);
                };

                while($row = $result-> fetch_assoc()){
                    echo "
                        <tr>
                            <td>$row[id]</td>
                            <td>$row[name]</td>
                            <td>$row[email]</td>
                            <td>$row[phone]</td>
                            <td>$row[address]</td>
                            <td>$row[created_at]</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='/myshop/edit.php?id=$row[id]'>Edit</a>
                                <a class='btn btn-primary btn-sm' href='/myshop/delete.php?id=$row[id]'>Delete</a>
                            </td>

                            </tr>
                    ";
                };
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>