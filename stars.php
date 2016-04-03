<?php
$username="root";
$password="root";
$database="mySQL";

$foodid=$_GET['id'];

$stars=$_GET['stars'];

if ($stars > 0 && $stars < 11){
	$db = new PDO('mysql:host=localhost;dbname=mySQL', $username, $password);

	$db = new PDO('mysql:host=localhost;dbname=mySQL', $username, $password);

	$sql = "SELECT * FROM foodie WHERE id='" . $foodid . "' LIMIT 1";
	$stmt = $db->prepare($sql);
	$stmt->execute();

	$row = $stmt->fetch();

	$oldstars = $row['stars']*$row['stars_num'];

	$stars_num = $row['stars_num'] + 1;

	$stars = ($stars + $oldstars)/$stars_num;

	$sql = "UPDATE foodie SET stars ='" . $stars . "', stars_num = '" . $stars_num  ."' WHERE id='" . $foodid . "' LIMIT 1";
	$stmt = $db->prepare($sql);
	$stmt->execute();
}

echo "<script>
window.location = 'recipe.php?id=". $foodid ."';
</script>"
?>