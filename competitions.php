<?php include 'header.php'; ?>
<?php include 'Database.php'; ?>

<?php
$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $date = $_POST["date"];
    $lieu = $_POST["lieu"];

    $sql = "INSERT INTO Competitions (nom, date, lieu)
    VALUES ('$nom', '$date', '$lieu')";

    if ($db->query($sql) === TRUE) {
        echo "Nouvelle compétition ajoutée avec succès";
    } else {
        echo "Erreur: " . $sql . "<br>" . $db->conn->error;
    }
}

$sql = "SELECT * FROM Competitions";
$result = $db->query($sql);
?>

<h2>Ajouter une Nouvelle Compétition</h2>
<form method="post" action="competitions.php">
    <label for="nom">Nom:</label>
    <input type="text" id="nom" name="nom" required>

    <label for="date">Date:</label>
    <input type="date" id="date" name="date" required>

    <label for="lieu">Lieu:</label>
    <input type="text" id="lieu" name="lieu" required>

    <input type="submit" value="Ajouter Compétition">
</form>

<h2>Liste des Compétitions</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Date</th>
        <th>Lieu</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                <td data-label='ID'>{$row['competition_id']}</td>
                <td data-label='Nom'>{$row['nom']}</td>
                <td data-label='Date'>{$row['date']}</td>
                <td data-label='Lieu'>{$row['lieu']}</td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Aucune compétition trouvée</td></tr>";
    }
    ?>
</table>

<?php
$db->close();
include 'footer.php'; 
?>
