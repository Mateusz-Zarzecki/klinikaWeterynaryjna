<?php

require '../dbConnection.php';

session_start();
$tableOneName = "wizytyRecepty";
$tableTwoName = "zabiegiRecepty";
$databaseName = "klinika";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        $conn = null;
        keepConnect($conn, $databaseName);;

        if($conn)
        {
    
            if(isset($_POST["wyswietlSubmit"])) {
                $changePrescription = $_POST["changePrescription"] ?? null;
                if($changePrescription === "wizyty")
                {
                
                    $idRecepty       = $_POST["idRecepty"]           ?? null;
                    $idWizyty        = $_POST["idWizytyZabiegu"]            ?? null;
                    $dataWystawienia = $_POST["dataWystawienia"]     ?? null;
    
                    $array = [
                        "idRecepty" => $idRecepty,
                        "idWizyty" => $idWizyty,
                        "dataWystawienia" => $dataWystawienia
                    ];
        
                    selectTable($array, $tableOneName, $conn);
                }
    
                else if($changePrescription === "zabiegi")
                {
                                
                    $idRecepty       = $_POST["idRecepty"]           ?? null;
                    $idZabiegu        = $_POST["idWizytyZabiegu"]            ?? null;
                    $dataWystawienia = $_POST["dataWystawienia"]     ?? null;
    
                    $array = [
                        "idRecepty" => $idRecepty,
                        "idZabiegu" => $idZabiegu,
                        "dataWystawienia" => $dataWystawienia
                    ];
    
                    selectTable($array, $tableTwoName, $conn);
                }
            }
            if (isset($_POST["dodajSubmit"])) {
                $changePrescription = $_POST["changePrescription"] ?? null;
    
                if($changePrescription==="wizyty")
                {
                    $idWizyty        = $_POST["idWizytyZabiegu"]            ?? null;
                    $dataWystawienia = $_POST["dataWystawienia"]     ?? null;
    
                    $array = [
                        "idWizyty" => $idWizyty,
                        "dataWystawienia" => $dataWystawienia
                    ];
    
                    addToTable($array, $tableOneName, $conn);
    
                }
                else if($changePrescription==="zabiegi")
                {
                    $idZabiegu        = $_POST["idWizytyZabiegu"]            ?? null;
                    $dataWystawienia = $_POST["dataWystawienia"]     ?? null;
    
                    $array = [
                        "idZabiegu" => $idZabiegu,
                        "dataWystawienia" => $dataWystawienia
                    ];
    
                    $insertCols = [];
                    $insertVals = [];
    
                    addToTable($array, $tableTwoName, $conn);
                }
    
            } elseif (isset($_POST["usunSubmit"])) {
                $changePrescription = $_POST["changePrescription"] ?? null;
    
                if($changePrescription === "wizyty")
                {
                    $idRecepty       = $_POST["idRecepty"]           ?? null;
                    $idWizyty       = $_POST["idWizytyZabiegu"]            ?? null;
                    $dataWystawienia = $_POST["dataWystawienia"]     ?? null;
    
                    $array = [
                        "idRecepty" => $idRecepty,
                        "idWizyty" => $idWizyty,
                        "dataWystawienia" => $dataWystawienia
                    ];
    
                    deleteFromTable($array, $tableOneName, $conn);
    
                }
                else if($changePrescription === "zabiegi")
                {
                    $idRecepty       = $_POST["idRecepty"]           ?? null;
                    $idZabiegu        = $_POST["idWizytyZabiegu"]            ?? null;
                    $dataWystawienia = $_POST["dataWystawienia"]     ?? null;
    
                    $array = [
                        "idRecepty" => $idRecepty,
                        "idZabiegu" => $idZabiegu,
                        "dataWystawienia" => $dataWystawienia
                    ];
    
                    deleteFromTable($array, $tableTwoName, $conn);
    
                }
                
    
            } elseif (isset($_POST["zmienSubmit"])) {
                $changePrescription = $_POST["changePrescription"] ?? null;
    
                if($changePrescription === "wizyty")
                {
                    $idRecepty        = $_POST["idRecepty"]           ?? null;
                    $idWizyty        = $_POST["idWizytyZabiegu"]           ?? null;
                    $dataWystawienia  = $_POST["dataWystawienia"]     ?? null;
    
                    $idWizytyZmienione        = $_POST["idWizytyZabieguZmienione"]           ?? null;
                    $dataWystawieniaZmienione  = $_POST["dataWystawieniaZmienione"]     ?? null;
    
                    $whereArray = [
                        "idRecepty" => $idRecepty,
                        "idWizyty" => $idWizyty,
                        "dataWystawienia" => $dataWystawienia
                    ];
                    $updateArray = [
                        "idWizyty" => $idWizytyZmienione,
                        "dataWystawienia" => $dataWystawieniaZmienione
                    ];
                    updateTable($updateArray, $whereArray,$tableOneName, $conn);
    
                }
                else if($changePrescription === "zabiegi") 
                {
                    $idRecepty        = $_POST["idRecepty"]           ?? null;
                    $idZabiegu        = $_POST["idWizytyZabiegu"]           ?? null;
                    $dataWystawienia  = $_POST["dataWystawienia"]     ?? null;
    
                    $idZabieguZmienione        = $_POST["idWizytyZabieguZmienione"]           ?? null;
                    $dataWystawieniaZmienione  = $_POST["dataWystawieniaZmienione"]     ?? null;
    
                    $whereArray = [
                        "idRecepty" => $idRecepty,
                        "idZabiegu" => $idZabiegu,
                        "dataWystawienia" => $dataWystawienia
                    ];
                    $updateArray = [
                        "idZabiegu" => $idZabieguZmienione,
                        "dataWystawienia" => $dataWystawieniaZmienione
                    ];
                    updateTable($updateArray, $whereArray,$tableTwoName, $conn);
    
                }
    
                
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
                <a href="prescriptions.php" class="menu-item is-active">Recepty</a>
                <a href="medicines.php" class="menu-item">Leki</a>

        </nav>
    </aside>
    <main class="content">
        <h1>Recepty</h1>
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
                    <input id=zmianaRecept type='button' value='Wizyty' onclick=changePrescriptions()>
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
                    <p>Dane recept(y) do wyświetlenia</p>
                    <form action="?" method="post">
                        <label for="idRecepty">Id Recepty: </label>
                        <input type="number" id="idRecepty" name="idRecepty"><br>
                        <label for="idWizytyZabiegu" class=change>Id Wizyty: </label>
                        <input type="text" id="idWizytyZabiegu" name="idWizytyZabiegu"><br>
                        <label for="dataWystawienia">Data Wystawienia: </label>
                        <input type="text" id="dataWystawienia" name="dataWystawienia"><br><br>
                        <input type=hidden id=changePrescription name=changePrescription class=changePrescription  value='wizyty'>

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
                        <label for="idWizytyZabiegu" class=change>Id Wizyty: </label>
                        <input type="text" id="idWizytyZabiegu" name="idWizytyZabiegu"><br>
                        <label for="dataWystawienia">Data Wystawienia: </label>
                        <input type="text" id="dataWystawienia" name="dataWystawienia"><br><br>
                        <input type=hidden id=changePrescription name=changePrescription class=changePrescription value='wizyty'>

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
                        <label for="idRecepty">Id Recepty: </label>
                        <input type="number" id="idRecepty" name="idRecepty"><br>
                        <label for="idWizytyZabiegu" class=change>Id Wizyty: </label>
                        <input type="text" id="idWizytyZabiegu" name="idWizytyZabiegu"><br>
                        <label for="dataWystawienia">Data Wystawienia: </label>
                        <input type="text" id="dataWystawienia" name="dataWystawienia"><br><br>
                        <input type=hidden id=changePrescription name=changePrescription class=changePrescription value='wizyty'>
                       
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
                        <label for="idRecepty">Id Recepty: </label>
                        <input type="number" id="idRecepty" name="idRecepty"><br>
                        <label for="idWizytyZabiegu" class=change>Id Wizyty: </label>
                        <input type="text" id="idWizytyZabiegu" name="idWizytyZabiegu"><br>
                        <label for="dataWystawienia">Data Wystawienia: </label>
                        <input type="text" id="dataWystawienia" name="dataWystawienia"><br><br>
                        <p>Nowe dane</p>
                        <label for="idWizytyZabieguZmienione" class=change>Id Wizyty: </label>
                        <input type="text" id="idWizytyZabieguZmienione" name="idWizytyZabieguZmienione"><br>
                        <label for="dataWystawieniaZmienione">Data Wystawienia: </label>
                        <input type="text" id="dataWystawieniaZmienione" name="dataWystawieniaZmienione"><br><br>
                        <input type=hidden id=changePrescription name=changePrescription class=changePrescription value='wizyty'>

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
                displayTable($tableOneName, $conn);
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
