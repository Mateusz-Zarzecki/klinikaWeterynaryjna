<?php
    session_start();
    $databaseName = "klinika";

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $oldUsername = $_SESSION['username'];
        $oldPassword = $_SESSION['password'];
        $_SESSION['username'] = $_POST["username"] ?? $_SESSION['username'] ?? null;
        $_SESSION['password'] = $_POST["password"] ?? $_SESSION['password'] ?? null;
    
        if(!isset($_SESSION["logged"]))
        {
            $_SESSION["logged"] = false;
        }
    
        try {
            $conn = new mysqli("localhost", $_SESSION['username'], $_SESSION['password'], $databaseName);
            $conn->set_charset("utf8");
    
            if ($conn->connect_error) {
                throw new mysqli_sql_exception();
            }
            
            if(!$_SESSION["logged"] || $oldUsername!==$_SESSION['username'] || $oldPassword !== $_SESSION['password'])
            {
                $_SESSION["logged"] = true;
                header("Location: ?info=Zalogowano+pomyśnie");
                exit;
            }
        } catch (mysqli_sql_exception $e) {
            $_SESSION["logged"] = false;
            header("Location: ?info=Nie+udało+się+zalogować");
            exit;
        }
        catch (Exception $e) {
            $_SESSION["logged"] = false;
            header("Location: ?info=Nie+udało+się+zalogować");
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
                    <div class="controlButtons">
                        <input type="submit" id="logowanieSubmit" name="logowanieSubmit" value="Zaloguj">
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