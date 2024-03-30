<?php

namespace Services;

class DBService {
    public static $connection;

    public static function connect(): \PDO {
        $host = 'sql.freedb.tech';
        $database = 'freedb_todophp';
        $username = 'freedb_phpproject';
        $password = 'NBK#4fGNQC%3zQp';
        
        try {
            self::$connection = new \PDO("mysql:host=$host;dbname=$database", $username, $password);
            
        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return self::$connection;
    }
    
    public static function insert($table, $cols, $vals) {{
        // Convert $cols array into a comma-separated string
        $columns = implode(", ", $cols);

        // Create parameterized SQL statement
        $sql = "INSERT INTO $table ($columns) VALUES (";
        $placeholders = array_fill(0, count($vals), '?');
        $sql .= implode(', ', $placeholders);
        $sql .= ")";

        try {
            // Prepare SQL statement
            $stmt = self::$connection->prepare($sql);

            // Execute statement with values
            $stmt->execute($vals);

            return true;
        } catch (\PDOException $e) {
            error_log($e);
            return false;
        }
    }
}

      public static function delete($table, $val)  {
        $sql = "DELETE FROM $table WHERE todo_id = ?";
        $stmt = self::$connection->prepare($sql);
        $stmt->execute([$val]);
        return true;
    
        /*
                Create a parameterized DELETE FROM table statement using $table, and the column names in $cols,
                then call prepare() and execute() on the $connection property as above
            */
      }

    public static function all($table)   {
        $sql = "SELECT * FROM $table";
        $statement = self::$connection->query($sql, \PDO::FETCH_ASSOC);
        $data = $statement->fetchAll();
        return $data;
        /*
                Create a SELECT * FROM $table statement,
                then call the query() method on the $connection property, passing in:
                    the sql string
                    the \PDO:FETCH_ASSOC constant, which ensures the results are returned as an associative array
                
                The query() method returns a PDO statement object - store that object in a variable, then
                call its fetchAll() method to get the actual array of rows
    
                Finally, return the array of rows
            */
      }
};

?>
     