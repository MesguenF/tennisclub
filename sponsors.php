<?php include 'header.php'; ?>
<?php include 'Database.php'; ?>

<?php
$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $site_web = $_POST['site_web'];

    $sql = "INSERT INTO Sponsors (nom, contact, email, telephone, adresse, site_web)
    VALUES ('$nom', '$contact', '$email', '$telephone', '$adresse', '$site_web')";
       
    if ($db->query($sql) === TRUE) {
        echo "Nouveau sponsor ajouté avec succès";
    } else {
        echo "Erreur: " . $sql . "<br>" . $db->conn->error;
    }
}

$sql = "SELECT * FROM Sponsors";
$result = $db->query($sql);
?>

<div class="container mt-5">
    <h2>Ajouter un nouveau bureau</h2>
    <form method="post" action="sponsors.php" class="mb-5">
    <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="form-group">
            <label for="contact">Contact</label>
            <input type="text" class="form-control" id="contact" name="contact" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="text" class="form-control" id="telephone" name="telephone">
        </div>
        <div class="form-group">
            <label for="adresse">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse">
        </div>
        <div class="form-group">
            <label for="site_web">Site Web</label>
            <input type="text" class="form-control" id="site_web" name="site_web">
        </div>
        <button type="submit" class="btn btn-primary">Ajouter sponsor</button>
    </form>
    
    <h2>Liste des Sponsors</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Adresse</th>
                <th>Site Web</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td data-label='Nom'>{$row['nom']}</td>
                        <td data-label='Contact'>{$row['contact']}</td>
                        <td data-label='Email'>{$row['email']}</td>
                        <td data-label='Téléphone'>{$row['telephone']}</td>
                        <td data-label='Adresse'>{$row['adresse']}</td>
                        <td data-label='Site Web'>{$row['site_web']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Aucun sponsor trouvé</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
$db->close();
include 'footer.php'; 
?>
