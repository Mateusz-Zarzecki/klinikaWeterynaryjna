<?php
require '../dbConnection.php';

session_start();
$tableName = "wizyty";
$databaseName = "klinika";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        $conn = null;
        keepConnect($conn, $databaseName);
    
        if($conn)
        {
            if(isset($_POST["wyswietlSubmit"])) {
                $idWizyty         = $_POST["idWizyty"]       ?? null;
                $idZwierzecia     = $_POST["idZwierzecia"]   ?? null;
                $dataWizyty       = $_POST["dataWizyty"]     ?? null;
                $nazwa            = $_POST["nazwa"]          ?? null;
                $stanZwierzecia   = $_POST["stanZwierzecia"] ?? null;
                $opisWizyty       = $_POST["opisWizyty"] ?? null;
                $status           = $_POST["status"]         ?? null;
                $cenaWizyty       = $_POST["cenaWizyty"]     ?? null;
    
                $array = [
                    "idWizyty" => $idWizyty,
                    "idZwierzecia" => $idZwierzecia,
                    "dataWizyty" => $dataWizyty,
                    "nazwa" => $nazwa,
                    "stanZwierzecia" => $stanZwierzecia,
                    "opisWizyty" => $opisWizyty,
                    "status" => $status,
                    "cenaWizyty" => $cenaWizyty
    
                ];
    
                selectTable($array, $tableName, $conn);
            }
            if (isset($_POST["dodajSubmit"])) {
                $idZwierzecia     = $_POST["idZwierzecia"]   ?? null;
                $dataWizyty       = $_POST["dataWizyty"]     ?? null;
                $nazwa            = $_POST["nazwa"]          ?? null;
                $stanZwierzecia   = $_POST["stanZwierzecia"] ?? null;
                $opisWizyty       = $_POST["popisWizytylec"] ?? null;
                $status           = $_POST["status"]         ?? null;
                $cenaWizyty       = $_POST["cenaWizyty"]     ?? null;
    
                $array = [
                    "idZwierzecia" => $idZwierzecia,
                    "dataWizyty" => $dataWizyty,
                    "nazwa" => $nazwa,
                    "stanZwierzecia" => $stanZwierzecia,
                    "opisWizyty" => $opisWizyty,
                    "status" => $status,
                    "cenaWizyty" => $cenaWizyty
    
                ];
    
                addToTable($array, $tableName, $conn);
    
            } elseif (isset($_POST["usunSubmit"])) {
                $idWizyty         = $_POST["idWizyty"]       ?? null;
                $idZwierzecia     = $_POST["idZwierzecia"]   ?? null;
                $dataWizyty       = $_POST["dataWizyty"]     ?? null;
                $nazwa            = $_POST["nazwa"]          ?? null;
                $stanZwierzecia   = $_POST["stanZwierzecia"] ?? null;
                $opisWizyty       = $_POST["popisWizytylec"] ?? null;
                $status           = $_POST["status"]         ?? null;
                $cenaWizyty       = $_POST["cenaWizyty"]     ?? null;
    
                $array = [
                    "idWizyty" => $idWizyty,
                    "idZwierzecia" => $idZwierzecia,
                    "dataWizyty" => $dataWizyty,
                    "nazwa" => $nazwa,
                    "stanZwierzecia" => $stanZwierzecia,
                    "opisWizyty" => $opisWizyty,
                    "status" => $status,
                    "cenaWizyty" => $cenaWizyty
    
                ];
    
                deleteFromTable($array, $tableName, $conn);
    
            } elseif (isset($_POST["zmienSubmit"])) {
    
                $idWizyty         = $_POST["idWizyty"]       ?? null;
                $idZwierzecia     = $_POST["idZwierzecia"]   ?? null;
                $dataWizyty       = $_POST["dataWizyty"]     ?? null;
                $nazwa            = $_POST["nazwa"]          ?? null;
                $stanZwierzecia   = $_POST["stanZwierzecia"] ?? null;
                $opisWizyty       = $_POST["popisWizytylec"] ?? null;
                $status           = $_POST["status"]         ?? null;
                $cenaWizyty       = $_POST["cenaWizyty"]     ?? null;
    
                $idZwierzeciaZmienione     = $_POST["idZwierzeciaZmienione"]   ?? null;
                $dataWizytyZmienione       = $_POST["dataWizytyZmienione"]     ?? null;
                $nazwaZmienione            = $_POST["nazwaZmienione"]          ?? null;
                $stanZwierzeciaZmienione   = $_POST["stanZwierzeciaZmienione"] ?? null;
                $opisWizytyZmienione       = $_POST["popisWizytylecZmienione"] ?? null;
                $statusZmienione           = $_POST["statusZmienione"]         ?? null;
                $cenaWizytyZmienione       = $_POST["cenaWizytyZmienione"]     ?? null;
    
                $whereArray = [
                    "idWizyty" => $idWizyty,
                    "idZwierzecia" => $idZwierzecia,
                    "dataWizyty" => $dataWizyty,
                    "nazwa" => $nazwa,
                    "stanZwierzecia" => $stanZwierzecia,
                    "opisWizyty" => $opisWizyty,
                    "status" => $status,
                    "cenaWizyty" => $cenaWizyty
    
                ];
    
                $updateArray = [
                    "idZwierzecia" => $idZwierzeciaZmienione,
                    "dataWizyty" => $dataWizytyZmienione,
                    "nazwa" => $nazwaZmienione,
                    "stanZwierzecia" => $stanZwierzeciaZmienione,
                    "opisWizyty" => $opisWizytyZmienione,
                    "status" => $statusZmienione,
                    "cenaWizyty" => $cenaWizytyZmienione
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
                <a href="appointments.php" class="menu-item is-active">Wizyty</a>
                <a href="surgeries.php" class="menu-item">Zabiegi</a>
                <a href="treatments.php" class="menu-item">Leczenia</a>
                <a href="doctors.php" class="menu-item">Lekarze</a>
                <a href="prescriptions.php" class="menu-item">Recepty</a>
                <a href="medicines.php" class="menu-item">Leki</a>

        </nav>
    </aside>
    <main class="content">
        <h1>Wizyty</h1>
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
                    <p>Dane wizyt(y) do wyświetlenia</p>
                    <form action="?" method="post">
                        <label for="idWizyty">Id Wizyty: </label>
                        <input type="number" id="idWizyty" name="idWizyty"><br>
                        <label for="idZwierzecia">Id Zwierzęcia: </label>
                        <input type="text" id="idZwierzecia" name="idZwierzecia"><br>
                        <label for="dataWizyty">Data Wizyty: </label>
                        <input type="text" id="dataWizyty" name="dataWizyty"><br>
                        <label for="nazwa">Nazwa: </label>
                        <input type="text" id="nazwa" name="nazwa"><br>
                        <label for="stanZwierzecia">Stan Zwierzęcia: </label>
                        <input type="date" id="stanZwierzecia" name="stanZwierzecia"><br>
                        <label for="opisWizyty">Opis Wizyty: </label>
                        <input type="text" id="opisWizyty" name="opisWizyty"><br>
                        <label for="status">Status: </label>
                        <input type="text" id="status" name="status"><br>
                        <label for="cenaWizyty">Cena Wizyty: </label>
                        <input type="text" id="cenaWizyty" name="cenaWizyty"><br><br>
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
                        <input type="text" id="idZwierzecia" name="idZwierzecia"><br>
                        <label for="dataWizyty">Data Wizyty: </label>
                        <input type="text" id="dataWizyty" name="dataWizyty"><br>
                        <label for="nazwa">Nazwa: </label>
                        <input type="text" id="nazwa" name="nazwa"><br>
                        <label for="stanZwierzecia">Stan Zwierzęcia: </label>
                        <input type="date" id="stanZwierzecia" name="stanZwierzecia"><br>
                        <label for="opisWizyty">Opis Wizyty: </label>
                        <input type="text" id="opisWizyty" name="opisWizyty"><br>
                        <label for="status">Status: </label>
                        <input type="text" id="status" name="status"><br>
                        <label for="cenaWizyty">Cena Wizyty: </label>
                        <input type="text" id="cenaWizyty" name="cenaWizyty"><br><br>
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
                        <label for="idWizyty">Id Wizyty: </label>
                        <input type="number" id="idWizyty" name="idWizyty"><br>
                        <label for="idZwierzecia">Id Zwierzęcia: </label>
                        <input type="text" id="idZwierzecia" name="idZwierzecia"><br>
                        <label for="dataWizyty">Data Wizyty: </label>
                        <input type="text" id="dataWizyty" name="dataWizyty"><br>
                        <label for="nazwa">Nazwa: </label>
                        <input type="text" id="nazwa" name="nazwa"><br>
                        <label for="stanZwierzecia">Stan Zwierzęcia: </label>
                        <input type="date" id="stanZwierzecia" name="stanZwierzecia"><br>
                        <label for="opisWizyty">Opis Wizyty: </label>
                        <input type="text" id="opisWizyty" name="opisWizyty"><br>
                        <label for="status">Status: </label>
                        <input type="text" id="status" name="status"><br>
                        <label for="cenaWizyty">Cena Wizyty: </label>
                        <input type="text" id="cenaWizyty" name="cenaWizyty"><br><br>
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
                        <label for="idWizyty">Id Wizyty: </label>
                        <input type="number" id="idWizyty" name="idWizyty"><br>
                        <label for="idZwierzecia">Id Zwierzęcia: </label>
                        <input type="text" id="idZwierzecia" name="idZwierzecia"><br>
                        <label for="dataWizyty">Data Wizyty: </label>
                        <input type="text" id="dataWizyty" name="dataWizyty"><br>
                        <label for="nazwa">Nazwa: </label>
                        <input type="text" id="nazwa" name="nazwa"><br>
                        <label for="stanZwierzecia">Stan Zwierzęcia: </label>
                        <input type="date" id="stanZwierzecia" name="stanZwierzecia"><br>
                        <label for="opisWizyty">Opis Wizyty: </label>
                        <input type="text" id="opisWizyty" name="opisWizyty"><br>
                        <label for="status">Status: </label>
                        <input type="text" id="status" name="status"><br>
                        <label for="cenaWizyty">Cena Wizyty: </label>
                        <input type="text" id="cenaWizyty" name="cenaWizyty"><br>
                        <p>Nowe dane</p>
                        <label for="idZwierzeciaZmienione">Id Zwierzęcia: </label>
                        <input type="text" id="idZwierzeciaZmienione" name="idZwierzeciaZmienione"><br>
                        <label for="dataWizytyZmienione">Data Wizyty: </label>
                        <input type="text" id="dataWizytyZmienione" name="dataWizytyZmienione"><br>
                        <label for="nazwaZmienione">Nazwa: </label>
                        <input type="text" id="nazwaZmienione" name="nazwaZmienione"><br>
                        <label for="stanZwierzeciaZmienione">Stan Zwierzęcia: </label>
                        <input type="date" id="stanZwierzeciaZmienione" name="stanZwierzeciaZmienione"><br>
                        <label for="opisWizytyZmienione">Opis Wizyty: </label>
                        <input type="text" id="opisWizytyZmienione" name="opisWizytyZmienione"><br>
                        <label for="statusZmienione">Status: </label>
                        <input type="text" id="statusZmienione" name="statusZmienione"><br>
                        <label for="cenaWizytyZmienione">Cena Wizyty: </label>
                        <input type="text" id="cenaWizytyZmienione" name="cenaWizytyZmienione"><br><br>
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
