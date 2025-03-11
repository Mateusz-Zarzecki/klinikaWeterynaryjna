<?php
    session_start();
    $databaseName = "klinika";

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $oldUsername = $_SESSION['username'] ?? null;
        $oldPassword = $_SESSION['password'] ?? null;
        $_SESSION['username'] = $_POST["username"] ?? $_SESSION['username'] ?? null;
        $_SESSION['password'] = $_POST["password"] ?? $_SESSION['password'] ?? null;
        $_SESSION['userId'] = $_SESSION['userId'] ?? null;

        if(!isset($_SESSION["logged"]))
        {
            $_SESSION["logged"] = false;
        }
    
        try {
            $conn = new mysqli("localhost", 'root', '', $databaseName);
            $conn->set_charset("utf8");
            
            if(isset($_POST['logowanieSubmit'])) {
                $authorizationQuery = "SELECT UserId FROM USERS WHERE username = '" . $_SESSION['username'] . "' AND password = '" . $_SESSION['password'] . "' ";
                $result = $conn->query($authorizationQuery);
    
                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $_SESSION['userId'] = strval($row['UserId']);
                    }
                } else {
                    $_SESSION['userId'] = null;
                }
    
    
                if ($conn->connect_error || empty($_SESSION['userId'])) {
                    throw new mysqli_sql_exception();
                }
                
                if(!$_SESSION["logged"] || $oldUsername!==$_SESSION['username'] || $oldPassword !== $_SESSION['password'])
                {
                    $_SESSION["logged"] = true;
                    header("Location: ?info=Zalogowano+pomyśnie" . $_SESSION['userId'] . $_SESSION['username'] . " " . $_SESSION['password']);
                    exit;
                }
            } elseif (isset($_POST['rejestacjaSubmit'])) {
                $authorizationQuery = "SELECT UserId FROM USERS WHERE username = '" . $_SESSION['username'] . "'";
                $result = $conn->query($authorizationQuery);
                if($result->num_rows == 0) {
                    $addQuery = "INSERT INTO USERS (Username, Password) VALUES ('" . $_SESSION['username'] . "', '" . $_SESSION['password'] . "')";
                    $conn->query($addQuery);
                    
                    $idQuery = "SELECT UserId FROM USERS WHERE username = '" . $_SESSION['username'] . "' AND password = '" . $_SESSION['password'] . "' ";
                    $id = $conn->query($idQuery);
            
                    if($id->num_rows > 0) {
                        while($row = $id->fetch_assoc()) {
                            $_SESSION['userId'] = strval($row['UserId']);
                        }
                        $privilegeQuery = "INSERT INTO PRIVILEGES (UserId, Privilege) VALUES (" . $_SESSION['userId'] . ", 'all')";
                        $conn->query($privilegeQuery);
                    }


                }
            }
            
        } catch (mysqli_sql_exception $e) {
            header("Location: ?info=Nie+udało+się+zalogować".$authorizationQuery);
            $_SESSION["logged"] = false;
            exit;
        }
        catch (Exception $e) {
            header("Location: ?info=Nie+udało+się+zalogować");
            $_SESSION["logged"] = false;
            exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinika Weterynaryjna</title>
    <link rel=stylesheet type="text/css" href="../assets/stylesheets/navbar.css">
    <link rel=stylesheet type="text/css" href="../assets/stylesheets/login-panel.css">
    <link rel=stylesheet type="text/css" href="../assets/stylesheets/base.css">

</head>
<body>
    <div class=app>
        <div class="menu-toggle">
            <div class="hamburger">
                <span></span>
            </div>
        </div>
        <aside class=sidebar>
            <h3>Menu</h3>
            <nav class=menu>
                <a href="" class="menu-item is-active">Home</a>
                <a href="subpages/animals.php" class="menu-item">Zwierzęta</a>
                <a href="subpages/owners.php" class="menu-item">Właściciele</a>
                <a href="subpages/appointments.php" class="menu-item">Wizyty</a>
                <a href="subpages/surgeries.php" class="menu-item">Zabiegi</a>
                <a href="subpages/treatments.php" class="menu-item">Leczenia</a>
                <a href="subpages/doctors.php" class="menu-item">Lekarze</a>
                <a href="subpages/prescriptions.php" class="menu-item">Recepty</a>
                <a href="subpages/medicines.php" class="menu-item">Leki</a>

            </nav>
        </aside>
        <main class="content">
            <h1>Klinika Weterynaryjna</h1>
            <hr>
            <div class="logowanie">
                <h2>Zaloguj się</h2>
                <form action="?" method="post" id="logowanie">
                    <label for="username">Username: </label>
                    <input type="text" id="username" name="username" value="<?php echo $_SESSION['username'] ?? ''; ?>">
                    <br>
                    <label for="password">Password: </label>
                    <input type="text" id="password" name="password" value="<?php echo $_SESSION['password'] ?? ''; ?>">
                    <div class="controlButtons firstInput">
                        <input type="submit" id="logowanieSubmit" name="logowanieSubmit" value="Zaloguj">
                    </div>
                    <div class="controlButtons">
                        <input type="submit" id="rejestacjaSubmit" name="rejestacjaSubmit" value="Zarejestruj się">
                    </div>
                </form>
            </div>
            <hr>
        </main>
    </div>
    <script>
        const menu_toggle = document.querySelector('.menu-toggle');
        const sidebar = document.querySelector('.sidebar');

        menu_toggle.addEventListener('click', () => {
            menu_toggle.classList.toggle('is-active');
            sidebar.classList.toggle('is-active');
        })
    </script>
</body>
</html>