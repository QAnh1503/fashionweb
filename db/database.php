<?php
// db/database.php
global $connection;

function db_query($query) {
    global $connection;
    $result = pg_query($connection, $query);
    if (!$result) {
        die("❌ Query error: " . pg_last_error($connection));
    }
    return $result;
}

function db_fetch_row($query) {
    $result = db_query($query);
    $row = pg_fetch_assoc($result);
    pg_free_result($result);
    return $row;
}

function db_fetch_array($query) {
    $result = db_query($query);
    $data = [];
    while ($row = pg_fetch_assoc($result)) {
        $data[] = $row;
    }
    pg_free_result($result);
    return $data;
}

function db_num_rows($query) {
    $result = db_query($query);
    $count = pg_num_rows($result);
    pg_free_result($result);
    return $count;
}

function db_insert($table, $data) {
    global $connection;
    $columns = implode(", ", array_keys($data));
    $values = array_map(function($value) use ($connection) {
        return "'" . pg_escape_string($connection, $value) . "'";
    }, array_values($data));
    $values = implode(", ", $values);
    $query = "INSERT INTO $table ($columns) VALUES ($values)";
    $result = pg_query($connection, $query);
    if (!$result) {
        die("❌ Insert error: " . pg_last_error($connection));
    }
    return true;
}

function db_update($table, $data, $where) {
    global $connection;
    $updates = [];
    foreach ($data as $col => $value) {
        $updates[] = "$col='" . pg_escape_string($connection, $value) . "'";
    }
    $update_str = implode(", ", $updates);
    $query = "UPDATE $table SET $update_str WHERE $where";
    $result = pg_query($connection, $query);
    if (!$result) {
        die("❌ Update error: " . pg_last_error($connection));
    }
    return pg_affected_rows($result);
}

function db_delete($table, $where) {
    $query = "DELETE FROM $table WHERE $where";
    $result = db_query($query);
    return pg_affected_rows($result);
}
?>
