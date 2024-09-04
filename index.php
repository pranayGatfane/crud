<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// sql to create table
$sql = "CREATE TABLE if not exists MyGuests (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

// if (mysqli_query($conn, $sql)) {
//   echo "Table MyGuests created successfully";
// } else {
//   echo "Error creating table: " . mysqli_error($conn);
// }

// // insert values
// $insert_values = "INSERT INTO MyGuests (firstname, lastname, email)
// VALUES ('John', 'Doe', 'john@example.com')";

// if ($conn->query($insert_values) === TRUE) {
//   echo "New record created successfully";
// } else {
//   echo "Error: " . $insert_values . "<br>" . $conn->error;
// }


// check last inserted id
// if ($conn->query($insert_values) === TRUE) {
//     $last_id = $conn->insert_id;
//     echo "New record created successfully. Last inserted ID is: " . $last_id;
//   } else {
//     echo "Error: " . $insert_values . "<br>" . $conn->error;
//   }

// insert multiple values
// $sql = "INSERT INTO MyGuests (firstname, lastname, email)
// VALUES ('John', 'Doe', 'john@example.com');";
// $sql .= "INSERT INTO MyGuests (firstname, lastname, email)
// VALUES ('Mary', 'Moe', 'mary@example.com');";
// $sql .= "INSERT INTO MyGuests (firstname, lastname, email)
// VALUES ('Julie', 'Dooley', 'julie@example.com')";

// if ($conn->multi_query($sql) === TRUE) {
//   echo "New records created successfully";
// } else {
//   echo "Error: " . $sql . "<br>" . $conn->error;
// }

// prepare and bind
// $stmt = $conn->prepare("INSERT INTO MyGuests (firstname, lastname, email) VALUES (?, ?, ?)");
// $stmt->bind_param("sss", $firstname, $lastname, $email);

// // set parameters and execute
// $firstname = "John";
// $lastname = "Doe";
// $email = "john@example.com";
// $stmt->execute();

// $firstname = "Mary";
// $lastname = "Moe";
// $email = "mary@example.com";
// $stmt->execute();

// $firstname = "Julie";
// $lastname = "Dooley";
// $email = "julie@example.com";
// $stmt->execute();

// echo "New records created successfully";

// $stmt->close();
// $conn->close();

// select
    $sql = "SELECT id, firstname, lastname,email FROM MyGuests";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Name</th><th>Email</th</tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["id"]."</td><td>".$row["firstname"]." ".$row["lastname"]."</td><td>".$row["email"]."</td></tr>";
        }
        echo "</table>";
      } else {
        echo "0 results";
      }

// where
        
    // $sql = "SELECT id, firstname, lastname FROM MyGuests WHERE lastname='Pranay'";
    // $result = mysqli_query($conn, $sql);

    // if (mysqli_num_rows($result) > 0) {
    // // output data of each row
    // while($row = mysqli_fetch_assoc($result)) {
    //     echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    // }
    // } else {
    // echo "0 results";
    // }

    // mysqli_close($conn);

// order by asending order desending order
    // $sql = "SELECT id, firstname, lastname FROM MyGuests ORDER BY lastname";
    // $result = mysqli_query($conn, $sql);

    // if (mysqli_num_rows($result) > 0) {
    // // output data of each row
    // while($row = mysqli_fetch_assoc($result)) {
    //     echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    // }
    // } else {
    // echo "0 results";
    // }

// delete
    // sql to delete a record
    // $sql = "DELETE FROM MyGuests WHERE id=3";

    // if ($conn->query($sql) === TRUE) {
    // echo "Record deleted successfully";
    // } else {
    // echo "Error deleting record: " . $conn->error;
    // }

// update
    $sql = "UPDATE MyGuests SET lastname='Gatfane' WHERE id=2";

    if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
    } else {
    echo "Error updating record: " . $conn->error;
    }
?>