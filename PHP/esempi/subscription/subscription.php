<html>
  <head>
    <title>Subscription</title>
  </head>
  <body>
  <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      include 'Account.php';
      include 'Utente.php';

      

      $username = $_POST['username'];
      $password = $_POST['password'];
      $nome = $_POST['nome'];
      $cognome = $_POST['cognome'];
      $nickname = $_POST['nickname'];
      $email = $_POST['email'];

      echo "Username " . $username;

      echo "<p align='center'>Metodo doPost invocato...</p>";
      echo "<p align='center'>Ecco la lista dei parametri inviati nella form:</p><br>";
      echo "<p align='center'>Dati Account:</p>";
      echo "<p align='center'>Username: $username </p>";
      echo "<p align='center'>Password: $password </p>";
      echo "<p align='center'>Dati Utente:</p>";
      echo "<p align='center'>Nome: $nome </p>";
      echo "<p align='center'>Cognome: $cognome </p>";
      echo "<p align='center'>Nickname: $nickname </p>";
      echo "<p align='center'>Email: $email </p>";

      $utente = new Utente($nome, $cognome, $nickname, $email);
      $account = new Account($username, $password, $utente);
      $account->setProprietario($utente);

      echo "<br>Oggetto account:<br>";
      echo "username: " . $account->getUsername() . "<br>";
      echo "password: " . $account->getPassword() . "<br>";
      echo "Oggetto utente:<br>";
      echo "nome: " . $utente->getNome() . "<br>";
      echo "cognome: " . $utente->getCognome() . "<br>";
      echo "nickname: " . $utente->getNickname() . "<br>";
      echo "email: " . $utente->getEmail() . "<br>";

      // Connessione al database

      $servername = "localhost";
      $dbUsername = "root";
      $dbPassword = "giovanni";
      $dbName = "php_db";

      $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);
      if ($conn->connect_error) {
        die("Connection failed...<br>");
      }

      echo "Connected successfully...<br>";

      // Query per creare la tabella Account se non esiste
      $createAccountTable = "CREATE TABLE IF NOT EXISTS Account (
                                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                Username VARCHAR(30) NOT NULL,
                                Pwd VARCHAR(30) NOT NULL
                              )";

      if ($conn->query($createAccountTable) === TRUE) {
        echo "Table 'Account' created or already exists...<br>";
      } else {
        echo "Error creating 'Account' table: " . $conn->error . "<br>";
      }

      // Prima query per Account
      $firstStatement = $conn->prepare("INSERT INTO Account (Username, Pwd) VALUES (?, ?)");
      $firstStatement->bind_param("ss", $username, $password);

      // Esegui la query
      $firstStatement->execute();

      if ($firstStatement->affected_rows > 0) {
        echo "New Account record created successfully<br>";
      } else {
        echo "Cannot insert record in Account<br>";
      }

      // Query per creare la tabella Utenti se non esiste
      $createUtentiTable = "CREATE TABLE IF NOT EXISTS Utenti (
                                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                Username VARCHAR(30) NOT NULL,
                                Nome VARCHAR(30) NOT NULL,
                                Cognome VARCHAR(30) NOT NULL,
                                Nickname VARCHAR(30) NOT NULL,
                                Email VARCHAR(50) NOT NULL
                              )";

      if ($conn->query($createUtentiTable) === TRUE) {
        echo "Table 'Utenti' created or already exists...<br>";
      } else {
        echo "Error creating 'Utenti' table: " . $conn->error . "<br>";
      }

      // Seconda query per Utente
      $secondStatement = $conn->prepare("INSERT INTO Utenti (Username, Nome, Cognome, Nickname, Email) VALUES (?, ?, ?, ?, ?)");
      $secondStatement->bind_param("sssss", $username, $nome, $cognome, $nickname, $email);

      // Esegui la query
      $secondStatement->execute();

      if ($secondStatement->affected_rows > 0) {
        echo "New Utente record created successfully<br>";
      } else {
        echo "Cannot insert record in Utente<br>";
      }

      $firstStatement->close();
      $secondStatement->close();
      $conn->close();
    }
  ?>
  </body>
</html>
