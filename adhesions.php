<?php include 'header.php'; ?>
<?php include 'Database.php'; ?>

<?php
$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $membre_id = $_POST["membre_id"];
    $date_debut = $_POST["date_debut"];
    $date_fin = $_POST["date_fin"];
    $montant = $_POST["montant"];

    $sql = "INSERT INTO Adhesions (membre_id, date_debut, date_fin, montant)
    VALUES ('$membre_id', '$date_debut', '$date_fin', '$montant')";

    if ($db->query($sql) === TRUE) {
        echo '<div class="alert alert-success" role="alert">Nouvelle adhésion ajoutée avec succès</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Erreur: ' . $sql . '<br>' . $db->conn->error . '</div>';
    }
}

$sql = "SELECT * FROM Adhesions";
$result = $db->query($sql);
?>

<div class="container mt-5">
    <h2>Ajouter une Nouvelle Adhésion</h2>
    <form method="post" action="adhesions.php" class="mb-5">
        <div class="form-group">
            <label for="membre_id">ID Membre:</label>
            <input type="text" id="membre_id" name="membre_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="date_debut">Date de Début:</label>
            <input type="date" id="date_debut" name="date_debut" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="date_fin">Date de Fin:</label>
            <input type="date" id="date_fin" name="date_fin" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="montant">Montant:</label>
            <input type="text" id="montant" name="montant" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter Adhésion</button>
    </form>

    <h2>Liste des Adhésions</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Membre</th>
                <th>Date de Début</th>
                <th>Date de Fin</th>
                <th>Montant</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['adhesion_id']}</td>
                        <td>{$row['membre_id']}</td>
                        <td>{$row['date_debut']}</td>
                        <td>{$row['date_fin']}</td>
                        <td>{$row['montant']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>Aucune adhésion trouvée</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
$db->close();
include 'footer.php';
?>
