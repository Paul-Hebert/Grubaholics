
<?php
// Set Login Variables and Query
$username="root";
$password="root";
$database="mySQL";

$db = new PDO('mysql:host=localhost;dbname=mySQL', $username, $password);


	$sql = "SELECT * FROM foodie ORDER BY stars DESC, filename";
	$stmt = $db->prepare($sql);
	$stmt->execute();

	$results = $stmt->fetchAll();

	foreach($results as $row){
		echo "<a href='recipe.php?id=" . $row[id] . "' class=' recipes ";
		if ($row[vegetarian]== 'on'){
 			echo " vegetarian";
		} 
		if ($row[vegan]== 'on'){
			echo " vegan";
		} 
		if ($row[gf]== 'on'){
			echo " gf";
		} 
		echo "' id='" . $row['foodname'] . $row['id'] . "'>";
			echo "<div class='row'><div class='col-4 stretch-6'>";
				echo "<h2>" . $row['foodname'] . "</h2>";
				echo "<div class='browse_stars'>";
				$stars = round($row["stars"]);
				if ($stars != 0){
					for($count = 1; $count <= $stars; $count ++){
						if ( $count & 1 ) {
						echo "<div class='starleft'>&nbsp</div>";
						} else {
						echo "<div class='starright'>&nbsp</div>";
						}
					}
					while ($count <= 10){
						if ( $count & 1 ) {
						echo "<div class='star2left'>&nbsp</div>";
						} else {
						echo "<div class='star2right'>&nbsp</div>";
						}
						$count++;				
					}
				} else {
					echo "<span class='italic'>Unrated</span>";
				}
			echo "</div></div>";
			echo "<div class='col-5 big'>";
				echo "<span>";
					echo $row["description"];
					if ($row['description'] != ''){
						echo '...<br />';
					}
					echo '<span class="italic">' . $row["time"] .'</span>';
				echo "</span>";
			echo "</div><br class='small'/>";
			echo "<div class='col-3 stretch-6'>";
				if (!$row["filename"]){
					echo '<span class="italic">No image uploaded.</span>';
				} else{
					$filename = "<img src ='upload/";
					$filename = $filename . $row["filename"];
					$filename = $filename . "' />";
					echo $filename;
				}
			echo "</div></div>";
		echo "<hr/>";
		echo "</a>";
	}
?>