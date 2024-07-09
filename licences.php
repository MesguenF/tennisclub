<?php include 'header.php'; ?>
<?php include 'Database.php'; ?>

<?php
$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $type = $_POST['type'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $cout = $_POST['cout'];

    $sql = "INSERT INTO Licences (nom, type, date_debut, date_fin, cout)
    VALUES ('$nom', '$type', '$date_debut', '$date_fin', '$cout')";
       
    if ($db->query($sql) === TRUE) {
        echo "Nouvelle licence ajoutée avec succès";
    } else {
        echo "Erreur: " . $sql . "<br>" . $db->conn->error;
    }
}

$sql = "SELECT * FROM Licences";
$result = $db->query($sql);
?>

<div class="container mt-5">
    <h2>Ajouter une nouvelle licence</h2>
    <form method="post" action="contributions.php" class="mb-5">
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <input type="text" class="form-control" id="type" name="type" required>
        </div>
        <div class="form-group">
            <label for="date_debut">Date de Début</label>
            <input type="date" class="form-control" id="date_debut" name="date_debut" required>
        </div>
        <div class="form-group">
            <label for="date_fin">Date de Fin</label>
            <input type="date" class="form-control" id="date_fin" name="date_fin" required>
        </div>
        <div class="form-group">
            <label for="cout">Coût</label>
            <input type="text" class="form-control" id="cout" name="cout" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
    
    <h2>Liste des licences</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Type</th>
                <th>Date de Début</th>
                <th>Date de Fin</th>
                <th>Coût</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td data-label='ID'>{$row['licence_id']}</td>
                        <td data-label='Nom'>{$row['nom']}</td>
                        <td data-label='Type'>{$row['type']}</td>
                        <td data-label='Date de Début'>{$row['date_debut']}</td>
                        <td data-label='Date de Fin'>{$row['date_fin']}</td>
                        <td data-label='Coût'>{$row['cout']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Aucune licence trouvée</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
$db->close();
include 'footer.php'; 
?>
