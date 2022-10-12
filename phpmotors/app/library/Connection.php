<?php

/**
 *
 */
class Connection
{
    /**
     * @var
     */
    protected $conn;

    /**
     * @var bool
     */
    private $requireWhere = false;

    /**
     * @var bool
     */
    private $deleting = false;

    /**
     * @var
     */
    public $sql;
    /**
     * @var string
     */
    protected $table = '';
    /**
     * @var array
     */
    protected $where = [];
    /**
     * @var string
     */
    protected $whereString = '';

    /**
     * @return PDO|void
     * @throws Exception
     */
    public static function connect()
    {
        $host = "db";
        $db = "phpmotors";
        $user = "vmsfig";
        $password = "300399aa";
        try {
            return new PDO("mysql:host={$host};dbname={$db}", $user, $password);
        } catch (PDOException $e) {
            throw new Exception("Cannot connect to DB.");
        }
    }

    /**
     * @return void
     */
    private function verifySql()
    {
        /* Security Checkers */
        if ($this->requireWhere) {
            if (count($this->where) == 0) {
                $this->redirectWithError("Please specify a where clause when deleting records.", 2);
            }
        }
        if ($this->deleting) {
            if (!$this->registryExists("SELECT 1 FROM {$this->table} {$this->whereString}")) {
                $this->redirectWithError("Record not found.", 2);

            }
        }
    }

    /**
     * @param $fetchMode
     * @return false|PDOStatement
     */
    public function execute($fetchMode = PDO::FETCH_OBJ)
    {
        $this->verifySql();
        return self::connect()->query($this->sql . ";", $fetchMode);
    }

    /**
     * @return string
     */
    public function getSql()
    {
        $this->verifySql();
        return $this->sql . ";";
    }

    /**
     * @param $table
     * @return bool
     */
    public function tableExists($table)
    {

        // Try a select statement against the table
        // Run it in try-catch in case PDO is in ERRMODE_EXCEPTION.
        try {
            $result = self::connect()->query("SELECT 1 FROM {$table} LIMIT 1");
        } catch (Exception $e) {
            // We got an exception (table not found)
            return FALSE;
        }

        // Result is either boolean FALSE (no table found) or PDOStatement Object (table found)
        return $result !== FALSE;
    }

    /**
     * @param $sql
     * @return bool
     */
    private function registryExists($sql)
    {
        $verify = self::connect()->query($sql);
        if ($verify->rowCount() > 0) {
            return true;
        }
        return false;
    }

    /**
     * @param $error
     * @param $backtrace
     * @return void
     */
    public function redirectWithError($error, $backtrace = 1)
    {
        $error = urlencode($error);
        $file = urlencode(basename(debug_backtrace()[$backtrace]['file']));
        $line = debug_backtrace()[$backtrace]['line'];
        header('Location: ' . "/?action=500&error=$error&file=$file&line=$line");
        die();
    }

    /**
     * @param array $where
     * @return $this
     * @throws Exception
     */
    public function where(array $where)
    {
        $loop = 0;
        $sql = "";
        foreach ($where as $column => $value) {
            $operator = "=";
            if (is_array($value)) {
                if (count($value) == 2) {
                    $operator = $value[0];
                    $value = $value[1];
                } elseif (count($value) == 1) {
                    $value = $value[0];
                } else {
                    throw new Exception("Where clauses must be a string or array with 2 indexes.");
                }
            }
            if ($loop > 0) {
                $sql .= " AND {$column} {$operator} '{$value}'";
            } else {
                $sql .= " WHERE {$column} {$operator} '{$value}'";
            }
            $loop++;
        }
        $this->sql .= $sql;
        $this->where = $where;
        $this->whereString = $sql;
        return $this;
    }

    /**
     * @param array $order
     * @return $this
     */
    public function orderBy(array $order)
    {
        $loop = 0;
        $sql = "";
        foreach ($order as $column => $order) {
            if ($loop > 0) {
                $sql .= ", {$column} {$order}";
            } else {
                $sql .= " ORDER BY {$column} {$order}";
            }
            $loop++;
        }
        $this->sql .= $sql;
        return $this;

    }

    /**
     * @param int $limit
     * @return $this
     */
    public function limit(int $limit)
    {
        $this->sql .= " LIMIT {$limit}";

        return $this;
    }

    /**
     * @param string $table
     * @param string $on
     * @return $this
     */
    public function innerJoin(string $table, string $on)
    {
        $this->sql .= " INNER JOIN {$table} ON {$on}";

        return $this;
    }

    /**
     * Insert a custom SQL into SQL.
     * @param string $sql
     * @return $this
     */
    public function sql(string $sql)
    {
        $this->sql .= $sql;

        return $this;
    }

    /*   CRUD   */

    /**
     * @param string $intoTable
     * @param array $data
     * @return $this
     */
    public function insert(string $intoTable, array $data)
    {
        if ($this->tableExists($intoTable)) {
            $sql = "INSERT INTO {$intoTable} ";
            $values = [];
            $columns = [];
            foreach ($data as $column => $value) {
                $columns[] = "{$column}";
                $values[] = "'{$value}'";
            }
            $sql .= "(" . implode(', ', $columns) . ")";
            $sql .= " VALUES (" . implode(', ', $values) . ")";
            $this->sql = $sql;
        } else {
            $this->redirectWithError("Table $intoTable doesn't exists.");
        }
        return $this;
    }

    /**
     * @param string $table
     * @param array|null $columns
     * @return $this|void
     */
    public
    function select(string $table, array $columns = [])
    {
        if ($this->tableExists($table)) {
            if (count($columns) == 0) {
                $columns = "*";
            } else {
                $columns = implode(", ", array_map(function ($item) {
                    return "$item";
                }, $columns));
            }
            $this->sql = "SELECT {$columns} FROM {$table}";
            $this->table = $table;
        } else {
            $this->redirectWithError("Table $table doesn't exists.");
        }
        return $this;
    }

    /**
     * @param string $table
     * @param array $set
     * @param bool $enclose
     * @param bool $safeMode
     * @return $this|void
     */
    public function update(string $table, array $set, bool $enclose = true, bool $safeMode = true)
    {
        if ($this->tableExists($table)) {
            $loop = 0;
            $sql = "UPDATE {$table} SET";
            foreach ($set as $column => $value) {
                if ($loop > 0) {
                    $sql .= ", ";
                }
                if ($enclose) {
                    $sql .= " $column = '$value'";
                } else {
                    $sql .= " $column = $value";
                }
                $loop++;
            }
            $this->requireWhere = $safeMode;
            $this->sql = $sql;
            return $this;
        } else {
            $this->redirectWithError("Table $table doesn't exists.");
        }
    }

    /**
     * @param string $fromTable
     * @return $this
     */
    public
    function delete(string $fromTable)
    {
        if (!$this->tableExists($fromTable)) {
            $this->redirectWithError("Table {$fromTable} doesn't exists.");
        }
        $this->deleting = true;
        $this->requireWhere = true;

        $this->table = $fromTable;
        $this->sql = "DELETE FROM {$fromTable}";

        return $this;
    }
}