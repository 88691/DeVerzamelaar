<?php
$host = "localhost:3306";
$dbname = "first_database";
$username = "Selcheley";
$password = "MENovember21!";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Verbinding mislukt: " . $e->getMessage();
}

$sql = "SELECT * FROM `Bestel`;";
$stmt = $conn->query($sql);

$insert = "INSERT INTO Bestel(Naam, Achternaam, Adres, Email, Telefoonnummer, Datum) VALUES (?,?,?,?,?,?)";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Add new row
    if (isset($_POST['submit'])) {
        // Replace this comment with the code to insert the new row
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $adres = $_POST['adres']; 
        $email = $_POST['E-mail'];
        $tnummer = $_POST['telefoonnummer'];
        $date = $_POST['date'];

        try {
            // Prepare the insert statement
            $stmt = $conn->prepare($insert);

            // Bind the parameters
            $stmt->bindParam(1, $fname);
            $stmt->bindParam(2, $lname);
            $stmt->bindParam(3, $adres);
            $stmt->bindParam(4, $tnummer);
            $stmt->bindParam(5, $email);
            $stmt->bindParam(6, $date);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Bieding is toegevoegd";
            } else {
                // Display the error message
                $errorinfo = $stmt->errorInfo();
                echo "Fout bij het toevoegen van bieding: " . $errorinfo[2];
            }

            // Retrieve the updated data from the database
            $stmt = $conn->query($sql);
        } catch(PDOException $e) {
            // Display the error message
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data</title>
    <link rel="stylesheet" href="./PagesStylesheet.css">
</head>
<body>
    <div class="segmentD">
        <h2>Database 1</h2>
        <p>Data from Database 1 goes here.</p>
        <button class="update-button">Update</button>
        <button class="delete-button">Delete</button>
    </div>

    <div class="segmentD">
        <h2>Database 2</h2>
        <p>Data from Database 2 goes here.</p>
        <button class="update-button">Update</button>
        <button class="delete-button">Delete</button>
    </div>

    <div class="segmentD">
        <h2>Database 3</h2>
        <p>Data from Database 3 goes here.</p>
        <button class="update-button">Update</button>
        <button class="delete-button">Delete</button>
    </div>
    
</body>
</html>