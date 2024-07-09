<?php include 'header.php'; ?>
<?php include 'Database.php'; ?>

<?php
$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $montant = $_POST['montant'];

    $sql = "INSERT INTO Contributions (nom, description, date, montant)
    VALUES ('$nom', '$description', '$date', '$montant')";
       
    if ($db->query($sql) === TRUE) {
        echo "Nouvelle contribution ajouté avec succès";
    } else {
        echo "Erreur: " . $sql . "<br>" . $db->conn->error;
    }
}

$sql = "SELECT * FROM Contributions";
$result = $db->query($sql);
?>

<div class="container mt-5">
    <h2>Ajouter une nouvelle contribution</h2>
    <form method="post" action="contributions.php" class="mb-5">
    <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <div class="form-group">
            <label for="montant">Montant</label>
            <input type="text" class="form-control" id="montant" name="montant" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
    
    <h2>Liste des contributions</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Date</th>
                <th>Montant</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td data-label='Nom'>{$row['nom']}</td>
                        <td data-label='Description'>{$row['description']}</td>
                        <td data-label='Date'>{$row['date']}</td>
                        <td data-label='Montant'>{$row['montant']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Aucune contribution trouvée</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
$db->close();
include 'footer.php'; 
?>
