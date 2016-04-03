<link rel="stylesheet" href="/KarmaFridge/kf.css" type="text/css" />

<?php
// Set Variables

$username="root";
$password="root";
$database="mySQL";

$foodname=$_POST['foodname'];
$description=$_POST['description'];
$servings=$_POST['servings'];
$ingredientnumber=$_POST['ingredientnumber'];
$instructionnumber=$_POST['instructionnumber'];
$filename=$_POST['filename'];

$vegetarian=$_POST['vegetarian'];
$vegan=$_POST['vegan'];
$gf=$_POST['gf'];

if ($vegan == 'on'){
	$vegetarian = 'on';
} 

$i = 0;
$time = 0;
$hours = 0;

// Get Time
while ($i < $instructionnumber){
	$i++;
	$step = $_POST['instruction_step' . $i];
	$time = $time + $step;
}

// Turn minutes into hours and minutes

while ($time >= 60){
	$time = $time - 60;
	$hours = $hours + 1;
}

// Get plurals right.

if ($time > 1){
$time = $time . " minutes";
} elseif ($time == 1){
$time = $time . " minute";	
} else{
	$time = '';
}

if ($time != '' && $hours > 0){
	$time = ' and ' . $time;
}

if ($hours > 1){
	$time = $hours . ' hours' . $time;
} elseif ($hours == 1){
	$time = $hours . ' hour' . $time;
}

// Check the filetype of uploaded file. Ensure it's an accepted image type.

$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 1000000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
      }
    }
  }
else
  {
  $filename ='';
  }

// Connect to mySQL with PDO

$db = new PDO('mysql:host=localhost;dbname=mySQL', $username, $password);

// Insert food into foodie (Main DB)

$stmt = $db->prepare("INSERT INTO foodie VALUES ('','$foodname','$description','$servings','$time','$ingredientnumber','$instructionnumber','$filename','$vegetarian','$vegan','$gf', '0', '0');");

$stmt->execute(array(':foodname'=>$foodname,
                  ':description'=>$description,
                  ':servings'=>$servings,
                  ':ingredientnumber'=>$ingredientnumber,
                  ':instructionnumber'=>$instructionnumber,
                  ':filename'=>$filename,
                  ':vegetarian'=>$vegetarian,
                  ':vegan'=>$vegan,
                  ':gf'=>0,
                  ':stars'=>0,
                  ':stars_num'=>$gf
                  ));

// Get number of rows so we can get the id of the food we just entered 

$id= $db->lastInsertId();


// Create an ingredient database for the food referenced by id.

$ingid = 'ingredient' . $id;

$query="CREATE TABLE `" . $ingid . "` (id int(6) NOT NULL auto_increment,ingredient varchar(40) NOT NULL,amount varchar(30) NOT NULL,PRIMARY KEY (id))";
$sq = $db->query($query);

$i = 0;

while ($i < $ingredientnumber){
	$i++;
	$ingredient=$_POST['ingredient' . $i];
	$amount=$_POST['ingredient_amount' . $i];
	$stmt = $db->prepare("INSERT INTO `" . $ingid . "` VALUES ('','$ingredient','$amount');");
	$stmt->execute(array(':ingredient'=>$ingredient,
                  ':amount'=>$amount
                  ));
}

// Create an instruction database for the food referenced by id.

$instid = 'instruction' . $id;

$query="CREATE TABLE `" . $instid . "` (id int(6) NOT NULL auto_increment,instruction varchar(40) NOT NULL,step varchar(30) NOT NULL,PRIMARY KEY (id))";
$sq = $db->query($query);

$i = 0;

$time = 0;

while ($i < $instructionnumber){
	$i++;
	$instruction=$_POST['instruction' . $i];
	$step=$_POST['instruction_step' . $i];
	$stmt = $db->prepare("INSERT INTO `" . $instid . "` VALUES ('','$instruction','$step');");
	$stmt->execute(array(':instruction'=>$instruction,
                  ':step'=>$step
                  ));
}
?>

<!-- Redirect to index-->

<script>
window.location = 'index.php';
</script>
