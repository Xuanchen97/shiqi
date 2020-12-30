

<?php 
// DB credentials.
define('DB_HOST', 'jhdjjtqo9w5bzq2t.cbetxkdyhwsb.us-east-1.rds.amazonaws.com');
define('DB_USER', 'o1yjtwpo7v3e7ekv');
define('DB_PASS', 'mlyvhljfy0tdsw0y');
define('DB_NAME', 'kzt4tyivwvxhpaxb');

// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
?>