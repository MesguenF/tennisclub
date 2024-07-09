<?php include 'header.php'; ?>
<?php include 'Database.php'; ?>

<?php
$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $lieu = $_POST['lieu'];
    $ordre_du_jour = $_POST['ordre_du_jour'];
    $participants = $_POST['participants'];

    $sql = "INSERT INTO Reunions (date, heure, lieu, ordre_du_jour, participants)
    VALUES ('$date', '$heure', '$lieu', '$ordre_du_jour', '$participants')";
    
    if ($db->query($sql) === TRUE) {
        echo "Nouvelle réunion ajoutée avec succès";
    } else {
        echo "Erreur: " . $sql . "<br>" . $db->conn->error;
    }
}

$sql = "SELECT * FROM Reunions";
$result = $db->query($sql);
?>

<div class="container mt-5">
    <h2>Ajouter un nouveau bureau</h2>
    <form method="post" action="reunions.php" class="mb-5">
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="heure">Heure:</label>
            <input type="heure" id="heure" name="heure" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="lieu">Lieu:</label>
            <input type="text" id="lieu" name="lieu" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="ordre_du_jour">Ordre du jour:</label>
            <input type="text" id="ordre_du_jour" name="ordre_du_jour" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="participants">Participants:</label>
            <input type="text" id="participants" name="participants" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter Réunion</button>
    </form>
    
    <h2>Liste des Bureaux</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>Heure</th>
                <th>Lieu</th>
                <th>Ordre du jour</th>
                <th>Participants</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td data-label='Date'>{$row['date']}</td>
                        <td data-label='Heure'>{$row['heure']}</td>
                        <td data-label='Lieu'>{$row['lieu']}</td>
                        <td data-label='Ordre du jour'>{$row['ordre_du_jour']}</td>
                        <td data-label='Participants'>{$row['participants']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Aucune réunion trouvée</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
$db->close();
include 'footer.php'; 
?>
