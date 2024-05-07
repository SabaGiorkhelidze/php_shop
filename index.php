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
                $username = getenv('DB_USERNAME');
                $host =  getenv('DB_HOST');
                $password =  getenv('DB_PASSWORD');
                $database= getenv('DB_DATABASE');
                // create a connection
                $connection = new mysqli($host, $username, $password, $database);

                if($connection->connect_error){
                    die("Connection Failed: " . $connection->connect_error);
                }

                $sql= "SELECT * FROM clients";
                $result = $connection->query($sql);

                if(!$result){
                    die("Invalid Query: " . $connection->error);
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>