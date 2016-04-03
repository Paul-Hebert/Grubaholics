<?
$user="root";
$password="root";
$database="mySQL";
mysql_connect(localhost,$user,$password);
@mysql_select_db($database) or die( "Unable to select database");
$query="CREATE TABLE foodie (id int(6) NOT NULL auto_increment,foodname varchar(40) NOT NULL,description varchar(155) NOT NULL,servings varchar(20) NOT NULL,time varchar(30) NOT NULL,ingredientnumber int(6) NOT NULL,instructionnumber int(6) NOT NULL,filename varchar(40) NOT NULL,vegetarian varchar(5) NOT NULL,vegan varchar(5) NOT NULL,gf varchar(5) NOT NULL,stars int(6) NOT NULL,PRIMARY KEY (id))";
mysql_query($query);
mysql_close();
?>