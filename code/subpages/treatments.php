<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $oldUsername = $_SESSION['username'];
    $oldPassword = $_SESSION['password'];
    $_SESSION['username'] = $_POST["username"] ?? $_SESSION['username'] ?? null;
    $_SESSION['password'] = $_POST["password"] ?? $_SESSION['password'] ?? null;

    if(!isset($_SESSION["logged"]))
    {
        $_SESSION["logged"] = false;
    }

    try {
        $conn = new mysqli("localhost", $_SESSION['username'], $_SESSION['password'], "sks");
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
        header("Location: ?info=Nie+udało+się+zalogować");
        $_SESSION["logged"] = false;
        exit;
    }

    if (isset($_POST["dodajSubmit"])) {
        $imie         = $_POST["imie"]         ?? null;
        $nazwisko     = $_POST["nazwisko"]     ?? null;
        $klasa        = $_POST["klasa"]        ?? null;
        $rokurodzenia = $_POST["rokurodzenia"] ?? null;
        $wzrost       = $_POST["wzrost"]       ?? null;

        $array = [
            "imie" => $imie,
            "nazwisko" => $nazwisko,
            "klasa" => $klasa,
            "rokurodzenia" => $rokurodzenia,
            "wzrost" => $wzrost
        ];

        $insertCols = [];
        $insertVals = [];

        foreach ($array as $key => $value) {
            if (!empty($value)) {
                $insertCols[] = $key;
                $insertVals[] = is_string($value) ? "'$value'" : $value;
            }
        }

        if (count($insertCols) > 0) {
            $colsString = implode(", ", $insertCols);
            $valsString = implode(", ", $insertVals);
            $query = "INSERT INTO zawodnicy ($colsString) VALUES ($valsString)";
            $conn->query($query);

            header("Location: ?info=Dodano+zawodnika");
            exit;
        } else {
            header("Location: ?info=Brak+danych+do+dodania");
            exit;
        }

    } elseif (isset($_POST["usunSubmit"])) {
        $id           = $_POST["id"]           ?? null;
        $imie         = $_POST["imie"]         ?? null;
        $nazwisko     = $_POST["nazwisko"]     ?? null;
        $klasa        = $_POST["klasa"]        ?? null;
        $rokurodzenia = $_POST["rokurodzenia"] ?? null;
        $wzrost       = $_POST["wzrost"]       ?? null;

        $array = [
            "id" => $id,
            "imie" => $imie,
            "nazwisko" => $nazwisko,
            "klasa" => $klasa,
            "rokurodzenia" => $rokurodzenia,
            "wzrost" => $wzrost
        ];

        $conditions = [];
        foreach ($array as $key => $value) {
            if (!empty($value)  || $value === '0') {
                $val = is_string($value) ? "'$value'" : $value;
                $conditions[] = "$key = $val";
            }
        }

        if (count($conditions) > 0) {
            $where = implode(" AND ", $conditions);
            $query = "DELETE FROM zawodnicy WHERE $where";
            $conn->query($query);
            header("Location: ?info=Usunięto+zawodnika(ów)");
            exit;
        } else {
            header("Location: ?info=Brak+danych+do+usunięcia");
            exit;
        }

    } elseif (isset($_POST["zmienSubmit"])) {
        $id           = $_POST["id"]           ?? null;
        $imie         = $_POST["imie"]         ?? null;
        $nazwisko     = $_POST["nazwisko"]     ?? null;
        $klasa        = $_POST["klasa"]        ?? null;
        $rokurodzenia = $_POST["rokurodzenia"] ?? null;
        $wzrost       = $_POST["wzrost"]       ?? null;

        $imieZmienione         = $_POST["imieZmienione"]         ?? null;
        $nazwiskoZmienione     = $_POST["nazwiskoZmienione"]     ?? null;
        $klasaZmienione        = $_POST["klasaZmienione"]        ?? null;
        $rokurodzeniaZmienione = $_POST["rokurodzeniaZmienione"] ?? null;
        $wzrostZmienione       = $_POST["wzrostZmienione"]       ?? null;

        $whereArray = [
            "id" => $id,
            "imie" => $imie,
            "nazwisko" => $nazwisko,
            "klasa" => $klasa,
            "rokurodzenia" => $rokurodzenia,
            "wzrost" => $wzrost
        ];

        $updateArray = [
            "imie" => $imieZmienione,
            "nazwisko" => $nazwiskoZmienione,
            "klasa" => $klasaZmienione,
            "rokurodzenia" => $rokurodzeniaZmienione,
            "wzrost" => $wzrostZmienione
        ];

        $sets = [];
        foreach ($updateArray as $key => $val) {
            if (!empty($val)  || $val === '0') {
                $val = is_string($val) ? "'$val'" : $val;
                $sets[] = "$key = $val";
            }
        }

        $conditions = [];
        foreach ($whereArray as $key => $val) {
            if (!empty($val)  || $val === '0') {
                $val = is_string($val) ? "'$val'" : $val;
                $conditions[] = "$key = $val";
            }
        }

        if (count($sets) > 0 && count($conditions) > 0) {
            $setString = implode(", ", $sets);
            $whereString = implode(" AND ", $conditions);
            $query = "UPDATE zawodnicy SET $setString WHERE $whereString";
            $conn->query($query);
            header("Location: ?info=Zmieniono+dane+zawodnika");
            exit;
        } else {
            header("Location: ?info=Brak+danych+do+zmiany");
            exit;
        }
    }

    header("Location: ?info=Brak+operacji");
    exit;
}

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Sks - Zawodnicy</title>
    <link rel=stylesheet type="text/css" href="../../assets/stylesheets/navbar.css">
    <link rel=stylesheet type="text/css" href="../../assets/stylesheets/database-operations.css">

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
                <a href="../index.php" class="menu-item">Home</a>
                <a href="animals.php" class="menu-item">Zwierzęta</a>
                <a href="owners.php" class="menu-item">Właściciele</a>
                <a href="appointments.php" class="menu-item">Wizyty</a>
                <a href="surgeries.php" class="menu-item">Zabiegi</a>
                <a href="treatments.php" class="menu-item is-active">Leczenia</a>
                <a href="doctors.php" class="menu-item">Lekarze</a>
                <a href="prescriptions.php" class="menu-item">Recepty</a>
                <a href="medicines.php" class="menu-item">Leki</a>

        </nav>
    </aside>
    <main class="content">
        <h1>Sks Zawodnicy</h1>
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

        <?php
        $conn = null;
        try {
            if (!empty($_SESSION['username']) && !empty($_SESSION['password'])) {
                $conn = new mysqli("localhost", $_SESSION['username'], $_SESSION['password'], "sks");
                $conn->set_charset("utf8");
                if ($conn->connect_error) {
                    throw new mysqli_sql_exception();
                }
            }
        } catch (mysqli_sql_exception $e) {
        }

        $insert = $delete = $update = $select = false;

        if ($conn) {
            $query = "SELECT privilege FROM PRIVILEGES WHERE username = '" . $_SESSION['username'] . "'";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                $priv = strtolower($row["privilege"]);
                if ($priv === "select") $select = true;
                if ($priv === "insert") $insert = true;
                if ($priv === "delete") $delete = true;
                if ($priv === "update") $update = true;
                if ($priv === "all") {
                    $insert = $delete = $update = $select = true;
                }
            }
        }

        if ($conn && ($insert || $delete || $update)) {
            echo '<div class="gora">';
            if ($insert) {
                echo <<<EOD
                <div class="dodaj">
                    <h2>Dodaj</h2>
                    <p>Dane zawodnika do dodania</p>
                    <form action="?" method="post">
                        <label for="imie">Imię: </label>
                        <input type="text" id="imie" name="imie"><br>
                        <label for="nazwisko">Nazwisko: </label>
                        <input type="text" id="nazwisko" name="nazwisko"><br>
                        <label for="klasa">Klasa: </label>
                        <input type="number" id="klasa" name="klasa"><br>
                        <label for="rokurodzenia">Rok Urodzenia: </label>
                        <input type="number" id="rokurodzenia" name="rokurodzenia"><br>
                        <label for="wzrost">Wzrost: </label>
                        <input type="number" id="wzrost" name="wzrost"><br><br>
                        <div class="controlButtons">
                            <input type="submit" name="dodajSubmit" value="Zastosuj">
                            <input type="reset" value="Wyczyść">
                        </div>
                    </form>
                </div>
                EOD;
            }

            if ($delete) {
                echo <<<EOD
                <div class="usun">
                    <h2>Usuń</h2>
                    <p>Dane zawodnika(ów) do usunięcia</p>
                    <form action="?" method="post">
                        <label for="id">Id: </label>
                        <input type="number" id="id" name="id"><br>
                        <label for="imie">Imię: </label>
                        <input type="text" id="imie" name="imie"><br>
                        <label for="nazwisko">Nazwisko: </label>
                        <input type="text" id="nazwisko" name="nazwisko"><br>
                        <label for="klasa">Klasa: </label>
                        <input type="number" id="klasa" name="klasa"><br>
                        <label for="rokurodzenia">Rok Urodzenia: </label>
                        <input type="number" id="rokurodzenia" name="rokurodzenia"><br>
                        <label for="wzrost">Wzrost: </label>
                        <input type="number" id="wzrost" name="wzrost"><br><br>
                        <div class="controlButtons">
                            <input type="submit" name="usunSubmit" value="Zastosuj">
                            <input type="reset" value="Wyczyść">
                        </div>
                    </form>
                </div>
                EOD;
            }

            if ($update) {
                echo <<<EOD
                <div class="edytuj">
                    <h2>Zmień</h2>
                    <p>Dane zawodnika(ów) do zmiany</p>
                    <form action="?" method="post">
                        <label for="id">Id: </label>
                        <input type="number" id="id" name="id"><br>
                        <label for="imie">Imię: </label>
                        <input type="text" id="imie" name="imie"><br>
                        <label for="nazwisko">Nazwisko: </label>
                        <input type="text" id="nazwisko" name="nazwisko"><br>
                        <label for="klasa">Klasa: </label>
                        <input type="number" id="klasa" name="klasa"><br>
                        <label for="rokurodzenia">Rok Urodzenia: </label>
                        <input type="number" id="rokurodzenia" name="rokurodzenia"><br>
                        <label for="wzrost">Wzrost: </label>
                        <input type="number" id="wzrost" name="wzrost"><br>
                        <p>Nowe dane</p>
                        <label for="imieZmienione">Imię: </label>
                        <input type="text" id="imieZmienione" name="imieZmienione"><br>
                        <label for="nazwiskoZmienione">Nazwisko: </label>
                        <input type="text" id="nazwiskoZmienione" name="nazwiskoZmienione"><br>
                        <label for="klasaZmienione">Klasa: </label>
                        <input type="number" id="klasaZmienione" name="klasaZmienione"><br>
                        <label for="rokurodzeniaZmienione">Rok Urodzenia: </label>
                        <input type="number" id="rokurodzeniaZmienione" name="rokurodzeniaZmienione"><br>
                        <label for="wzrostZmienione">Wzrost: </label>
                        <input type="number" id="wzrostZmienione" name="wzrostZmienione"><br><br>
                        <div class="controlButtons">
                            <input type="submit" name="zmienSubmit" value="Zastosuj">
                            <input type="reset" value="Wyczyść">
                        </div>
                    </form>
                </div>
                EOD;
            }
            echo '</div>';
        }

        if ($conn) {
            if ($select) {
                echo '<hr><div class="wyswietl">';
                $query = "SELECT * FROM zawodnicy";
                $result = $conn->query($query);
                if (!$result) {
                    die("MySQL Error");
                }

                echo '<table border="1">';
                echo '<tr>';
                while($fieldinfo = $result->fetch_field()) {
                    echo '<th>' . $fieldinfo->name . '</th>';
                }
                echo '</tr>';

                while($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    foreach($row as $cell) {
                        echo '<td>' . $cell . '</td>';
                    }
                    echo '</tr>';
                }
                echo '</table>';
                echo '</div>';
            }
            $conn->close();
        }
        ?>
</main>
</div>

<script>
    const menu_toggle = document.querySelector('.menu-toggle');
    const sidebar = document.querySelector('.sidebar');

    menu_toggle.addEventListener('click', () => {
        menu_toggle.classList.toggle('is-active');
        sidebar.classList.toggle('is-active');
    })

    //info alert

    window.onload = function() {
        let params = new URLSearchParams(window.location.search);
        if (params.has('info')) {
            alert(params.get('info'));
        }
    };
</script>
</body>
</html>
