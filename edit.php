<?php 
$name = "";
$email = "";
$phone = "";
$address = "";

$successMessage = "";
$errorMessage = "";

require __DIR__ . '/config.php';                                
// create a connection
$connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if($_SERVER["REQUEST_METHOD"] == 'GET'){
    if(!isset($_GET["id"])){
        header("location: /myshop/index.php");
        exit;
    };

    $id = $_GET["id"];

    $sql = "select * from clients where id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location: /myshop/index.php");
        exit;
    };

    $name = $row['name'];
    $email = $row['email'];
    $phone = $row['phone'];
    $address = $row['address'];
} else {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    do {
        if(empty($id) || empty($name) || empty($email) || empty($phone) || empty($address)){
            $errorMessage = "All Fields Are Required";
            break;
        };

        $sql = "UPDATE clients set name='$name', email='$email', phone='$phone', address='$address' where id=$id";
        $result = $connection->query($sql);
        if(!$result){
            $errorMessage = "Invalid Query: " . $connection->error;
            break;
        };
        $successMessage = "Client added successfully";
        header("location: /myshop/index.php");
        exit;

    } while (false);
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>New Client</h2>
        <?php 
        if(!empty($errorMessage)){
            echo "
            <div class='alert alert-warning alert-dismissable fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" name="name" value="<?php echo $name ?>" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" name="email" value="<?php echo $email ?>" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6">
                    <input type="text" name="phone" value="<?php echo $phone ?>" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" name="address" value="<?php echo $address ?>" class="form-control">
                </div>
            </div>

            <?php 
        if(!empty($successMessage)){
            echo "
            <div class='row mb-3'>
                <div class='offset-sm-3 col-sm-6'>
                    <div class='alert alert-success alert-dismissable fade show' role='alert'>
                        <strong>$successMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                </div>
            </div>
            ";
        }
        ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a href="./index.php" role="button" class="btn btn-outline-primary">Cancel</a>
                </div>
            </div>

        </form>
    </div>
    
</body>
</html>
