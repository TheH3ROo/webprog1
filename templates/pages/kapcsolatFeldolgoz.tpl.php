<?php session_status(); ?>
<?php
    try 
    {
        $dbh = new PDO('mysql:host=localhost;dbname=gyakorlat7', 'root', '',
        array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
    }
    catch (PDOException $e) 
    {
        $uzenet = "Hiba: ".$e->getMessage();
        $ujra = true;
    }  
    
    if (isset($_SESSION['login']))
    {
        $felhasznalo = $_SESSION['login'];
    }
    else $felhasznalo = 'Vendég';

    $sqlInsert = "insert into kapcsolat(id, felhasznalonev, nev, email, szoveg) values(0, :felhasznalonev, :nev, :email, :szoveg)";
    $stmt = $dbh->prepare($sqlInsert); 
    $stmt->execute(array(':nev' => $_POST['nev'], ':email' => $_POST['email'],':szoveg' => $_POST['szoveg'], ':felhasznalonev' => $felhasznalo)); 
    if($count = $stmt->rowCount()) {
        $newid = $dbh->lastInsertId();
        $uzenet = "Az üzenetküldés sikeres.<br>Azonosítója: {$newid}";                     
        $ujra = false;
    }
    else {
        $uzenet = "A üzenetküldés nem sikerült.";
        $ujra = true;
    }
?>              

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
<?php
	//szerver oldali ellenőrzés

	if(!isset($_POST['nev']) || strlen($_POST['nev']) < 5)
	{
		exit("Hibás név: ".$_POST['nev']);
	}

	$re = '/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/';
	if(!isset($_POST['email']) || !preg_match($re,$_POST['email']))
	{
		exit("Hibás email: ".$_POST['email']);
	}

	if(!isset($_POST['szoveg']) || empty($_POST['szoveg']))
	{
		exit("Hibás szöveg: ".$_POST['szoveg']);
	}

	echo "Kapott értékek: ";
	echo "<pre>";
	var_dump($_POST);
	echo "</pre>";
?>
	</body>
</html>
