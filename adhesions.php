<?php include 'header.php'; ?>
<?php include 'Database.php'; ?>

<?php
$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $membre_id = $_POST["membre_id"];
    $date_debut = $_POST["date_debut"];
    $date_fin = $_POST["date_fin"];
    $montant = $_POST["montant"];

    $sql = "INSERT INTO Adherer (membre_id, date_debut, date_fin, montant)
    VALUES ('$membre_id', '$date_debut', '$date_fin', '$montant')";

    if ($db->query($sql) === TRUE) {
        echo "Nouvelle adhésion ajoutée avec succès";
    } else {
        echo "Erreur: " . $sql . "<br>" . $db->conn->error;
    }
}

$sql = "SELECT * FROM Adherer";
$result = $db->query($sql);
?>

<h2>Ajouter une Nouvelle Adhésion</h2>
<form method="post" action="adhesions.php">
    <label for="membre_id">ID Membre:</label>
    <input type="text" id="membre_id" name="membre_id" required>

    <label for="date_debut">Date de Début:</label>
    <input type="date" id="date_debut" name="date_debut" required>

    <label for="date_fin">Date de Fin:</label>
    <input type="date" id="date_fin" name="date_fin" required>

    <label for="montant">Montant:</label>
    <input type="text" id="montant" name="montant" required>

    <input type="submit" value="Ajouter Adhésion">
</form>

<h2>Liste des Adhésions</h2>
<table>
    <tr>
        <th>ID</th>
        <th>ID Membre</th>
        <th>Date de Début</th>
        <th>Date de Fin</th>
        <th>Montant</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                <td data-label='ID'>{$row['adhesion_id']}</td>
                <td data-label='ID Membre'>{$row['membre_id']}</td>
                <td data-label='Date de Début'>{$row['date_debut']}</td>
                <td data-label='Date de Fin'>{$row['date_fin']}</td>
                <td data-label='Montant'>{$row['montant']}</td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>Aucune adhésion trouvée</td></tr>";
    }
    ?>
</table>

<?php
$db->close();
include 'footer.php'; 
?>
