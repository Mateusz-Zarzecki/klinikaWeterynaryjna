<?php

require '../dbConnection.php';

session_start();
$tableName = "zwierzeta";
$databaseName = "klinika";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        $conn = null;
        keepConnect($conn, $databaseName);
        if($conn)
        {
            if(isset($_POST["wyswietlSubmit"])) {
                $idZwierzecia = $_POST["idZwierzecia"]?? null;
                $imie         = $_POST["imie"]        ?? null;
                $gatunek      = $_POST["gatunek"]     ?? null;
                $rasa         = $_POST["rasa"]        ?? null;
                $dob          = $_POST["dob"]         ?? null;
                $plec         = $_POST["plec"]        ?? null;
        
                $array = [
                    "idZwierzecia" => $idZwierzecia,
                    "imie" => $imie,
                    "gatunek" => $gatunek,
                    "rasa" => $rasa,
                    "dob" => $dob,
                    "plec" => $plec
                ];
        
                selectTable($array, $tableName, $conn);
            }
            if (isset($_POST["dodajSubmit"])) {
                $imie         = $_POST["imie"]        ?? null;
                $gatunek      = $_POST["gatunek"]     ?? null;
                $rasa         = $_POST["rasa"]        ?? null;
                $dob          = $_POST["dob"]         ?? null;
                $plec         = $_POST["plec"]        ?? null;
        
                $array = [
                    "imie" => $imie,
                    "gatunek" => $gatunek,
                    "rasa" => $rasa,
                    "dob" => $dob,
                    "plec" => $plec
                ];
        
                addToTable($array, $tableName, $conn);
        
            } elseif (isset($_POST["usunSubmit"])) {
                $idZwierzecia        = $_POST["idZwierzecia"] ?? null;
                $imie                = $_POST["imie"]         ?? null;
                $gatunek             = $_POST["gatunek"]      ?? null;
                $rasa                = $_POST["rasa"]         ?? null;
                $dob                 = $_POST["dob"]          ?? null;
                $plec                = $_POST["plec"]         ?? null;
        
                $array = [
                    "idZwierzecia" => $idZwierzecia,
                    "imie" => $imie,
                    "gatunek" => $gatunek,
                    "rasa" => $rasa,
                    "dob" => $dob,
                    "plec" => $plec
                ];
        
                deleteFromTable($array, $tableName, $conn);
        
            } elseif (isset($_POST["zmienSubmit"])) {
                $idZwierzecia        = $_POST["idZwierzecia"] ?? null;
                $imie                = $_POST["imie"]         ?? null;
                $gatunek             = $_POST["gatunek"]      ?? null;
                $rasa                = $_POST["rasa"]         ?? null;
                $dob                 = $_POST["dob"]          ?? null;
                $plec                = $_POST["plec"]         ?? null;
        
                $imieZmienione        = $_POST["imieZmienione"]        ?? null;
                $gatunekZmienione     = $_POST["gatunekZmienione"]     ?? null;
                $rasaZmienione        = $_POST["rasaZmienione"]        ?? null;
                $dobZmienione         = $_POST["dobZmienione"]         ?? null;
                $plecZmienione        = $_POST["plecZmienione"]        ?? null;
        
                $whereArray = [
                    "idZwierzecia" => $idZwierzecia,
                    "imie" => $imie,
                    "gatunek" => $gatunek,
                    "rasa" => $rasa,
                    "dob" => $dob,
                    "plec" => $plec
                ];
        
                $updateArray = [
                    "imie" => $imieZmienione,
                    "gatunek" => $gatunekZmienione,
                    "rasa" => $rasaZmienione,
                    "dob" => $dobZmienione,
                    "plec" => $plecZmienione
                ];
        
                updateTable($updateArray, $whereArray,$tableName, $conn);
            }
        
            header("Location: ?info=Brak+operacji");
            exit;
        }
        header("Location: ?info=Błąd+połączenia+z+baza+danych");
        exit;
    }
    catch(Exception $e) {
        
    }
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
            <input type=button id=tablesMenu class="menu-item main-menu" value="Tablice" onclick="tablesMenu()">
            <div id="tableSubmenu">
                <a href="../index.php" class="menu-item">Home</a>
                <a href="animals.php" class="menu-item is-active">Zwierzęta</a>
                <a href="owners.php" class="menu-item">Właściciele</a>
                <a href="appointments.php" class="menu-item">Wizyty</a>
                <a href="surgeries.php" class="menu-item">Zabiegi</a>
                <a href="treatments.php" class="menu-item">Leczenia</a>
                <a href="doctors.php" class="menu-item">Lekarze</a>
                <a href="prescriptions.php" class="menu-item">Recepty</a>
                <a href="medicines.php" class="menu-item">Leki</a>
            </div>
            <input type=button id=raportsMenu class="menu-item main-menu" value="Raporty" onclick="raportsMenu()">
            <div id=raportSubmenu>
            </div>
        </nav>
    </aside>
    <main class="content">
        <h1>Zwierzęta</h1>
        <hr>
        <?php
        $conn = null;

        protocolGETLogin($conn, $databaseName);
    
        $insert = $delete = $update = false;
        $select = true;

        getPrivileges($conn, $insert, $delete, $update, $select);

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
                    <p>Dane zwierzęcia / zwierząt do wyświetlenia</p>
                    <form action="?" method="post">
                        <label for="idZwierzecia">Id: </label>
                        <input type="number" id="idZwierzecia" name="idZwierzecia"><br>
                        <label for="imie">Imię: </label>
                        <input type="text" id="imie" name="imie"><br>
                        <label for="gatunek">Gatunek: </label>
                        <input type="text" id="gatunek" name="gatunek"><br>
                        <label for="rasa">Rasa: </label>
                        <input type="text" id="rasa" name="rasa"><br>
                        <label for="dob">Data Urodzenia: </label>
                        <input type="date" id="dob" name="dob"><br>
                        <label for="plec">Płeć: </label>
                        <input type="text" id="plec" name="plec"><br><br>
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
                        <label for="imie">Imię: </label>
                        <input type="text" id="imie" name="imie"><br>
                        <label for="gatunek">Gatunek: </label>
                        <input type="text" id="gatunek" name="gatunek"><br>
                        <label for="rasa">Rasa: </label>
                        <input type="text" id="rasa" name="rasa"><br>
                        <label for="dob">Data Urodzenia: </label>
                        <input type="date" id="dob" name="dob"><br>
                        <label for="plec">Płeć: </label>
                        <input type="text" id="plec" name="plec"><br><br>
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
                        <label for="idZwierzecia">Id: </label>
                        <input type="number" id="idZwierzecia" name="idZwierzecia"><br>
                        <label for="imie">Imię: </label>
                        <input type="text" id="imie" name="imie"><br>
                        <label for="gatunek">Gatunek: </label>
                        <input type="text" id="gatunek" name="gatunek"><br>
                        <label for="rasa">Rasa: </label>
                        <input type="text" id="rasa" name="rasa"><br>
                        <label for="dob">Data Urodzenia: </label>
                        <input type="date" id="dob" name="dob"><br>
                        <label for="plec">Płeć: </label>
                        <input type="text" id="plec" name="plec"><br><br>
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
                        <label for="idZwierzecia">Id: </label>
                        <input type="number" id="idZwierzecia" name="idZwierzecia"><br>
                        <label for="imie">Imię: </label>
                        <input type="text" id="imie" name="imie"><br>
                        <label for="gatunek">Gatunek: </label>
                        <input type="text" id="gatunek" name="gatunek"><br>
                        <label for="rasa">Rasa: </label>
                        <input type="text" id="rasa" name="rasa"><br>
                        <label for="dob">Data Urodzenia: </label>
                        <input type="date" id="dob" name="dob"><br>
                        <label for="plec">Płeć: </label>
                        <input type="text" id="plec" name="plec"><br><br>
                        <p>Nowe dane</p>
                        <label for="imieZmienione">Imię: </label>
                        <input type="text" id="imieZmienione" name="imieZmienione"><br>
                        <label for="gatunekZmienione">Gatunek: </label>
                        <input type="text" id="gatunekZmienione" name="gatunekZmienione"><br>
                        <label for="rasaZmienione">Rasa: </label>
                        <input type="text" id="rasaZmienione" name="rasaZmienione"><br>
                        <label for="dobZmienione">Data Urodzenia: </label>
                        <input type="date" id="dobZmienione" name="dobZmienione"><br>
                        <label for="plecZmienione">Płeć: </label>
                        <input type="text" id="plecZmienione" name="plecZmienione"><br><br>
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
                displayTable($tableName, $conn);
            }
            $conn->close();
        }
        echo "</div>";
        ?>
        <hr>

</main>

</div>
<script src=../script.js></script>
</body>
</html>
