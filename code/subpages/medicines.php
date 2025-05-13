<?php

require '../dbConnection.php';

session_start();
$tableName = "leki";
$databaseName = "klinika";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        $conn = null;
        keepConnect($conn, $databaseName);
    
        if($conn)
        {
    
            if(isset($_POST["wyswietlSubmit"])) {
                $idLeku       = $_POST["idLeku"]   ?? null;
                $nazwa        = $_POST["nazwa"]    ?? null;
                $cena         = $_POST["cena"]     ?? null;
                $opis         = $_POST["opis"]     ?? null;
    
                $array = [
                    "idLeku" => $idLeku,
                    "nazwa" => $nazwa,
                    "cena" => $cena,
                    "opis" => $opis
                ];
    
                selectTable($array, $tableName, $conn);
            }
            if (isset($_POST["dodajSubmit"])) {
                $nazwa        = $_POST["nazwa"]    ?? null;
                $cena         = $_POST["cena"]     ?? null;
                $opis         = $_POST["opis"]     ?? null;
    
                $array = [
                    "nazwa" => $nazwa,
                    "cena" => $cena,
                    "opis" => $opis
                ];
    
                addToTable($array, $tableName, $conn);
    
            } elseif (isset($_POST["usunSubmit"])) {
                $idLeku       = $_POST["idLeku"]   ?? null;
                $nazwa        = $_POST["nazwa"]    ?? null;
                $cena         = $_POST["cena"]     ?? null;
                $opis         = $_POST["opis"]     ?? null;
    
                $array = [
                    "idLeku" => $idLeku,
                    "nazwa" => $nazwa,
                    "cena" => $cena,
                    "opis" => $opis
                ];
    
                deleteFromTable($array, $tableName, $conn);
    
            } elseif (isset($_POST["zmienSubmit"])) {
    
                $idLeku       = $_POST["idLeku"]   ?? null;
                $nazwa        = $_POST["nazwa"]    ?? null;
                $cena         = $_POST["cena"]     ?? null;
                $opis         = $_POST["opis"]     ?? null;
    
                $nazwaZmienione         = $_POST["nazwaZmienione "]    ?? null;
                $cenaZmienione          = $_POST["cenaZmienione "]     ?? null;
                $opisZmienione          = $_POST["opisZmienione "]     ?? null;
    
                $whereArray = [
                    "idLeku" => $idLeku,
                    "nazwa" => $nazwa,
                    "cena" => $cena,
                    "opis" => $opis
                ];
    
                $updateArray = [
                    "idLeku" => $idLekuZmienione ,
                    "nazwa" => $nazwaZmienione ,
                    "cena" => $cenaZmienione ,
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
                <a href="treatments.php" class="menu-item">Leczenia</a>
                <a href="doctors.php" class="menu-item">Lekarze</a>
                <a href="prescriptions.php" class="menu-item">Recepty</a>
                <a href="medicines.php" class="menu-item is-active">Leki</a>

        </nav>
    </aside>
    <main class="content">
        <h1>Leki</h1>
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
                    <p>Dane leku/ów do wyświetlenia</p>
                    <form action="?" method="post">
                        <label for="idLeku">Id Leku: </label>
                        <input type="number" id="idLeku" name="idLeku"><br>
                        <label for="nazwa">Nazwa: </label>
                        <input type="text" id="nazwa" name="nazwa"><br>
                        <label for="cena">Cena: </label>
                        <input type="text" id="cena" name="cena"><br>
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
                        <label for="nazwa">Nazwa: </label>
                        <input type="text" id="nazwa" name="nazwa"><br>
                        <label for="cena">Cena: </label>
                        <input type="text" id="cena" name="cena"><br>
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
                        <label for="idLeku">Id Leku: </label>
                        <input type="number" id="idLeku" name="idLeku"><br>
                        <label for="nazwa">Nazwa: </label>
                        <input type="text" id="nazwa" name="nazwa"><br>
                        <label for="cena">Cena: </label>
                        <input type="text" id="cena" name="cena"><br>
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
                        <label for="idLeku">Id Leku: </label>
                        <input type="number" id="idLeku" name="idLeku"><br>
                        <label for="nazwa">Nazwa: </label>
                        <input type="text" id="nazwa" name="nazwa"><br>
                        <label for="cena">Cena: </label>
                        <input type="text" id="cena" name="cena"><br>
                        <label for="opis">Opis: </label>
                        <input type="text" id="opis" name="opis"><br>
                        <p>Nowe dane</p>
                        <label for="nazwaZmienione">Nazwa: </label>
                        <input type="text" id="nazwaZmienione" name="nazwaZmienione"><br>
                        <label for="cenaZmienione">Cena: </label>
                        <input type="text" id="cenaZmienione" name="cenaZmienione"><br>
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
