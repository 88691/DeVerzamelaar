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
    <title>Contact</title>
    <link rel="stylesheet" href="./PagesStylesheet.css">
</head>
<body>
    <header class="header">
        <div class="border">
            <div class="logo">
                <img src="./Wpics/logo.png" alt="lotus logo" class="logo-img">
                <p class="logo-text"><i>De Verzamelaars Vakbond</i></p>
            </div>
        </div>
        <div class="button-placement">
            <button class="button"><a href="Contact.php">Contact</a></button>
            <button class="button"><a href="Verzameling.html">Verzameling</a></button>
        </div>
    </header>
    <hr>
<body>
    <div class="contentC">
        <h2>Contact Formulier</h2><br>
        <form method="post">
            <label for="fname">Voornaam</label>
            <input type="text" name="firstname" required><br>
    
            <label for="lname">Achternaam</label>
            <input type="text" name="lname" required><br>
    
            <label for="adres">Adres</label>
            <input type="text" name="adres" required><br>
    
            <label for="tnummer">Telefoonnummer</label>
            <input type="tel" id="phone" name="phone" placeholder="01-23456789" pattern="[0-9]{2}-[0-9]{8}"><br>
    
            <label for="email">E-mail</label>
            <input type="email" name="email" required><br>
    
            <label for="date">Datum</label>
            <input type="date" name="date"><br><br>
    
            <input type="submit" name="submit" value="submit">
        </form>
        
    </div>
      <script src="./PagesStylesheet.css"></script>
</body>
</html>