<?php
session_start();
$tableName = "leczenia";
$databaseName = "klinika";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $conn = null;
    try {
        if (!empty($_SESSION['username']) && (!empty($_SESSION['password']) || $_SESSION['password']=="")) {
            $conn = new mysqli("localhost",  $_SESSION['username'], $_SESSION['password'], $databaseName);
            $conn->set_charset("utf8");
            if ($conn->connect_error) {
                throw new mysqli_sql_exception();
            }
        }
    } catch (mysqli_sql_exception $e) {
    } catch (Exception $e) {   
    }
    if($conn)
    {

        if(isset($_POST["wyswietlSubmit"])) {
            $idLeczenia         = $_POST["idLeczenia"]        ?? null;
            $idZwierzecia       = $_POST["idZwierzecia"]      ?? null;
            $dataRozpoczecia    = $_POST["dataRozpoczecia"]   ?? null;
            $dataZakonczenia    = $_POST["dataZakonczenia"]   ?? null;
            $opis               = $_POST["opis"]              ?? null;

            $array = [
                "idLeczenia" => $idLeczenia,
                "idZwierzecia" => $idZwierzecia,
                "dataRozpoczecia" => $dataRozpoczecia,
                "dataZakonczenia" => $dataZakonczenia,
                "opis" => $opis

            ];

            $selectConditions = [];

            foreach ($array as $key => $value) {
                if (!empty($value)) {
                    array_push($selectConditions, $key . "=" .(is_string($value) ? "'$value'" : $value));
                }
            }
            if (count($selectConditions) > 0) {

                $selectConditionsString = implode(" AND ", $selectConditions);
                $query = "SELECT * FROM $tableName WHERE $selectConditionsString";
                $_SESSION['table'] = $query;
            } else {
                $query = $query = "SELECT * FROM $tableName";
                $_SESSION['table'] = $query;
            }
            header("Location: ?info=Wyświetlono+lekarzy");
            exit;
        }
        if (isset($_POST["dodajSubmit"])) {
            $idZwierzecia       = $_POST["idZwierzecia"]      ?? null;
            $dataRozpoczecia    = $_POST["dataRozpoczecia"]   ?? null;
            $dataZakonczenia    = $_POST["dataZakonczenia"]   ?? null;
            $opis               = $_POST["opis"]              ?? null;

            $array = [
                "idZwierzecia" => $idZwierzecia,
                "dataRozpoczecia" => $dataRozpoczecia,
                "dataZakonczenia" => $dataZakonczenia,
                "opis" => $opis

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
                $query = "INSERT INTO $tableName ($colsString) VALUES ($valsString)";
                $conn->query($query);

                header("Location: ?info=Dodano+lekarza");
                exit;
            } else {
                header("Location: ?info=Brak+danych+do+dodania");
                exit;
            }

        } elseif (isset($_POST["usunSubmit"])) {
            $idLeczenia         = $_POST["idLeczenia"]        ?? null;
            $idZwierzecia       = $_POST["idZwierzecia"]      ?? null;
            $dataRozpoczecia    = $_POST["dataRozpoczecia"]   ?? null;
            $dataZakonczenia    = $_POST["dataZakonczenia"]   ?? null;
            $opis               = $_POST["opis"]              ?? null;

            $array = [
                "idLeczenia" => $idLeczenia,
                "idZwierzecia" => $idZwierzecia,
                "dataRozpoczecia" => $dataRozpoczecia,
                "dataZakonczenia" => $dataZakonczenia,
                "opis" => $opis

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
                $query = "DELETE FROM $tableName WHERE $where";
                $conn->query($query);
                header("Location: ?info=Usunięto+lekarza/y");
                exit;
            } else {
                header("Location: ?info=Brak+danych+do+usunięcia");
                exit;
            }

        } elseif (isset($_POST["zmienSubmit"])) {

            $idLeczenia         = $_POST["idLeczenia"]        ?? null;
            $idZwierzecia       = $_POST["idZwierzecia"]      ?? null;
            $dataRozpoczecia    = $_POST["dataRozpoczecia"]   ?? null;
            $dataZakonczenia    = $_POST["dataZakonczenia"]   ?? null;
            $opis               = $_POST["opis"]              ?? null;

            $idLeczeniaZmienione         = $_POST["idLeczeniaZmienione"]        ?? null;
            $idZwierzeciaZmienione       = $_POST["idZwierzeciaZmienione"]      ?? null;
            $dataRozpoczeciaZmienione    = $_POST["dataRozpoczeciaZmienione"]   ?? null;
            $dataZakonczeniaZmienione    = $_POST["dataZakonczeniaZmienione"]   ?? null;
            $opisZmienione               = $_POST["opisZmienione"]              ?? null;

            $whereArray = [
                "idLeczenia" => $idLeczenia,
                "idZwierzecia" => $idZwierzecia,
                "dataRozpoczecia" => $dataRozpoczecia,
                "dataZakonczenia" => $dataZakonczenia,
                "opis" => $opis

            ];
            $updateArray = [
                "idLeczenia" => $idLeczeniaZmienione,
                "idZwierzecia" => $idZwierzeciaZmienione,
                "dataRozpoczecia" => $dataRozpoczeciaZmienione,
                "dataZakonczenia" => $dataZakonczeniaZmienione,
                "opis" => $opisZmienione

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
                $query = "UPDATE $tableName SET $setString WHERE $whereString";
                $conn->query($query);
                header("Location: ?info=Zmieniono+dane+lekarzy+$query");
                exit;
            } else {
                header("Location: ?info=Brak+danych+do+zmiany+$sets+$conditions");
                exit;
            }
        }

        header("Location: ?info=Brak+operacji");
        exit;
    }
    header("Location: ?info=Błąd+połączenia+z+baza+danych");
    exit;
}

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Klinika Weterynaryjna</title>
    <link rel=stylesheet type="text/css" href="../../assets/stylesheets/navbar.css">
    <link rel=stylesheet type="text/css" href="../../assets/stylesheets/database-operations.css">
    <link rel=stylesheet type="text/css" href="../../assets/stylesheets/base.css"> 

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
        <h1>Leczenia</h1>
        <hr>
        <?php
        $conn = null;
        $loginStatus = $_SESSION['logged'] ?? null;
        if($loginStatus === false || is_null($loginStatus)) {
            header("Location: ../index.php?info=Nie zalogowano");
        }

        try {
            if (!empty($_SESSION['username']) && (!empty($_SESSION['password']) || $_SESSION['password']=="")) {
                $conn = new mysqli("localhost",  $_SESSION['username'], $_SESSION['password'], $databaseName);
                $conn->set_charset("utf8");
                if ($conn->connect_error) {
                    throw new mysqli_sql_exception();
                }
            }
        } catch (mysqli_sql_exception $e) {
        } catch (Exception $e) {   
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

        if ($conn && ($insert || $delete || $update || $select)) {
            echo <<< EOD
            <div class='main'>
                <div class="operacje">
                    <div class='przyciski'>
                        <input type='button' value='Wyświetl' onclick=showMenu('wyswietl')>
                        <input type='button' value='Dodaj' onclick=showMenu('dodaj')>
                        <input type='button' value='Usuń' onclick=showMenu('usun')>
                        <input type='button' value='Zmień' onclick=showMenu('edytuj')>
                    </div>
                <div class='opcjeMenu'>
            EOD;
            if($select)
            {
                echo <<<EOD
                <div class="wyswietl">
                    <h2>Wyświetl</h2>
                    <p>Dane leczenia/leczeń do wyświetlenia</p>
                    <form action="?" method="post">
                        <label for="idLeczenia">Id Leczenia: </label>
                        <input type="number" id="idLeczenia" name="idLeczenia"><br>
                        <label for="idZwierzecia">Id Zwierzecia: </label>
                        <input type="number" id="idZwierzecia" name="idZwierzecia"><br>
                        <label for="dataRozpoczecia">Data Rozpoczecia: </label>
                        <input type="text" id="dataRozpoczecia" name="dataRozpoczecia"><br>
                        <label for="dataZakonczenia">Data Zakonczenia: </label>
                        <input type="text" id="dataZakonczenia" name="dataZakonczenia"><br>
                        <label for="opis">Opis: </label>
                        <input type="text" id="opis" name="opis"><br><br>
                        <div class="controlButtons">
                            <input type="submit" name="wyswietlSubmit" value="Zastosuj">
                            <input type="reset" value="Wyczyść">
                        </div>
                    </form>
                </div>
                EOD;
            }
            if ($insert) {
                echo <<<EOD
                <div class="dodaj">
                    <h2>Dodaj</h2>
                    <p>Dane zwierzecia do dodania</p>
                    <form action="?" method="post">
                        <label for="idZwierzecia">Id Zwierzecia: </label>
                        <input type="number" id="idZwierzecia" name="idZwierzecia"><br>
                        <label for="dataRozpoczecia">Data Rozpoczecia: </label>
                        <input type="text" id="dataRozpoczecia" name="dataRozpoczecia"><br>
                        <label for="dataZakonczenia">Data Zakonczenia: </label>
                        <input type="text" id="dataZakonczenia" name="dataZakonczenia"><br>
                        <label for="opis">Opis: </label>
                        <input type="text" id="opis" name="opis"><br><br>
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
                    <p>Dane zwierzęcia / zwierząt do usunięcia</p>
                    <form action="?" method="post">
                        <label for="idLeczenia">Id Leczenia: </label>
                        <input type="number" id="idLeczenia" name="idLeczenia"><br>
                        <label for="idZwierzecia">Id Zwierzecia: </label>
                        <input type="number" id="idZwierzecia" name="idZwierzecia"><br>
                        <label for="dataRozpoczecia">Data Rozpoczecia: </label>
                        <input type="text" id="dataRozpoczecia" name="dataRozpoczecia"><br>
                        <label for="dataZakonczenia">Data Zakonczenia: </label>
                        <input type="text" id="dataZakonczenia" name="dataZakonczenia"><br>
                        <label for="opis">Opis: </label>
                        <input type="text" id="opis" name="opis"><br><br>
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
                    <p>Dane zwierzęcia / zwierząt do zmiany</p>
                    <form action="?" method="post">
                        <label for="idLeczenia">Id Leczenia: </label>
                        <input type="number" id="idLeczenia" name="idLeczenia"><br>
                        <label for="idZwierzecia">Id Zwierzecia: </label>
                        <input type="number" id="idZwierzecia" name="idZwierzecia"><br>
                        <label for="dataRozpoczecia">Data Rozpoczecia: </label>
                        <input type="text" id="dataRozpoczecia" name="dataRozpoczecia"><br>
                        <label for="dataZakonczenia">Data Zakonczenia: </label>
                        <input type="text" id="dataZakonczenia" name="dataZakonczenia"><br>
                        <label for="opis">Opis: </label>
                        <input type="text" id="opis" name="opis"><br>
                        <p>Nowe dane</p>
                        <label for="idZwierzeciaZmienione">Id Zwierzecia: </label>
                        <input type="number" id="idZwierzeciaZmienione" name="idZwierzeciaZmienione"><br>
                        <label for="dataRozpoczeciaZmienione">Data Rozpoczecia: </label>
                        <input type="text" id="dataRozpoczeciaZmienione" name="dataRozpoczeciaZmienione"><br>
                        <label for="dataZakonczeniaZmienione">Data Zakonczenia: </label>
                        <input type="text" id="dataZakonczeniaZmienione" name="dataZakonczeniaZmienione"><br>
                        <label for="opisZmienione">Opis: </label>
                        <input type="text" id="opisZmienione" name="opisZmienione"><br><br>
                        <div class="controlButtons">
                            <input type="submit" name="zmienSubmit" value="Zastosuj">
                            <input type="reset" value="Wyczyść">
                        </div>
                    </form>
                </div>
                EOD;
            }
            echo '</div></div>';
        }

        if ($conn) {
            if ($select) {
                echo '<div class="tabela">'.
                '<div class="table-border">';
                $query = ($_SESSION['table'] ?? null) ?? "SELECT * FROM $tableName";
                $result = $conn->query($query);
                if (!$result) {
                    die("MySQL Error");
                }

                echo '<table>'.
                '<thead>'.
                '<tr>';
                while($fieldinfo = $result->fetch_field()) {
                    echo '<th>' . $fieldinfo->name . '</th>';
                }
                echo '</tr>';
                echo '</thead>';

                while($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    foreach($row as $cell) {
                        echo '<td>' . $cell . '</td>';
                    }
                    echo '</tr>';
                }
                echo '</table>'.
                '</div>'.
                '</div>';
            }
            $conn->close();
        }
        echo "</div>";
        ?>
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

    function showMenu(className)
    {
        let menus = document.getElementsByClassName('opcjeMenu')[0];
        for(var i=0; i< menus.childNodes.length;i++)
        {
            menus.childNodes[i].style.display = "none";
        
        }
        let menu = document.getElementsByClassName(className)[0];
        menu.style.display = "block";
    }

    window.onload = function() {
        let params = new URLSearchParams(window.location.search);
        if (params.has('info')) {
            alert(params.get('info'));
        }
    };
</script>
</body>
</html>
