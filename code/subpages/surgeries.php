<?php

require '../dbConnection.php';

session_start();
$tableName = "zabiegi";
$databaseName = "klinika";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $conn = null;
    keepConnect($conn, $databaseName);

    try {
        if($conn)
        {
    
            if(isset($_POST["wyswietlSubmit"])) {
                $idZabiegu         = $_POST["idZabiegu"]       ?? null;
                $idZwierzecia      = $_POST["idZwierzecia"]    ?? null;
                $dataZabiegu       = $_POST["dataZabiegu"]     ?? null;
                $nazwa             = $_POST["nazwa"]           ?? null;
                $stanZwierzecia    = $_POST["stanZwierzecia"]  ?? null;
                $opisZabiegu       = $_POST["opisZabiegu"]     ?? null;
                $status            = $_POST["status"]          ?? null;
                $cenaZabiegu       = $_POST["cenaZabiegu"]      ?? null;
    
                $array = [
                    "idZabiegu" => $idZabiegu,
                    "idZwierzecia" => $idZwierzecia,
                    "dataZabiegu" => $dataZabiegu,
                    "nazwa" => $nazwa,
                    "stanZwierzecia" => $stanZwierzecia,
                    "opisZabiegu" => $opisZabiegu,
                    "status" => $status,
                    "cenaZabiegu" => $cenaZabiegu
    
                ];
    
                selectTable($array, $tableName, $conn);
            }
            if (isset($_POST["dodajSubmit"])) {
                $idZwierzecia      = $_POST["idZwierzecia"]    ?? null;
                $dataZabiegu       = $_POST["dataZabiegu"]     ?? null;
                $nazwa             = $_POST["nazwa"]           ?? null;
                $stanZwierzecia    = $_POST["stanZwierzecia"]  ?? null;
                $opisZabiegu       = $_POST["opisZabiegu"]     ?? null;
                $status            = $_POST["status"]          ?? null;
                $cenaZabiegu       = $_POST["cenaZabiegu"]      ?? null;
    
                $array = [
                    "idZwierzecia" => $idZwierzecia,
                    "dataZabiegu" => $dataZabiegu,
                    "nazwa" => $nazwa,
                    "stanZwierzecia" => $stanZwierzecia,
                    "opisZabiegu" => $opisZabiegu,
                    "status" => $status,
                    "cenaZabiegu" => $cenaZabiegu
    
                ];
    
                addToTable($array, $tableName, $conn);
    
            } elseif (isset($_POST["usunSubmit"])) {
                $idZabiegu         = $_POST["idZabiegu"]       ?? null;
                $idZwierzecia      = $_POST["idZwierzecia"]    ?? null;
                $dataZabiegu       = $_POST["dataZabiegu"]     ?? null;
                $nazwa             = $_POST["nazwa"]           ?? null;
                $stanZwierzecia    = $_POST["stanZwierzecia"]  ?? null;
                $opisZabiegu       = $_POST["opisZabiegu"]     ?? null;
                $status            = $_POST["status"]          ?? null;
                $cenaZabiegu       = $_POST["cenaZabiegu"]      ?? null;
    
                $array = [
                    "idZabiegu" => $idZabiegu,
                    "idZwierzecia" => $idZwierzecia,
                    "dataZabiegu" => $dataZabiegu,
                    "nazwa" => $nazwa,
                    "stanZwierzecia" => $stanZwierzecia,
                    "opisZabiegu" => $opisZabiegu,
                    "status" => $status,
                    "cenaZabiegu" => $cenaZabiegu
    
                ];
    
                deleteFromTable($array, $tableName, $conn);
    
            } elseif (isset($_POST["zmienSubmit"])) {
    
                $idZabiegu         = $_POST["idZabiegu"]       ?? null;
                $idZwierzecia      = $_POST["idZwierzecia"]    ?? null;
                $dataZabiegu       = $_POST["dataZabiegu"]     ?? null;
                $nazwa             = $_POST["nazwa"]           ?? null;
                $stanZwierzecia    = $_POST["stanZwierzecia"]  ?? null;
                $opisZabiegu       = $_POST["opisZabiegu"]     ?? null;
                $status            = $_POST["status"]          ?? null;
                $cenaZabiegu       = $_POST["cenaZabiegu"]     ?? null;
    
                $idZabieguZmienione         = $_POST["idZabieguZmienione"]       ?? null;
                $idZwierzeciaZmienione      = $_POST["idZwierzeciaZmienione"]    ?? null;
                $dataZabieguZmienione       = $_POST["dataZabieguZmienione"]     ?? null;
                $nazwaZmienione             = $_POST["nazwaZmienione"]           ?? null;
                $stanZwierzeciaZmienione    = $_POST["stanZwierzeciaZmienione"]  ?? null;
                $opisZabieguZmienione       = $_POST["opisZabieguZmienione"]     ?? null;
                $statusZmienione            = $_POST["statusZmienione"]          ?? null;
                $cenaZabieguZmienione       = $_POST["cenaZabieguZmienione"]     ?? null;
    
                $whereArray = [
                    "idZabiegu" => $idZabiegu,
                    "idZwierzecia" => $idZwierzecia,
                    "dataZabiegu" => $dataZabiegu,
                    "nazwa" => $nazwa,
                    "stanZwierzecia" => $stanZwierzecia,
                    "opisZabiegu" => $opisZabiegu,
                    "status" => $status,
                    "cenaZabiegu" => $cenaZabiegu
    
                ];
                $updateArray = [
                    "idZabiegu" => $idZabieguZmienione,
                    "idZwierzecia" => $idZwierzeciaZmienione,
                    "dataZabiegu" => $dataZabieguZmienione,
                    "nazwa" => $nazwaZmienione,
                    "stanZwierzecia" => $stanZwierzeciaZmienione,
                    "opisZabiegu" => $opisZabieguZmienione,
                    "status" => $statusZmienione,
                    "cenaZabiegu" => $cenaZabieguZmienione
    
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
                <a href="surgeries.php" class="menu-item is-active">Zabiegi</a>
                <a href="treatments.php" class="menu-item">Leczenia</a>
                <a href="doctors.php" class="menu-item">Lekarze</a>
                <a href="prescriptions.php" class="menu-item">Recepty</a>
                <a href="medicines.php" class="menu-item">Leki</a>

        </nav>
    </aside>
    <main class="content">
        <h1>Zabiegi</h1>
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
                    <p>Dane zabiegu/ów do wyświetlenia</p>
                    <form action="?" method="post">
                        <label for="idZabiegu">Id Zabiegu: </label>
                        <input type="number" id="idZabiegu" name="idZabiegu"><br>
                        <label for="idZwierzecia">Id Zwierzęcia: </label>
                        <input type="number" id="idZwierzecia" name="idZwierzecia"><br>
                        <label for="dataZabiegu">Data Zabiegu: </label>
                        <input type="date" id="dataZabiegu" name="dataZabiegu"><br>
                        <label for="nazwa">Nazwa: </label>
                        <input type="text" id="nazwa" name="nazwa"><br>
                        <label for="stanZwierzecia">Stan Zwierzęcia: </label>
                        <input type="date" id="stanZwierzecia" name="stanZwierzecia"><br>
                        <label for="opisZabiegu">Opis Zabiegu: </label>
                        <input type="text" id="opisZabiegu" name="opisZabiegu"><br>
                        <label for="status">Status: </label>
                        <input type="text" id="status" name="status"><br>
                        <label for="cenaZabiegu">Cena Zabiegu: </label>
                        <input type="number" id="cenaZabiegu" name="cenaZabiegu"><br><br>
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
                        <label for="idZwierzecia">Id Zwierzęcia: </label>
                        <input type="number" id="idZwierzecia" name="idZwierzecia"><br>
                        <label for="dataZabiegu">Data Zabiegu: </label>
                        <input type="date" id="dataZabiegu" name="dataZabiegu"><br>
                        <label for="nazwa">Nazwa: </label>
                        <input type="text" id="nazwa" name="nazwa"><br>
                        <label for="stanZwierzecia">Stan Zwierzęcia: </label>
                        <input type="text" id="stanZwierzecia" name="stanZwierzecia"><br>
                        <label for="opisZabiegu">Opis Zabiegu: </label>
                        <input type="text" id="opisZabiegu" name="opisZabiegu"><br>
                        <label for="status">Status: </label>
                        <input type="text" id="status" name="status"><br>
                        <label for="cenaZabiegu">Cena Zabiegu: </label>
                        <input type="number" id="cenaZabiegu" name="cenaZabiegu"><br><br>
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
                        <label for="idZabiegu">Id Zabiegu: </label>
                        <input type="number" id="idZabiegu" name="idZabiegu"><br>
                        <label for="idZwierzecia">Id Zwierzęcia: </label>
                        <input type="number" id="idZwierzecia" name="idZwierzecia"><br>
                        <label for="dataZabiegu">Data Zabiegu: </label>
                        <input type="date" id="dataZabiegu" name="dataZabiegu"><br>
                        <label for="nazwa">Nazwa: </label>
                        <input type="text" id="nazwa" name="nazwa"><br>
                        <label for="stanZwierzecia">Stan Zwierzęcia: </label>
                        <input type="date" id="stanZwierzecia" name="stanZwierzecia"><br>
                        <label for="opisZabiegu">Opis Zabiegu: </label>
                        <input type="text" id="opisZabiegu" name="opisZabiegu"><br>
                        <label for="status">Status: </label>
                        <input type="text" id="status" name="status"><br>
                        <label for="cenaZabiegu">Cena Zabiegu: </label>
                        <input type="number" id="cenaZabiegu" name="cenaZabiegu"><br><br>
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
                        <label for="idZabiegu">Id Zabiegu: </label>
                        <input type="number" id="idZabiegu" name="idZabiegu"><br>
                        <label for="idZwierzecia">Id Zwierzęcia: </label>
                        <input type="text" id="idZwierzecia" name="idZwierzecia"><br>
                        <label for="dataZabiegu">Data Zabiegu: </label>
                        <input type="date" id="dataZabiegu" name="dataZabiegu"><br>
                        <label for="nazwa">Nazwa: </label>
                        <input type="text" id="nazwa" name="nazwa"><br>
                        <label for="stanZwierzecia">Stan Zwierzęcia: </label>
                        <input type="text" id="stanZwierzecia" name="stanZwierzecia"><br>
                        <label for="opisZabiegu">Opis Zabiegu: </label>
                        <input type="text" id="opisZabiegu" name="opisZabiegu"><br>
                        <label for="status">Status: </label>
                        <input type="text" id="status" name="status"><br>
                        <label for="cenaZabiegu">Cena Zabiegu: </label>
                        <input type="number" id="cenaZabiegu" name="cenaZabiegu"><br>
                        <p>Nowe dane</p>
                        <label for="idZwierzeciaZmienione">Id Zwierzęcia: </label>
                        <input type="text" id="idZwierzeciaZmienione" name="idZwierzeciaZmienione"><br>
                        <label for="dataZabieguZmienione">Data Zabiegu: </label>
                        <input type="date" id="dataZabieguZmienione" name="dataZabieguZmienione"><br>
                        <label for="nazwaZmienione">Nazwa: </label>
                        <input type="text" id="nazwaZmienione" name="nazwaZmienione"><br>
                        <label for="stanZwierzeciaZmienione">Stan Zwierzęcia: </label>
                        <input type="text" id="stanZwierzeciaZmienione" name="stanZwierzeciaZmienione"><br>
                        <label for="opisZabieguZmienione">Opis Zabiegu: </label>
                        <input type="text" id="opisZabieguZmienione" name="opisZabieguZmienione"><br>
                        <label for="statusZmienione">Status: </label>
                        <input type="text" id="statusZmienione" name="statusZmienione"><br>
                        <label for="cenaZabieguZmienione">Cena Zabiegu: </label>
                        <input type="number" id="cenaZabieguZmienione" name="cenaZabieguZmienione"><br><br>
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
