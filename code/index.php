<?php
require "dbConnection.php";

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
                login($conn);
            } elseif (isset($_POST['rejestacjaSubmit'])) {
                register($conn);
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
                <input type=button id=tablesMenu class="menu-item main-menu" value="Tablice" onclick="tablesMenu()">
                <div id="tableSubmenu">
                    <a href="" class="menu-item is-active">Home</a>
                    <a href="subpages/animals.php" class="menu-item">Zwierzęta</a>
                    <a href="subpages/owners.php" class="menu-item">Właściciele</a>
                    <a href="subpages/appointments.php" class="menu-item">Wizyty</a>
                    <a href="subpages/surgeries.php" class="menu-item">Zabiegi</a>
                    <a href="subpages/treatments.php" class="menu-item">Leczenia</a>
                    <a href="subpages/doctors.php" class="menu-item">Lekarze</a>
                    <a href="subpages/prescriptions.php" class="menu-item">Recepty</a>
                    <a href="subpages/medicines.php" class="menu-item">Leki</a>
                </div>
                <input type=button id=raportsMenu class="menu-item main-menu" value="Raporty" onclick="raportsMenu()">
                <div id=raportSubmenu>
                    <a href="" class="menu-item is-active">Home</a>
                    <a href="subpages/animals.php" class="menu-item">Zwierzęta</a>
                    <a href="subpages/owners.php" class="menu-item">Właściciele</a>
                    <a href="subpages/appointments.php" class="menu-item">Wizyty</a>
                    <a href="subpages/surgeries.php" class="menu-item">Zabiegi</a>
                    <a href="subpages/treatments.php" class="menu-item">Leczenia</a>
                    <a href="subpages/doctors.php" class="menu-item">Lekarze</a>
                    <a href="subpages/prescriptions.php" class="menu-item">Recepty</a>
                    <a href="subpages/medicines.php" class="menu-item">Leki</a>
                </div>
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
    <script src="script.js"></script>
    <!-- <script>
        const menu_toggle = document.querySelector('.menu-toggle');
        const sidebar = document.querySelector('.sidebar');

        menu_toggle.addEventListener('click', () => {
            menu_toggle.classList.toggle('is-active');
            sidebar.classList.toggle('is-active');

        
        })
    </script> -->
</body>
</html>
