<?php include 'header.php'; ?>
<?php include 'Database.php'; ?>

<?php
$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bureau_id = $_POST["bureau_id"];
    $date_debut = $_POST["date_debut"];
    $date_fin = $_POST["date_fin"];
    $membre_id = $_POST["membre_id"];
    $role = $_POST["role"];

    $sql = "INSERT INTO Bureau (bureau_id, date_debut, date_fin, membre_id, role)
    VALUES ('$bureau_id', '$date_debut', '$date_fin', '$membre_id', '$role')";

    if ($db->query($sql) === TRUE) {
        echo "Nouveau bureau ajouté avec succès";
    } else {
        echo "Erreur: " . $sql . "<br>" . $db->conn->error;
    }
}

$sql = "SELECT * FROM Bureau";
$result = $db->query($sql);
?>
<div class="container mt-5">
    <h2>Ajouter un nouveau bureau</h2>
    <form method="post" action="bureaux.php" class="mb-5">
        <div class="form-group">
            <label for="bureau_id">ID Bureau:</label>
            <input type="text" id="bureau_id" name="bureau_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="date_debut">Date début:</label>
            <input type="date" id="date_debut" name="date_debutn" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="date_fin">Date fin:</label>
            <input type="date" id="date_fin" name="date_fin" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="membre_id">ID Membre:</label>
            <input type="text" id="membre_id" name="membre_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="role">Rôle:</label>
            <textarea class="form-control" id="role" name="role"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter Bureau</button>
    </form>
    
    <h2>Liste des Bureaux</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Bureau</th>
                <th>Date début</th>
                <th>Date fin</th>
                <th>ID Membre</th>
                <th>Rôle</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td data-label='ID'>{$row['bureau_id']}</td>
                        <td data-label='ID Bureau'>{$row['bureau_id']}</td>
                        <td data-label='Date début'>{$row['date_debut']}</td>
                        <td data-label='Date fin'>{$row['date_fin']}</td>
                        <td data-label='ID Membre'>{$row['membre_id']}</td>
                        <td data-label='Rôle'>{$row['role']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Aucun bureau trouvé</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
$db->close();
include 'footer.php'; 
?>
