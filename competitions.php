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
        echo '<div class="alert alert-success" role="alert">Nouvelle compétition ajoutée avec succès</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Erreur: ' . $sql . '<br>' . $db->conn->error . '</div>';
    }
}

$sql = "SELECT * FROM Competitions";
$result = $db->query($sql);
?>

<div class="container mt-5">
    <h2>Ajouter une Nouvelle Compétition</h2>
    <form method="post" action="competitions.php" class="mb-5">
        <div class="form-group">
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="lieu">Lieu:</label>
            <input type="text" id="lieu" name="lieu" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter Compétition</button>
    </form>

    <h2>Liste des Compétitions</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Date</th>
                <th>Lieu</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['competition_id']}</td>
                        <td>{$row['nom']}</td>
                        <td>{$row['date']}</td>
                        <td>{$row['lieu']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='text-center'>Aucune compétition trouvée</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
$db->close();
include 'footer.php';
?>