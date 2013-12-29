<?php
//phpinfo();
$dbName =   'db/exp.mdb';
echo $dbName;
if (!file_exists($dbName)) {
    die("Could not find database file.");
}
echo 'eh';
$db = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=$dbName; Uid=; Pwd=;");
echo 'ehddddd';
print_r($db);

$sql  = "SELECT * FROM yaolsy";
//$sql .= " WHERE id = 20081";
 
$result = $db->query($sql);
$row = $result->fetch();
print_r($row); 
echo $row[1];
?>
