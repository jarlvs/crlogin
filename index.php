<!DOCTYPE html>
<html>
<body>

<?php 

// Define your username and password 
$username = ""; 
$password = ""; 

if ($_POST['txtUsername'] != $username || $_POST['txtPassword'] != $password) { 

?> 

<h1>Login</h1> 

<form name="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
    <p><label for="txtUsername">Username:</label> 
    <br /><input type="text" title="Enter your Username" name="txtUsername" /></p> 

    <p><label for="txtpassword">Password:</label> 
    <br /><input type="password" title="Enter your password" name="txtPassword" /></p> 

    <p><input type="submit" name="Submit" value="Login" /></p> 

</form> 

<?php 

} 
else { 

?> 

<p>This is the protected page. Your private content goes here.</p> 

<?php
echo "<table style='border: solid 1px black;'>";
 echo "<tr><th>Name</th><th>Email</th><th>Phone</th><th>college</th><th>year</th><th>fbid</th></tr>";

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='width: 150px; border: 1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 

$servername = "localhost";
$username = "betaform";
$password = "";
$dbname = "betaform";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT name, email, phone, college, year, fbid FROM crdata"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
        
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?> 

<?php 

} 

?> 



</body>
</html>