

<?php include 'header.php';

$foodid=$_GET['id'];

$username="root";
$password="root";
$database="mySQL";

$db = new PDO('mysql:host=localhost;dbname=mySQL', $username, $password);


$sql = "SELECT * FROM foodie WHERE id='" . $foodid . "' LIMIT 1";
$stmt = $db->prepare($sql);
$stmt->execute();

$row = $stmt->fetch();


if ($row['filename'] !== ''){
	$filename = '<img src="/KarmaFridge/upload/' . $row['filename'] . '" class="thumbnail stretch-12"/>';
}
$ingid = 'ingredient' . $row['id'];
$instid = 'instruction' . $row['id'];
?>
		<h1 class="col-6 stretch-12">	
			<?php echo $row['foodname']; ?>
		</h1> 
		<div class="recipe_stars stretch-12">
		<?php
		$stars = round($row["stars"]);
			for($count = 1; $count <= $stars; $count ++){
				if ( $count & 1 ) {
					echo "<div class='starleft' onmouseover='starHover(". $count .");' onclick='starClick(". $count .");' onmouseout='starHover(". $stars .");' id='". $count ."'>&nbsp</div>";
				} else {
					echo "<div class='starright' onmouseover='starHover(". $count .");' onclick='starClick(". $count .");' onmouseout='starHover(". $stars .");' id='". $count ."'>&nbsp</div>";					
				}
			}
			while ($count <= 10){
				if ( $count & 1 ) {
					echo "<div class='star2left' onmouseover='starHover(". $count .");' onclick='starClick(". $count .");' onmouseout='starHover(". $stars .");' id='". $count ."'>&nbsp</div>";
				} else {
					echo "<div class='star2right' onmouseover='starHover(". $count .");' onclick='starClick(". $count .");' onmouseout='starHover(". $stars .");' id='". $count ."'>&nbsp</div>";					
				}
				$count++;				
			}
			
		$stars2 = $row['stars']/2;
		echo '(' . $stars2 . '/5)';
		echo '<br />
			<span class="italic">Based off of ' . $row["stars_num"];
		if ($stars == 1){
			echo ' vote.</span>';
		} else{
			echo ' votes.</span>';
		}	
		echo 	'<br/>
			<a href="stars.php?id='. $foodid .'&stars=0"; class="submit" id="submit">Confirm Rating</a>';
		?>
		</div>
		<hr />
		<p>
			<?php echo $row['description']; ?> 
		</p> 
		<hr/>
							
		<?php echo $filename ?>
		<h2>Ingredients:</h2>
<?php
// Query new databases (ingredient# and instruction#). Write to new page.
// Ingredients
	$sql = "SELECT * FROM " . $ingid . "";
	$stmt = $db->prepare($sql);
	$stmt->execute();

	$ingredients = $stmt->fetchAll();

	foreach ($ingredients as $row) {
	    echo $row["ingredient"] . " - " . $row["amount"] ."<br/>";
	}

// Instructions
	echo '<hr/><h2>Instructions:</h2>';

	$sql = "SELECT * FROM " . $instid . "";
	$stmt = $db->prepare($sql);
	$stmt->execute();

	$instructions = $stmt->fetchAll();


	foreach ($instructions as $row) {
	    $page= $row["instruction"];
	    if ($row["step"] != ''){
	    	$page = $page . " - " . $row["step"] ." minutes";
	    }
	    $page = $page . "<br/>";
		echo $page;
	}
// Close open tags.
?>
	</div>
<?php include 'footer.php';?>
