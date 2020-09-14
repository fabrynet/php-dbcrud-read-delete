<?php
// connessione al database
$servername = "localhost";
$username = "root";
$password = "code";
$dbname = "dbhotel";
$conn = new mysqli($servername, $username, $password, $dbname);

//se non avviene la connessione
if ($conn && $conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
    return;
}

// seleziona tutto dalla tabella pagamenti e stampa il risultato in una lista ordinata (fatto in classe)
$sql = "
  SELECT * FROM pagamenti
";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
  ?>
  <ol>
    <?php
    while($row = $result->fetch_assoc()) {
    ?>
    <li><?php echo $row['id'].": ".$row['status']." | ".$row['price']; ?></li>
    <?php
      }
     ?>
  </ol>
<?php
} elseif ($result) {
    echo "0 results";
} else {
    echo "query error";
}

// elimina dalla tabella pagamenti la riga con id 8 (fatto in classe)
$payment = 8;
$sql = "
  DELETE
  FROM pagamenti
  WHERE id = $payment
";
$result = $conn->query($sql);
if ($result) {
    echo "Deleted payment ".$payment."<br>";
} else {
    echo "query error";
}

// elimina dalla tabella pagamenti la riga con pagante_id = 6 e con status = rejected
$paying = 6;
$status = 'rejected';
$sql = "
  DELETE
  FROM pagamenti
  WHERE pagante_id = $paying AND status LIKE '$status'
";
$result = $conn->query($sql);
if ($result) {
    echo "Deleted paying_id ".$paying." and status: ".$status."<br>";
} else {
    echo "query error";
}

// seleziona dalla tabella pagamenti le colonne id, status e price di tutti i pagamenti con price superiore a 600, stampa il risultato in una lista non ordinata
$sql = "
  SELECT id, status, price
  FROM pagamenti
  WHERE price > 600
";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
  ?>
  <ul>
    <?php
    while($row = $result->fetch_assoc()) {
    ?>
    <li><?php echo $row['id'].": ".$row['status']." | ".$row['price']; ?></li>
    <?php
      }
     ?>
  </ul>
<?php
} elseif ($result) {
    echo "0 results";
} else {
    echo "query error";
}

$conn->close();
?>
