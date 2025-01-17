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
    $date_inscription = $_POST["date_inscription"];
    $abonnement_actuel = isset($_POST["abonnement_actuel"]) ? 1 : 0;
    $classement = $_POST["classement"];
    $commentaire = $_POST["commentaire"];
    $souhaite_competition = isset($_POST["souhaite_competition"]) ? 1 : 0;

    $sql = "INSERT INTO Membres (nom, prenom, date_naissance, adresse, email, telephone, date_inscription, abonnement_actuel, classement, commentaire, souhaite_competition)
    VALUES ('$nom', '$prenom', '$date_naissance', '$adresse', '$email', '$telephone', '$date_inscription', $abonnement_actuel, '$classement', '$commentaire', $souhaite_competition)";

    if ($db->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Nouveau membre ajouté avec succès</div>";
    } else {
        echo "<div class='alert alert-danger'>Erreur: " . $sql . "<br>" . $db->conn->error . "</div>";
    }
}

$sql = "SELECT * FROM Membres";
$result = $db->query($sql);
?>

<div class="container">
    <h2>Ajouter un Nouveau Membre</h2>
    <form method="post" action="membres.php">
        <div class="form-group">
            <label for="nom">Nom:</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom:</label>
            <input type="text" class="form-control" id="prenom" name="prenom" required>
        </div>
        <div class="form-group">
            <label for="date_naissance">Date de Naissance:</label>
            <input type="date" class="form-control" id="date_naissance" name="date_naissance" required>
        </div>
        <div class="form-group">
            <label for="adresse">Adresse:</label>
            <input type="text" class="form-control" id="adresse" name="adresse">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="telephone">Téléphone:</label>
            <input type="text" class="form-control" id="telephone" name="telephone">
        </div>
        <div class="form-group">
            <label for="date_inscription">Date d'Inscription:</label>
            <input type="date" class="form-control" id="date_inscription" name="date_inscription" required>
        </div>
        <div class="form-group">
            <label for="abonnement_actuel">Abonnement Actuel:</label>
            <input type="checkbox" class="form-check-input" id="abonnement_actuel" name="abonnement_actuel">
        </div>
        <div class="form-group">
            <label for="classement">Classement:</label>
            <input type="text" class="form-control" id="classement" name="classement">
        </div>
        <div class="form-group">
            <label for="commentaire">Commentaire:</label>
            <textarea class="form-control" id="commentaire" name="commentaire"></textarea>
        </div>
        <div class="form-group">
            <label for="souhaite_competition">Souhaite Participer aux Compétitions:</label>
            <input type="checkbox" class="form-check-input" id="souhaite_competition" name="souhaite_competition">
        </div>
        <button type="submit" class="btn btn-primary">Ajouter Membre</button>
    </form>

    <h2>Liste des Membres</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de Naissance</th>
                <th>Adresse</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Date d'Inscription</th>
                <th>Abonnement Actuel</th>
                <th>Classement</th>
                <th>Commentaire</th>
                <th>Compétition</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td data-label='ID'>{$row['membre_id']}</td>
                        <td data-label='Nom'>{$row['nom']}</td>
                        <td data-label='Prénom'>{$row['prenom']}</td>
                        <td data-label='Date de Naissance'>{$row['date_naissance']}</td>
                        <td data-label='Adresse'>{$row['adresse']}</td>
                        <td data-label='Email'>{$row['email']}</td>
                        <td data-label='Téléphone'>{$row['telephone']}</td>
                        <td data-label='Date d Inscription'>{$row['date_inscription']}</td>
                        <td data-label='Abonnement Actuel'>" . ($row['abonnement_actuel'] ? 'Oui' : 'Non') . "</td>
                        <td data-label='Classement'>{$row['classement']}</td>
                        <td data-label='Commentaire'>{$row['commentaire']}</td>
                        <td data-label='Compétition'>" . ($row['souhaite_competition'] ? 'Oui' : 'Non') . "</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='12'>Aucun membre trouvé</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
$db->close();
include 'footer.php'; 
?>
