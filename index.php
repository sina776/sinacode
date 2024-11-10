<?php
class AverageSaver {
    private $connection;

    public function __construct(ConnectionToDatabase $connection) {
        $this->connection = $connection->getConnection();
    }

    public function saveAverage($name,$familyname,$password) {
        $stmt = $this->connection->prepare("INSERT INTO askar (name,familyname,password) VALUES (?,?,?)");
        $stmt->bind_param("sss", $name,$familyname,$password);
        $stmt->execute();
        $stmt->close();
    }
}

class ConnectionToDatabase {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "database";
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
class role{
public $role ;
private $connection;
public function user($role)
{
 $this->role = $name ; 
}
    public function __construct(ConnectionToDatabase $connection) {
        $this->connection = $connection->getConnection();
    }

public function saverole($role) {
    $stmt = $this->connection->prepare("INSERT INTO role (role) VALUES (?)");
    $stmt->bind_param("s", $role);
    $stmt->execute();
    $stmt->close();
}

}
class human{
public $password;	
public $name;
public $familyname;
public function user($name,$familyname,$password)
{
 $this->password = $password;	
 $this->name = $name ;   
 $this->familyname = $familyname ;
}
}
if(isset($_GET['name']) && isset($_GET['family'])  && isset($_GET['password']) && isset($_GET['role'])){
$human = new human ();
$connection = new ConnectionToDatabase();
$averageSaver = new AverageSaver($connection);
$role = new role ($connection);
$human->name=$_GET['name'];
$human->familyname=$_GET['family'];
$human->password=password_hash($_GET['password'], PASSWORD_DEFAULT);
$role->role=$_GET['role'];

$averageSaver->saveAverage($human->name,$human->familyname,$human->password);
$role->saverole($role->role);
$connection->getConnection()->close();
}
?>

<body  style="border:2px solid Tomato; text-align:center;">
<h1 style="color:blue;">sina</h1>
<hr style="border:2px solid blue;">
<h1 style="color:blue;">gholami</h1>
<hr style="border:2px solid blue;">
<h1 style="color:green;">sepehr</h1>
<h1 style="border:2px solid blue;">
<img src="Registet.jpg" width="200" height="200">

<form method="get" active="" style="text-align:center;">
<input type='text' name="pish" list="list" id="role"><br>
<select id="role" name="role">
<option value="مدیر">مدیر</option>
<option value="ناظم">ناظم</option>
<option value="معاون">معاون</option>  
<option value="معلم">معلم </option>
<option value="سرایدار">سرایدار</option>
<option value="مشاور">مشاور</option>
<option value="معاون اجاریی">معاون اجرایی</option>
<option value="سرپرست کارگاه">سرپرست کارگاه</option>
<option value="دانش اموز">دانش اموز</option>
</select>
<input type='password' name="password" placholder="password" id="password"><lable>رمز عبور</lable><br>
<input type='text' name="name" placholder="name" id="name"><lable></lable>نام<br>
<input type='text' name="family" placholder="family" id="family"><lable>نام خانوادگی</lable><br>
<input type='submit' value="send" ><br>
</form>
<p><?php echo "<h1 style= 'color:red; text-align:center;'>parscode</h1>"; 
?> </p>