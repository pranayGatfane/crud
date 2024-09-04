<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "CREATE TABLE if not exists users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    if (mysqli_query($conn, $sql)) {
  echo "Table users created successfully";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}

// Handle Create
if (isset($_POST['create'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $sql = "INSERT INTO users (firstname, lastname, email) VALUES ('$firstname', '$lastname', '$email')";
    $conn->query($sql);
}

// Handle Update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $sql = "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email' WHERE id=$id";
    $conn->query($sql);
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM users WHERE id=$id";
    $conn->query($sql);
}

// Handle Filter and Sort
$filter = isset($_POST['filter']) ? $_POST['filter'] : '';
$sort = isset($_POST['sort']) ? $_POST['sort'] : 'id';
$sql = "SELECT * FROM users WHERE firstname LIKE '%$filter%' OR lastname LIKE '%$filter%' ORDER BY $sort";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Operations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2 class="mb-4">CRUD Operations with Filter and Sort</h2>
    <form method="post" action="" class="mb-4 row g-3">
        <div class="col-md-4">
            <input type="text" name="firstname" class="form-control" placeholder="First Name" required>
        </div>
        <div class="col-md-4">
            <input type="text" name="lastname" class="form-control" placeholder="Last Name" required>
        </div>
        <div class="col-md-4">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="col-12">
            <button type="submit" name="create" class="btn btn-primary">Create</button>
        </div>
    </form>

    
    <!-- start -->
    <form method="post" action="" class="mb-4 row g-3">
        <div class="col-md-8">
            <input type="text" name="filter" class="form-control" placeholder="Filter by Name">
        </div>
        <div class="col-md-2">
            <select name="sort" class="form-select">
                <!-- <option value="id">ID</option> -->
                <option value="firstname">First Name</option>
                <option value="lastname">Last Name</option>
                <!-- <option value="email">Email</option> -->
                <!-- <option value="reg_date">Date</option> -->
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-secondary">Filter & Sort</button>
        </div>
    </form>
     <!-- end -->

    <table class="table table-bordered">
        <thead>

            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['firstname']; ?></td>
            <td><?php echo $row['lastname']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['reg_date']; ?></td>
            <td>
                <form method="post" action="" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="text" name="firstname" value="<?php echo $row['firstname']; ?>" required>
                    <input type="text" name="lastname" value="<?php echo $row['lastname']; ?>" required>
                    <input type="email" name="email" value="<?php echo $row['email']; ?>" required>
                    <button type="submit" name="update">Update</button>
                </form>
                <a href="?delete=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
