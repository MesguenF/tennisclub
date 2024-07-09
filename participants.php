<?php include 'header.php'; ?>
<?php include 'Database.php'; ?>

<?php
$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    $sql = "INSERT INTO Participants (nom, prenom, email, telephone)
    VALUES ('$nom', '$prenom', '$email', '$telephone')";
       
    if ($db->query($sql) === TRUE) {
        echo "Nouveau participant ajouté avec succès";
    } else {
        echo "Erreur: " . $sql . "<br>" . $db->conn->error;
    }
}

$sql = "SELECT * FROM Participants";
$result = $db->query($sql);
?>

<div class="container mt-5">
    <h2>Ajouter un nouveau participant</h2>
    <form method="post" action="participants.php" class="mb-5">
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="text" class="form-control" id="telephone" name="telephone" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
    
    <h2>Liste des participants</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td data-label='ID'>{$row['participant_id']}</td>
                        <td data-label='Nom'>{$row['nom']}</td>
                        <td data-label='Prénom'>{$row['prenom']}</td>
                        <td data-label='Email'>{$row['email']}</td>
                        <td data-label='Téléphone'>{$row['telephone']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Aucun participant trouvé</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
$db->close();
include 'footer.php'; 
?>
