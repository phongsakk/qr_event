<?php
class phongsak extends mysqli
{
    function __construct(?string $host = "localhost", ?string $username = "root", ?string $passwd = "", ?string $dbname = "db_event", ?int $port = null, ?string $socket = null)
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        date_default_timezone_set("Asia/Bangkok");
        try {
            parent::__construct($host, $username, $passwd, $dbname, $port, $socket);
            parent::set_charset("utf8mb4");
        } catch (mysqli_sql_exception $e) {
            error_log($e->getMessage());
            exit();
        }
    }

    function __destruct()
    {
        parent::close();
    }

    function __query(string $query, ?array $binder = array()): ?array
    {
        $mysqli_stmt = parent::prepare($query);

        if (count($binder)) {
            $types = "";
            foreach ($binder as $b) {
                $types .= (is_numeric($b)) ? ((is_float($b)) ? "d" : "i") : "s";
            }
            echo "<pre>";
            var_export($types);
            var_export($binder);
            echo "</pre>";
            $mysqli_stmt->bind_param($types, ...$binder);
        }
        try {
            if (!$mysqli_stmt->execute()) throw new mysqli_sql_exception("");
        } catch (mysqli_sql_exception $e) {
            $this->__log($e->getMessage());
        }

        $this->result = false;
        if ($this->mysqli_resullt = $mysqli_stmt->get_result()) $this->result = $this->mysqli_resullt->fetch_all(MYSQLI_ASSOC);

        if (!is_countable($this->result)) return null;

        if (count($this->result) === 1) return $this->result[0];

        return $this->result;
    }

    function __log($msg): void
    {
        echo "<script>console.log(" . json_encode($msg) . ")</script>";
    }
}
