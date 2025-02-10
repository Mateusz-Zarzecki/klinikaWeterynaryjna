<?php
session_start();
$tableOneName = "wizytyRecepty";
$tableTwoName = "zabiegiRecepty";
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
    
                $selectConditions = [];
    
                foreach ($array as $key => $value) {
                    if (!empty($value)) {
                        array_push($selectConditions, $key . "=" .(is_string($value) ? "'$value'" : $value));
                    }
                }
                if (count($selectConditions) > 0) {
    
                    $selectConditionsString = implode(" AND ", $selectConditions);
                    $query = "SELECT * FROM $tableOneName WHERE $selectConditionsString";
                    $_SESSION['table'] = $query;
                } else {
                    $query = $query = "SELECT * FROM $tableOneName";
                    $_SESSION['table'] = $query;
                }
                header("Location: ?info=Wyświetlono+lekarzy+$changePrescription");
                exit;
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

                $selectConditions = [];

                foreach ($array as $key => $value) {
                    if (!empty($value)) {
                        array_push($selectConditions, $key . "=" .(is_string($value) ? "'$value'" : $value));
                    }
                }
                if (count($selectConditions) > 0) {

                    $selectConditionsString = implode(" AND ", $selectConditions);
                    $query = "SELECT * FROM $tableTwoName WHERE $selectConditionsString";
                    $_SESSION['table'] = $query;
                } else {
                    $query = $query = "SELECT * FROM $tableTwoName";
                    $_SESSION['table'] = $query;
                }
                header("Location: ?info=Wyświetlono+lekarzy");
                exit;
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
                    $query = "INSERT INTO $tableOneName ($colsString) VALUES ($valsString)";
                    $conn->query($query);

                    header("Location: ?info=Dodano+lekarza");
                    exit;
                } else {
                    header("Location: ?info=Brak+danych+do+dodania");
                    exit;
                }
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

                foreach ($array as $key => $value) {
                    if (!empty($value)) {
                        $insertCols[] = $key;
                        $insertVals[] = is_string($value) ? "'$value'" : $value;
                    }
                }

                if (count($insertCols) > 0) {
                    $colsString = implode(", ", $insertCols);
                    $valsString = implode(", ", $insertVals);
                    $query = "INSERT INTO $tableTwoName ($colsString) VALUES ($valsString)";
                    $conn->query($query);

                    header("Location: ?info=Dodano+lekarza");
                    exit;
                } else {
                    header("Location: ?info=Brak+danych+do+dodania");
                    exit;
                }
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

                $conditions = [];
                foreach ($array as $key => $value) {
                    if (!empty($value)  || $value === '0') {
                        $val = is_string($value) ? "'$value'" : $value;
                        $conditions[] = "$key = $val";
                    }
                }

                if (count($conditions) > 0) {
                    $where = implode(" AND ", $conditions);
                    $query = "DELETE FROM $tableOneName WHERE $where";
                    $conn->query($query);
                    header("Location: ?info=Usunięto+lekarza/y");
                    exit;
                } else {
                    header("Location: ?info=Brak+danych+do+usunięcia");
                    exit;
                }
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

                $conditions = [];
                foreach ($array as $key => $value) {
                    if (!empty($value)  || $value === '0') {
                        $val = is_string($value) ? "'$value'" : $value;
                        $conditions[] = "$key = $val";
                    }
                }

                if (count($conditions) > 0) {
                    $where = implode(" AND ", $conditions);
                    $query = "DELETE FROM $tableTwoName WHERE $where";
                    $conn->query($query);
                    header("Location: ?info=Usunięto+lekarza/y");
                    exit;
                } else {
                    header("Location: ?info=Brak+danych+do+usunięcia");
                    exit;
                }
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
                    $query = "UPDATE $tableOneName SET $setString WHERE $whereString";
                    $conn->query($query);
                    header("Location: ?info=Zmieniono+dane+lekarzy+$query");
                    exit;
                } else {
                    header("Location: ?info=Brak+danych+do+zmiany+$idWizytyZmienione");
                    exit;
                }
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
                    $query = "UPDATE $tableTwoName SET $setString WHERE $whereString";
                    $conn->query($query);
                    header("Location: ?info=Zmieniono+dane+lekarzy+$query");
                    exit;
                } else {
                    header("Location: ?info=Brak+danych+do+zmiany+$sets+$conditions");
                    exit;
                }
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
                echo '<div class="tabela">'.
                '<div class="table-border">';
                $query = ($_SESSION['table'] ?? null) ?? "SELECT * FROM $tableOneName";
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
    function changePrescriptions() 
    {
        let labels = document.getElementsByClassName('change');
        for(let i = 0; i< labels.length; i++)
        {
            labels[i].innerHTML = labels[i].innerHTML == "Id Wizyty: " ? "Id Zabiegu: " : "Id Wizyty: ";
        }
        let hiddenInputs = document.getElementsByClassName('changePrescription');
        let button = document.getElementById("zmianaRecept");
        button.value  = button.value == "Wizyty" ? "Zabiegi" : "Wizyty";
        for(let i=0;i<hiddenInputs.length;i++)
        {
            hiddenInputs[i].value = (hiddenInputs[i].value == "wizyty") ? "zabiegi" : "wizyty";
        }
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
