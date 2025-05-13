<?php

require '../dbConnection.php';

session_start();
$tableName = "leczenia";
$databaseName = "klinika";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        $conn = null;
        keepConnect($conn, $databaseName);
    
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
    
                selectTable($array, $tableName, $conn);
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
    
                addToTable($array, $tableName, $conn);
    
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
    
                deleteFromTable($array, $tableName, $conn);
    
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

        protocolGETLogin($conn, $databaseName);
    
        $insert = $delete = $update = $select = false;

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
