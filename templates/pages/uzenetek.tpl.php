<!-- <?php
	try {
		// Kapcsolódás
		$pdo = new PDO('mysql:host=localhost;dbname=gyakorlat7', 'root', '',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
		$pdo->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
		$utasitas = "Select id, felhasznalonev, nev, email, szoveg From kapcsolat order by idopont desc";
		$eredm = $pdo->query($utasitas);
		foreach ($eredm as $sor) 
			print $sor['id'] . " " .$sor['felhasznalonev'] . " " .$sor['nev'] . " " .$sor['email'] . " " .$sor['szoveg'] . "<br>";
	}
	catch (PDOException $e) {
		echo "Hiba: ".$e->getMessage();
	}      
?> -->
<html>
<body>
    <h1>Üzenetek</h1>
    <table width = "auto" height = "auto" align="center" border="2" >
        <tr bgcolor="#5f9ea0">
            <td>Időpont</td>
            <td>Felhasználónév</td>
            <td>Név</td>
            <td>Email cím</td>
            <td>Üzenet</td>
        </tr>

        <?php
            $pdo = new PDO('mysql:host=localhost;dbname=gyakorlat7', 'root', '',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
            $pdo->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
            $utasitas = "Select id, idopont, felhasznalonev, nev, email, szoveg From kapcsolat order by idopont desc";
            $eredm = $pdo->query($utasitas);
            foreach ($eredm as $sor) {
                printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",  
                $sor['idopont'], $sor['felhasznalonev'],$sor['nev'],$sor['email'],$sor['szoveg']);
            }
        ?>
    </table>
 </body>
</html>
