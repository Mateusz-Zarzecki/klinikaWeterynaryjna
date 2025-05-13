<?php
    function keepConnect(&$conn, $databaseName) {   
        $oldUsername = $_SESSION['username'] ?? null;
        $oldPassword = $_SESSION['password'] ?? null;
        $_SESSION['username'] = $_SESSION['username'] ?? null;
        $_SESSION['password'] = $_SESSION['password'] ?? null;
        $_SESSION['userId'] = $_SESSION['userId'] ?? null;

        if(!isset($_SESSION["logged"]))
        {
            $_SESSION["logged"] = false;
        }
        try {
            $conn = new mysqli("localhost", 'root', '', $databaseName);
            $conn->set_charset("utf8");
            
            $authorizationQuery = "SELECT UserId FROM USERS WHERE username = '" . $_SESSION['username'] . "' AND password = '" . $_SESSION['password'] . "' ";
            $result = $conn->query($authorizationQuery);

            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $_SESSION['userId'] = strval($row['UserId']);
                }
            } else {
                $_SESSION['userId'] = null;
            }


            if ($conn->connect_error || empty($_SESSION['userId'])) {
                throw new mysqli_sql_exception();
            }
            
            if(!$_SESSION["logged"] || $oldUsername!==$_SESSION['username'] || $oldPassword !== $_SESSION['password'])
            {
                $_SESSION["logged"] = true;
                header("Location: ?info=Zalogowano+pomyśnie" . $_SESSION['userId'] . $_SESSION['username'] . " " . $_SESSION['password']);
                exit;
            }
        } catch (mysqli_sql_exception $e) {
            $_SESSION["logged"] = false;
            header("Location: ?info=Nie+udało+się+zalogować" . $authorizationQuery . " " . $_SESSION['userId']);
            exit;
        } catch(Exception $e) {
            $_SESSION["logged"] = false;
            header("Location: ?info=Nie+udało+się+zalogować");
        }
    }
    function protocolGETLogin(&$conn, $databaseName) {
        $loginStatus = $_SESSION['logged'] ?? null;
        if($loginStatus === false || is_null($loginStatus)) {
            header("Location: ../index.php?info=Nie zalogowano");
        }

        try {
            if (!empty($_SESSION['username']) && (!empty($_SESSION['password']) || $_SESSION['password']=="")) {
                $conn = new mysqli("localhost", 'root', '', $databaseName);
                $conn->set_charset("utf8");
                if ($conn->connect_error) {
                    throw new mysqli_sql_exception();
                }
            }
        } catch (mysqli_sql_exception $e) {
        } catch (Exception $e) {   
        }
    }
    function getPrivileges(&$conn, &$insert, &$delete, &$update, &$select) {
        if ($conn) {
            $query = "SELECT privilege FROM PRIVILEGES WHERE UserId = '" . $_SESSION['userId'] . "'";
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
    }
    function login(&$conn) {
        $authorizationQuery = "SELECT UserId FROM USERS WHERE username = '" . $_SESSION['username'] . "' AND password = '" . $_SESSION['password'] . "' ";
        $result = $conn->query($authorizationQuery);

        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $_SESSION['userId'] = strval($row['UserId']);
            }
        } else {
            $_SESSION['userId'] = null;
        }


        if ($conn->connect_error || empty($_SESSION['userId'])) {
            throw new mysqli_sql_exception();
        }
        
        if(!$_SESSION["logged"] || $oldUsername!==$_SESSION['username'] || $oldPassword !== $_SESSION['password'])
        {
            $_SESSION["logged"] = true;
            header("Location: ?info=Zalogowano+pomyśnie" . $_SESSION['userId'] . $_SESSION['username'] . " " . $_SESSION['password']);
            exit;
        }
    }
    function register(&$conn) {
        $authorizationQuery = "SELECT UserId FROM USERS WHERE username = '" . $_SESSION['username'] . "'";
        $result = $conn->query($authorizationQuery);
        if($result->num_rows == 0) {
            $addQuery = "INSERT INTO USERS (Username, Password) VALUES ('" . $_SESSION['username'] . "', '" . $_SESSION['password'] . "')";
            $conn->query($addQuery);
            
            $idQuery = "SELECT UserId FROM USERS WHERE username = '" . $_SESSION['username'] . "' AND password = '" . $_SESSION['password'] . "' ";
            $id = $conn->query($idQuery);
    
            if($id->num_rows > 0) {
                while($row = $id->fetch_assoc()) {
                    $_SESSION['userId'] = strval($row['UserId']);
                }
                $privilegeQuery = "INSERT INTO PRIVILEGES (UserId, Privilege) VALUES (" . $_SESSION['userId'] . ", 'all')";
                $conn->query($privilegeQuery);
            }
        }
    }
    function selectTable($formArray, $tableName) {
        
        $selectConditions = [];
    
        foreach ($formArray as $key => $value) {
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
        header("Location: ?info=Wyświetlono+zwierzeta");
        exit;
    }
    function addToTable($formArray, $tableName, &$conn) {
        $insertCols = [];
        $insertVals = [];

        foreach ($formArray as $key => $value) {
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

            header("Location: ?info=Dodano+zwierze");
            exit;
        } else {
            header("Location: ?info=Brak+danych+do+dodania");
            exit;
        }
    }   

    function deleteFromTable($formArray, $tableName, &$conn) {
        $conditions = [];
        foreach ($formArray as $key => $value) {
            if (!empty($value)  || $value === '0') {
                $val = is_string($value) ? "'$value'" : $value;
                $conditions[] = "$key = $val";
            }
        }

        if (count($conditions) > 0) {
            $where = implode(" AND ", $conditions);
            $query = "DELETE FROM $tableName WHERE $where";
            $conn->query($query);
            header("Location: ?info=Usunięto+zwierze(ta)");
            exit;
        } else {
            header("Location: ?info=Brak+danych+do+usunięcia");
            exit;
        }
    }

    function updateTable($updateArray, $whereArray, $tableName, &$conn) {
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
            header("Location: ?info=Zmieniono");
            exit;
        } else {
            header("Location: ?info=Brak+danych+do+zmiany");
            exit;
        }
    }

    function displayTable($tableName, &$conn) {
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
?>
