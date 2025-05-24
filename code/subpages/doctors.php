<?php
require '../dbConnection.php';

session_start();
$tableName = "lekarze";
$databaseName = "klinika";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    try {
        $conn = null;
        keepConnect($conn, $databaseName);

        if($conn)
        {
            if(isset($_POST["wyswietlSubmit"])) {
                $idLekarza         = $_POST["idLekarza"]         ?? null;
                $imie              = $_POST["imie"]              ?? null;
                $nazwisko          = $_POST["nazwisko"]          ?? null;
                $pensja            = $_POST["pensja"]            ?? null;
                $specjalizacja     = $_POST["specjalizacja"]     ?? null;
                $dob               = $_POST["dob"]               ?? null;
                $numerTelefonu     = $_POST["numerTelefonu"]     ?? null;
                $adresEmail        = $_POST["adresEmail"]        ?? null;
                $adresZamieszkania = $_POST["adresZamieszkania"] ?? null;
                $kodPocztowy       = $_POST["kodPocztowy"]       ?? null;
    
                $array = [
                    "idLekarza" => $idLekarza,
                    "imie" => $imie,
                    "nazwisko" => $nazwisko,
                    "pensja" => $pensja,
                    "specjalizacja" => $specjalizacja,
                    "dob" => $dob,
                    "numerTelefonu" => $numerTelefonu,
                    "adresEmail" => $adresEmail,
                    "adresZamieszkania" => $adresZamieszkania,
                    "kodPocztowy" => $kodPocztowy
    
                ];
    
                selectTable($array, $tableName, $conn);
            }
            if (isset($_POST["dodajSubmit"])) {
                $imie              = $_POST["imie"]              ?? null;
                $nazwisko          = $_POST["nazwisko"]          ?? null;
                $pensja            = $_POST["pensja"]            ?? null;
                $specjalizacja     = $_POST["specjalizacja"]     ?? null;
                $dob               = $_POST["dob"]               ?? null;
                $numerTelefonu     = $_POST["numerTelefonu"]     ?? null;
                $adresEmail        = $_POST["adresEmail"]        ?? null;
                $adresZamieszkania = $_POST["adresZamieszkania"] ?? null;
                $kodPocztowy       = $_POST["kodPocztowy"]       ?? null;
    
                $array = [
                    "imie" => $imie,
                    "nazwisko" => $nazwisko,
                    "pensja" => $pensja,
                    "specjalizacja" => $specjalizacja,
                    "dob" => $dob,
                    "numerTelefonu" => $numerTelefonu,
                    "adresEmail" => $adresEmail,
                    "adresZamieszkania" => $adresZamieszkania,
                    "kodPocztowy" => $kodPocztowy
    
                ];
    
                addToTable($array, $tableName, $conn);
    
    
            } elseif (isset($_POST["usunSubmit"])) {
                $idLekarza         = $_POST["idLekarza"]         ?? null;
                $imie              = $_POST["imie"]              ?? null;
                $nazwisko          = $_POST["nazwisko"]          ?? null;
                $pensja            = $_POST["pensja"]            ?? null;
                $specjalizacja     = $_POST["specjalizacja"]     ?? null;
                $dob               = $_POST["dob"]               ?? null;
                $numerTelefonu     = $_POST["numerTelefonu"]     ?? null;
                $adresEmail        = $_POST["adresEmail"]        ?? null;
                $adresZamieszkania = $_POST["adresZamieszkania"] ?? null;
                $kodPocztowy       = $_POST["kodPocztowy"]       ?? null;
    
                $array = [
                    "idLekarza" => $idLekarza,
                    "imie" => $imie,
                    "nazwisko" => $nazwisko,
                    "pensja" => $pensja,
                    "specjalizacja" => $specjalizacja,
                    "dob" => $dob,
                    "numerTelefonu" => $numerTelefonu,
                    "adresEmail" => $adresEmail,
                    "adresZamieszkania" => $adresZamieszkania,
                    "kodPocztowy" => $kodPocztowy
    
                ];
    
                deleteFromTable($array, $tableName, $conn);
    
            } elseif (isset($_POST["zmienSubmit"])) {
    
                $idLekarza         = $_POST["idLekarza"]         ?? null;
                $imie              = $_POST["imie"]              ?? null;
                $nazwisko          = $_POST["nazwisko"]          ?? null;
                $pensja            = $_POST["pensja"]            ?? null;
                $specjalizacja     = $_POST["specjalizacja"]     ?? null;
                $dob               = $_POST["dob"]               ?? null;
                $numerTelefonu     = $_POST["numerTelefonu"]     ?? null;
                $adresEmail        = $_POST["adresEmail"]        ?? null;
                $adresZamieszkania = $_POST["adresZamieszkania"] ?? null;
                $kodPocztowy       = $_POST["kodPocztowy"]       ?? null;
    
                $imieZmienione              = $_POST["imieZmienione"]              ?? null;
                $nazwiskoZmienione          = $_POST["nazwiskoZmienione"]          ?? null;
                $pensjaZmienione            = $_POST["pensjaZmienione"]            ?? null;
                $specjalizacjaZmienione     = $_POST["specjalizacjaZmienione"]     ?? null;
                $dobZmienione               = $_POST["dobZmienione"]               ?? null;
                $numerTelefonuZmienione     = $_POST["numerTelefonuZmienione"]     ?? null;
                $adresEmailZmienione        = $_POST["adresEmailZmienione"]        ?? null;
                $adresZamieszkaniaZmienione = $_POST["adresZamieszkaniaZmienione"] ?? null;
                $kodPocztowyZmienione       = $_POST["kodPocztowyZmienione"]       ?? null;
    
                $whereArray = [
                    "idLekarza" => $idLekarza,
                    "imie" => $imie,
                    "nazwisko" => $nazwisko,
                    "pensja" => $pensja,
                    "specjalizacja" => $specjalizacja,
                    "dob" => $dob,
                    "numerTelefonu" => $numerTelefonu,
                    "adresEmail" => $adresEmail,
                    "adresZamieszkania" => $adresZamieszkania,
                    "kodPocztowy" => $kodPocztowy
    
                ];
               
                $updateArray = [
                    "imie" => $imieZmienione,
                    "nazwisko" => $nazwiskoZmienione,
                    "pensja" => $pensjaZmienione,
                    "specjalizacja" => $specjalizacjaZmienione,
                    "dob" => $dobZmienione,
                    "numerTelefonu" => $numerTelefonuZmienione,
                    "adresEmail" => $adresEmailZmienione,
                    "adresZamieszkania" => $adresZamieszkaniaZmienione,
                    "kodPocztowy" => $kodPocztowyZmienione
    
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
                <a href="doctors.php" class="menu-item is-active">Lekarze</a>
                <a href="prescriptions.php" class="menu-item">Recepty</a>
                <a href="medicines.php" class="menu-item">Leki</a>

        </nav>
    </aside>
    <main class="content">
        <h1>Lekarze</h1>
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
                    <p>Dane lekarza/y do wyświetlenia</p>
                    <form action="?" method="post">
                        <label for="idLekarza">Id Lekarza: </label>
                        <input type="number" id="idLekarza" name="idLekarza"><br>
                        <label for="imie">Imie: </label>
                        <input type="text" id="imie" name="imie"><br>
                        <label for="nazwisko">Nazwisko: </label>
                        <input type="text" id="nazwisko" name="nazwisko"><br>
                        <label for="pensja">Pensja: </label>
                        <input type="text" id="pensja" name="pensja"><br>
                        <label for="specjalizacja">Specjalizacja: </label>
                        <input type="date" id="specjalizacja" name="specjalizacja"><br>
                        <label for="dob">Data Urodzenia: </label>
                        <input type="text" id="dob" name="dob"><br>
                        <label for="numerTelefonu">Numer Telefonu: </label>
                        <input type="text" id="numerTelefonu" name="numerTelefonu"><br>
                        <label for="adresEmail">Adres Email: </label>
                        <input type="text" id="adresEmail" name="adresEmail"><br>
                        <label for="adresZamieszkania">Adres Zamieszkania: </label>
                        <input type="text" id="adresZamieszkania" name="adresZamieszkania"><br>
                        <label for="kodPocztowy">Kod Pocztowy: </label>
                        <input type="text" id="kodPocztowy" name="kodPocztowy"><br><br>
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
                        <label for="imie">Imie: </label>
                        <input type="text" id="imie" name="imie"><br>
                        <label for="nazwisko">Nazwisko: </label>
                        <input type="text" id="nazwisko" name="nazwisko"><br>
                        <label for="pensja">Pensja: </label>
                        <input type="text" id="pensja" name="pensja"><br>
                        <label for="specjalizacja">Specjalizacja: </label>
                        <input type="date" id="specjalizacja" name="specjalizacja"><br>
                        <label for="dob">Data Urodzenia: </label>
                        <input type="text" id="dob" name="dob"><br>
                        <label for="numerTelefonu">Numer Telefonu: </label>
                        <input type="text" id="numerTelefonu" name="numerTelefonu"><br>
                        <label for="adresEmail">Adres Email: </label>
                        <input type="text" id="adresEmail" name="adresEmail"><br>
                        <label for="adresZamieszkania">Adres Zamieszkania: </label>
                        <input type="text" id="adresZamieszkania" name="adresZamieszkania"><br>
                        <label for="kodPocztowy">Kod Pocztowy: </label>
                        <input type="text" id="kodPocztowy" name="kodPocztowy"><br><br>
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
                        <label for="idLekarza">Id Lekarza: </label>
                        <input type="number" id="idLekarza" name="idLekarza"><br>
                        <label for="imie">Imie: </label>
                        <input type="text" id="imie" name="imie"><br>
                        <label for="nazwisko">Nazwisko: </label>
                        <input type="text" id="nazwisko" name="nazwisko"><br>
                        <label for="pensja">Pensja: </label>
                        <input type="text" id="pensja" name="pensja"><br>
                        <label for="specjalizacja">Specjalizacja: </label>
                        <input type="date" id="specjalizacja" name="specjalizacja"><br>
                        <label for="dob">Data Urodzenia: </label>
                        <input type="text" id="dob" name="dob"><br>
                        <label for="numerTelefonu">Numer Telefonu: </label>
                        <input type="text" id="numerTelefonu" name="numerTelefonu"><br>
                        <label for="adresEmail">Adres Email: </label>
                        <input type="text" id="adresEmail" name="adresEmail"><br>
                        <label for="adresZamieszkania">Adres Zamieszkania: </label>
                        <input type="text" id="adresZamieszkania" name="adresZamieszkania"><br>
                        <label for="kodPocztowy">Kod Pocztowy: </label>
                        <input type="text" id="kodPocztowy" name="kodPocztowy"><br><br>
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
                        <label for="idLekarza">Id Lekarza: </label>
                        <input type="number" id="idLekarza" name="idLekarza"><br>
                        <label for="imie">Imie: </label>
                        <input type="text" id="imie" name="imie"><br>
                        <label for="nazwisko">Nazwisko: </label>
                        <input type="text" id="nazwisko" name="nazwisko"><br>
                        <label for="pensja">Pensja: </label>
                        <input type="text" id="pensja" name="pensja"><br>
                        <label for="specjalizacja">Specjalizacja: </label>
                        <input type="text" id="specjalizacja" name="specjalizacja"><br>
                        <label for="dob">Data Urodzenia: </label>
                        <input type="date" id="dob" name="dob"><br>
                        <label for="numerTelefonu">Numer Telefonu: </label>
                        <input type="text" id="numerTelefonu" name="numerTelefonu"><br>
                        <label for="adresEmail">Adres Email: </label>
                        <input type="text" id="adresEmail" name="adresEmail"><br>
                        <label for="adresZamieszkania">Adres Zamieszkania: </label>
                        <input type="text" id="adresZamieszkania" name="adresZamieszkania"><br>
                        <label for="kodPocztowy">Kod Pocztowy: </label>
                        <input type="text" id="kodPocztowy" name="kodPocztowy"><br><br>
                        <p>Nowe dane</p>
                        <label for="imieZmienione">Imie: </label>
                        <input type="text" id="imieZmienione" name="imieZmienione"><br>
                        <label for="nazwiskoZmienione">Nazwisko: </label>
                        <input type="text" id="nazwiskoZmienione" name="nazwiskoZmienione"><br>
                        <label for="pensjaZmienione">Pensja: </label>
                        <input type="text" id="pensjaZmienione" name="pensjaZmienione"><br>
                        <label for="specjalizacjaZmienione">Specjalizacja: </label>
                        <input type="text" id="specjalizacjaZmienione" name="specjalizacjaZmienione"><br>
                        <label for="dobZmienione">Data Urodzenia: </label>
                        <input type="date" id="dobZmienione" name="dobZmienione"><br>
                        <label for="numerTelefonuZmienione">Numer Telefonu: </label>
                        <input type="text" id="numerTelefonuZmienione" name="numerTelefonuZmienione"><br>
                        <label for="adresEmailZmienione">Adres Email: </label>
                        <input type="text" id="adresEmailZmienione" name="adresEmailZmienione"><br>
                        <label for="adresZamieszkaniaZmienione">Adres Zamieszkania: </label>
                        <input type="text" id="adresZamieszkaniaZmienione" name="adresZamieszkaniaZmienione"><br>
                        <label for="kodPocztowyZmienione">Kod Pocztowy: </label>
                        <input type="text" id="kodPocztowyZmienione" name="kodPocztowyZmienione"><br><br>
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
