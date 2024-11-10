<?php

class ConnectionToDatabase {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "test_db";
    private $connection;

    public function __construct() {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function getConnection() {
        return $this->connection;
    }
}

class Sum {
    public function calculate($array) {
        return array_sum($array);
    }
}

class Count {
    public function calculate($array) {
        return count($array);
    }
}

class CalculateAverage {
    private $sum;
    private $count;

    public function __construct(Sum $sum, Count $count) {
        $this->sum = $sum;
        $this->count = $count;
    }

    public function average($array) {
        $totalSum = $this->sum->calculate($array);
        $totalCount = $this->count->calculate($array);
        return $totalCount > 0 ? $totalSum / $totalCount : 0;
    }
}

class AverageSaver {
    private $connection;

    public function __construct(ConnectionToDatabase $connection) {
        $this->connection = $connection->getConnection();
    }

    public function saveAverage($average) {
        $stmt = $this->connection->prepare("INSERT INTO averages (average_value) VALUES (?)");
        $stmt->bind_param("d", $average);
        $stmt->execute();
        $stmt->close();
    }
}

// استفاده از کلاس‌ها
$array = [10, 20, 30, 40, 50];

$connection = new ConnectionToDatabase();
$sum = new Sum();
$count = new Count();
$calculateAverage = new CalculateAverage($sum, $count);
$averageSaver = new AverageSaver($connection);

$average = $calculateAverage->average($array);
$averageSaver->saveAverage($average);

echo "Average: " . $average;

// بستن اتصال به پایگاه داده
$connection->getConnection()->close();
?>
