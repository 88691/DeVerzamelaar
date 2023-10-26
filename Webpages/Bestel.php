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
    <title>Bestel form</title>
    <style>
        *{
            background-color: cyan;
        }

        label{
            background-color: aliceblue;
            color: black;

        }

        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Bestel</h1>

    <h2></h2>
    <form method="post">
        <label for="fname">Voornaam</label>
        <input type="text" name="firstname" required><br>

        <label for="lname">Achternaam</label>
        <input type="text" name="lname" required><br>

        <label for="adres">Adres</label>
        <input type="text" name="adres" required><br>

        <label for="tnummer">Telefoonnummer</label>
        <input type="tel" id="phone" name="phone" placeholder="123-45-678" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"><br>

        <label for="email">E-mail</label>
        <input type="number" name="email" required><br>

        <label for="date">Datum</label>
        <input type="text" name="date"><br>

        <input type="submit" name="submit" value="submit">
    </form>


</body>
</html>
