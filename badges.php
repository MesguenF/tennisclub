<?php include 'header.php'; ?>
<?php include 'Database.php'; ?>

<?php
$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $badge_id = $_POST["badge_id"];
    $date_attribution = $_POST["date_attribution"];
    $date_expiration = $_POST["date_expiration"];
    $membre_id = $_POST["membre_id"];    

    $sql = "INSERT INTO Badges (badge_id, date_attribution, date_expiration, membre_id)
    VALUES ('$badge_id', '$date_attribution', '$date_expiration', '$membre_id')";

    if ($db->query($sql) === TRUE) {
        echo "Nouveau badge ajouté avec succès";
    } else {
        echo "Erreur: " . $sql . "<br>" . $db->conn->error;
    }
}

$sql = "SELECT * FROM Badges";
$result = $db->query($sql);
?>
<div class="container mt-5">
    <h2>Ajouter un nouveau badge</h2>
    <form method="post" action="badges.php" class="mb-5">
        <div class="form-group">
            <label for="badge_id">ID Badge:</label>
            <input type="text" id="badge_id" name="badge_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="date_attribution">Date d'attribution:</label>
            <input type="date" id="date_attribution" name="date_attribution" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="date_expiration">Date d'expiration:</label>
            <input type="date" id="date_expiration" name="date_expiration" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="membre_id">ID Membre:</label>
            <input type="text" id="membre_id" name="membre_id" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter Badge</button>
    </form>
    
    <h2>Liste des Badges</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Badge</th>
                <th>Date attribution</th>
                <th>Date expiration</th>
                <th>ID Membre</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td data-label='ID'>{$row['badge_id']}</td>
                        <td data-label='ID Badge'>{$row['badge_id']}</td>
                        <td data-label='Date attribution'>{$row['date_attribution']}</td>
                        <td data-label='Date expiration'>{$row['date_expiration']}</td>
                        <td data-label='ID Membre'>{$row['membre_id']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Aucun badge trouvé</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
$db->close();
include 'footer.php'; 
?>
