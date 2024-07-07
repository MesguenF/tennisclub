<?php include 'header.php'; ?>
<?php include 'Database.php'; ?>

<?php
$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $date_naissance = $_POST["date_naissance"];
    $adresse = $_POST["adresse"];
    $email = $_POST["email"];
    $telephone = $_POST["telephone"];
    $specialite = $_POST["specialite"];

    $sql = "INSERT INTO Entraineurs (nom, prenom, date_naissance, adresse, email, telephone, specialite)
    VALUES ('$nom', '$prenom', '$date_naissance', '$adresse', '$email', '$telephone', '$specialite')";

    if ($db->query($sql) === TRUE) {
        echo "Nouvel entraîneur ajouté avec succès";
    } else {
        echo "Erreur: " . $sql . "<br>" . $db->conn->error;
    }
}

$sql = "SELECT * FROM Entraineurs";
$result = $db->query($sql);
?>

<h2>Ajouter un Nouvel Entraîneur</h2>
<form method="post" action="entraineurs.php">
    <label for="nom">Nom:</label>
    <input type="text" id="nom" name="nom" required>

    <label for="prenom">Prénom:</label>
    <input type="text" id="prenom" name="prenom" required>

    <label for="date_naissance">Date de Naissance:</label>
    <input type="date" id="date_naissance" name="date_naissance" required>

    <label for="adresse">Adresse:</label>
    <input type="text" id="adresse" name="adresse">

    <label for="email">Email:</label>
    <input type="email" id="email" name="email">

    <label for="telephone">Téléphone:</label>
    <input type="text" id="telephone" name="telephone">

    <label for="specialite">Spécialité:</label>
    <input type="text" id="specialite" name="specialite">

    <input type="submit" value="Ajouter Entraîneur">
</form>

<h2>Liste des Entraîneurs</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Date de Naissance</th>
        <th>Adresse</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Spécialité</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                <td data-label='ID'>{$row['entraineur_id']}</td>
                <td data-label='Nom'>{$row['nom']}</td>
                <td data-label='Prénom'>{$row['prenom']}</td>
                <td data-label='Date de Naissance'>{$row['date_naissance']}</td>
                <td data-label='Adresse'>{$row['adresse']}</td>
                <td data-label='Email'>{$row['email']}</td>
                <td data-label='Téléphone'>{$row['telephone']}</td>
                <td data-label='Spécialité'>{$row['specialite']}</td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='8'>Aucun entraîneur trouvé</td></tr>";
    }
    ?>
</table>

<?php
$db->close();
include 'footer.php'; 
?>
