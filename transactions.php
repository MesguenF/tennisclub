<?php include 'header.php'; ?>
<?php include 'Database.php'; ?>

<?php
$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $membre_id = $_POST["membre_id"];
    $type = $_POST["type"];
    $montant = $_POST["montant"];
    $date_transaction = $_POST["date_transaction"];

    $sql = "INSERT INTO Transactions (membre_id, type, montant, date_transaction)
    VALUES ('$membre_id', '$type', '$montant', '$date_transaction')";

    if ($db->query($sql) === TRUE) {
        echo "Nouvelle transaction ajoutée avec succès";
    } else {
        echo "Erreur: " . $sql . "<br>" . $db->conn->error;
    }
}

$sql = "SELECT * FROM Transactions";
$result = $db->query($sql);
?>
<div class="container mt-5">
    <h2>Ajouter une Nouvelle Transaction</h2>
    <form method="post" action="transactions.php" class="mb-5">
        <div class="form-group">
            <label for="membre_id">ID Membre:</label>
            <input type="text" id="membre_id" name="membre_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="type">Type:</label>
            <input type="text" id="type" name="type" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="montant">Montant:</label>
            <input type="text" id="montant" name="montant" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="date_transaction">Date de Transaction:</label>
            <input type="date" id="date_transaction" name="date_transaction" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter Transaction</button>
    </form>
    
    <h2>Liste des Transactions</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Membre</th>
                <th>Type</th>
                <th>Montant</th>
                <th>Date de Transaction</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td data-label='ID'>{$row['transaction_id']}</td>
                        <td data-label='ID Membre'>{$row['membre_id']}</td>
                        <td data-label='Type'>{$row['type']}</td>
                        <td data-label='Montant'>{$row['montant']}</td>
                        <td data-label='Date de Transaction'>{$row['date_transaction']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Aucune transaction trouvée</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
$db->close();
include 'footer.php'; 
?>
