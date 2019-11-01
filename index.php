<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

?>
<!DOCTYPE html>  
 <html lang="fi">  
    <head>  
      	<meta charset="utf-8">
       	<title>tilikauha.fi</title>  
      	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="">
        <meta name="description" content="">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	  	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
	  	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
	  	 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 


</head>  
<body>
<!--navbar start-->
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
			</button>
			<img target="blank" class="navbar-logo" src="tilikauhaSmallLogo.png" alt="logo">
			<a href="index.php" style="color:black;" class="navbar-brand">Tilikauha.fi</a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a class="smoothScroll" href="#">
					<span class="glyphicon glyphicon-log-in"></span> Kirjaudu 
					</a>
				</li>
			</ul>
	</div>
</nav>
<!--navbar finish-->
<div class="container">
<style>
html,
body {
  margin: 0;
  padding: 0;
}

.section {
  width: 100%;
}

.container {
  position: relative;
  width: 1170px;
  margin: 0 auto;
  color: #444;
  font-size: 14px;
  font-weight: 300;
  font-family: Roboto, 'Open Sans', Arial, sans-serif;
  overflow: hidden;
}

.section .container {
  padding: 30px 0 50px 0;
}

.section.bg {
  background: #f7f7f7;
}

.section .slider,
.section .footer {
  background: #333;
}

.slidercontent {
  text-align: center;
}

.hero {
  font-family: 'Roboto Slab', sans-serif;
  color: white;
  font-weight: normal;
  letter-spacing: 1px;
}

h1.hero {
  font-size: 54px;
  text-align:justify
}

h2.hero {
  font-size: 30px;
  margin-top: 45px;
  text-align:justify

}

h2.hero:after {
  content: "";
  width: 300px;
  position: relative;
  border-bottom: 1px solid #aaa;
  text-align: center;
  margin: auto;
  margin-top: 15px;
}
.call {
  color: white;
  display: block;
  margin-bottom: 20px;
}

.call span {
  display: inline;
  border: 1px solid white;
  padding: 8px 13px;
  font-size: 20px;
  transition: background 0.15s linear;
}

.call span:hover {
  background: rgba(255, 255, 255, 0.1);
  cursor: pointer;
}

li {
  color: white; /* bullet color */
 text-align:justify
}
/* finish */
	
	
.myButton {
	box-shadow: 0px 10px 14px -7px #276873;
	background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
	background-color:#599bb3;
	border-radius:8px;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:14px;
	font-weight:bold;
	padding:5px 4px;
	text-decoration:none;
	text-shadow:0px 1px 0px #3d768a;
}
.myButton:hover {
	background:linear-gradient(to bottom, #408c99 5%, #599bb3 100%);
	background-color:#408c99;
}
.myButton:active {
	position:relative;
	top:1px;
}
.red{
	color: red;
}

</style>
<!-- User guide start -->
<div class="section">
  <div class="slider">
    <div class="container slidercontent">
      <h2 class="hero">TKO- Tilikauha kirjanpito ohjelma käyttöohje</h2>
     	 <ol>
		  <li>Valitse CSV-tiedosto ja paina luo painnikke</li>
		  <li>Syöttää tarvitteassa jokaiselle riville kahden ALV arvoja muodossa 12,00-13,00</li>
		  <li>Paina "Lähetä" painikke joka löytyy viimeisen rivin jälkeen</li>
		  <li>Tarkista muokattu rivit ja lataa muokattu CSV tiedosto</li>
		  <li>Voit tarvitteassa avata CSV-tiedosto LibreOffice tai Excel kautta (sarake erotettu puolipisteellä)</li>
		  <li>Huomaa! luotu CSV-tiedosto sisältää muokattu rivit sekä muuntamattomia riviä</li>
		  <li>Huomaa! Ohjelma ei voi käyttää samaa aikaa enemmän kuin yksi työntekijä.</li>	
  		</ol>
  		<div class="call">
  			<a href="tel:0408615665" class="smoothScroll btn btn-default">Soita</a>
  		</div>
  	</div>
  </div>
</div>
<!-- User guide finish -->
<?php
echo '<form action="index.php" method="post" enctype="multipart/form-data">
 Valitse CSV tiedosto: <input  type="file" name="upload_file" />
 <h2 class="red">1</h2><input class="myButton" type="submit" value="luo" />
</form>';

if(isset($_POST['alv14'])){
	//echo "clicked";
}else{

$csv_array = Array();

$file = fopen($_FILES['upload_file']['tmp_name'], 'r');
if($file){
    while (($line = fgetcsv($file, 0, ';')) !== FALSE) {
      //$line is an array of the csv elements
      array_push($csv_array,$line);
    }
    fclose($file);
}

echo '<pre>';
//print_r($csv_array);
echo '</pre>';

$file_input = fopen('file3.csv', 'w');
foreach ($csv_array as $row) {
       //fputcsv($file_input, $row);
       fputcsv($file_input, $row,';','"');
}

// start of program
//echo "not clicked";
}


$csv = array_map(function($v){return str_getcsv($v, ";");}, file('file3.csv'));
//$csv = array_map('str_getcsv', file('file2.csv')); //  if CSV is separeted by comma
echo '<table border="1px" cellpadding="4" cellspacing="50">
<h3>Löydetty rivit muokkaukselle</h3>
<tr>
<td>ID</td>
<td>PVM</td>
<td>TOSITELAJI</td>
<td>VÄLI</td>
<td>VÄLI</td>
<td>KUITIN NIMI</td>
<td>SELITE</td>
<td>TILINUMERO 1</td>
<td>TILINUMERO 2</td>
<td>SUMMA</td>
<td>ALV 24-14</td>
</tr>
';

foreach($csv as $location => $data){
	if ( ! isset($data[7])) {
	   $data[7] = null;
	}
	if ( ! isset($data[5])) {
	   $data[5] = null;
	}

	if($data[7] == 4002) {
			// add value and key to "result" array 
			$row0 = array(
				"id" => $data[0],
				"date" => $data[1],
				"number" => $data[2],
				"empty1" => $data[3],
				"empty2" => $data[4],
				"name" => $data[5],
				"info" => $data[6],
				"code1" => $data[7],
				"code2" => $data[8],
				"price" => $data[9]
			);
			$array[] = $row0;
	}elseif($data[5] == "DELIVERO HERO FINLAND OY"){
			// add value and key to result array 
			$row3 = array(
				"id" => $data[0],
				"date" => $data[1],
				"number" => $data[2],
				"empty1" => $data[3],
				"empty2" => $data[4],
				"name" => $data[5],
				"info" => $data[6],
				"code1" => $data[7],
				"code2" => $data[8],
				"price" => $data[9]
			);
			$array[] = $row3;		
	}else{
			$row4 = array(
				"id" => $data[0],
				"date" => $data[1],
				"number" => $data[2],
				"empty1" => $data[3],
				"empty2" => $data[4],
				"name" => $data[5],
				"info" => $data[6],
				"code1" => $data[7],
				"code2" => $data[8],
				"price" => $data[9]
			);
			$arrayOfUnneededRows[] = $row4;		
	}
			$alv14 = "";
			$alv24 = "";
}

//echo '<pre>';
//echo '<h1>unneededarray:</h1>';
//print_r ($arrayOfUnneededRows);
//echo '</pre>';

$row = "";
echo '<form action="index.php" method="post">';
foreach($array as $key2=>$row2){
    	echo "<tr>";
	        echo '<td>'.$row2['id'].'</td>';
			echo '<td>'.$row2['date'].'</td>';
			echo '<td>'.$row2['number'].'</td>';
			echo '<td>'.$row2['empty1'].'</td>';
			echo '<td>'.$row2['empty2'].'</td>';
			echo '<td>'.$row2['name'].'</td>';
			echo '<td>'.$row2['info'].'</td>';
			echo '<td>'.$row2['code1'].'</td>';
			echo '<td>'.$row2['code2'].'</td>';
			echo '<td>'.$row2['price'].'</td>';
			echo '<td><input type="text" name="alv14['.$row2['id'].']" maxlength="35" size="10"></td>';	
	 	 echo "</tr>";
    }
echo '<td><h2 class="red">2</h2><input type="submit" class="myButton" value="Lähetä"></td>';
echo "</table>";
//print "<pre>";
//print_r($_POST); //$_POST['alv14'];
//print "</pre>";
/*-----------get input values ------------*/
foreach( $_POST as $key) {
    if( is_array( $key ) ) {
    	$arrayForValue = [];
        foreach( $key as $value ) {
            $myString = $value;
			$myArray = explode('-', $myString);
		    //print_r($myArray);
		    $arrayForValue[] = $myString;
        }
    } else {
    	//print_r($key); // $key;
    }
    //print_r($key);//$key;
}
//print_r($arrayForValue);

/*-------- explode value (-) and insert each as key id ------- */
$lastArray = [];
foreach($key as $key1=>$value1){
		// separate value - 
		$tags = explode('-',$value1);
		$lastArray[$key1] = []; 
		foreach($tags as $value) {
			$lastArray[$key1][] = $value;  
		}
}



//print "<pre>";
//print_r($lastArray);
//print "</pre>";

/* --------insert input values in row copies ------*/
//$csvFile = array_map('str_getcsv', file('file2.csv'));

$arrayFull = [];
$csvFile = array_map(function($v){return str_getcsv($v, ";");}, file('file3.csv'));
echo '<table border="1px" cellpadding="4" cellspacing="50">
<h3>Muokattu rivit. Ole hyvä tarkista ja lataa CSV-tiedosto</h3>
<tr>
<td>ID</td>
<td>PVM</td>
<td>TOSITELAJI</td>
<td>VÄLI</td>
<td>VÄLI</td>
<td>KUITIN NIMI</td>
<td>SELITE</td>
<td>TILINUMERO 1</td>
<td>TILINUMERO 2</td>
<td>SUMMA</td>
</tr>
';
foreach($csvFile as $location => $data){
	if ( ! isset($data[7])) {
	   $data[7] = null;
	}
	if($data[7] == 4002) {
		if(!empty($lastArray[$data[0]][0]) or !empty($lastArray[$data[0]][1])){
			// add value and key to result array 
			$row0 = array(
				"id" => $data[0],
				"date" => $data[1],
				"number" => $data[2],
				"empty1" => $data[3],
				"empty2" => $data[4],
				"name" => $data[5],
				"info" => $data[6],
				"code1" => '',
				"code2" => $data[8],
				"price" => $data[9]
			);
			$row1 = array(
				"id" => $data[0],
				"date" => $data[1],
				"number" => $data[2],
				"empty1" => $data[3],
				"empty2" => $data[4],
				"name" => $data[5],
				"info" => $data[6],
				"code1" => 4000,
				"code2" => '',
				"price" => $lastArray[$data[0]][0]
			);
			$row2 = array(
				"id" => $data[0],
				"date" => $data[1],
				"number" => $data[2],
				"empty1" => $data[3],
				"empty2" => $data[4],
				"name" => $data[5],
				"info" => $data[6],
				"code1" => $data[7],
				"code2" => '',
				"price" => $lastArray[$data[0]][1]
			);
			$arrayFull[] = $row0;
			$arrayFull[] = $row1;
			$arrayFull[] = $row2;
		}
	}
	if ( ! isset($data[5])) {
	   $data[5] = null;
	}
	if($data[5] == "DELIVERO HERO FINLAND OY"){
		if(!empty($lastArray[$data[0]][0]) or !empty($lastArray[$data[0]][1])){
			// add value and key to result array 
			$row3 = array(
				"id" => $data[0],
				"date" => $data[1],
				"number" => $data[2],
				"empty1" => $data[3],
				"empty2" => $data[4],
				"name" => $data[5],
				"info" => $data[6],
				"code1" => $data[7],
				"code2" => '',
				"price" => $data[9]
			);
			$row4 = array(
				"id" => $data[0],
				"date" => $data[1],
				"number" => $data[2],
				"empty1" => $data[3],
				"empty2" => $data[4],
				"name" => $data[5],
				"info" => $data[6],
				"code1" => 4200,
				"code2" => '',
				"price" => $lastArray[$data[0]][0]
			);
			$row5 = array(
				"id" => $data[0],
				"date" => $data[1],
				"number" => $data[2],
				"empty1" => $data[3],
				"empty2" => $data[4],
				"name" => $data[5],
				"info" => $data[6],
				"code1" => '',
				"code2" => $data[8],
				"price" => $lastArray[$data[0]][1]
			);
			
			$arrayFull[] = $row3;
			$arrayFull[] = $row4;
			$arrayFull[] = $row5;
		}
			
	}
			$alv14 = "";
			$alv24 = "";
}
//print "<pre>";
//print_r($arrayFull);
//print "</pre>";
// array to csv

$collectionOfModifyAndUnmodifyArrays = array_merge($arrayFull, $arrayOfUnneededRows);

// sort array by id 
function sortByOrder($a, $b) {
    return $a['id'] - $b['id'];
}
usort($collectionOfModifyAndUnmodifyArrays, 'sortByOrder');

/*
print "<pre>";
echo "<h1>merge of two array</h1>";
print_r($collectionOfModifyAndUnmodifyArrays);
print "</pre>";
*/

$file_input = fopen('valmis.csv', 'w');
 foreach ($collectionOfModifyAndUnmodifyArrays as $row) {
       //fputcsv($file_input, $row);
       fputcsv($file_input, $row,';','"');
 }
 fclose($file_input);

// print array 
foreach($collectionOfModifyAndUnmodifyArrays as $key2=>$row2){
    	echo "<tr>";
	        echo '<td>'.$row2['id'].'</td>';
			echo '<td>'.$row2['date'].'</td>';
			echo '<td>'.$row2['number'].'</td>';
			echo '<td>'.$row2['empty1'].'</td>';
			echo '<td>'.$row2['empty2'].'</td>';
			echo '<td>'.$row2['name'].'</td>';
			echo '<td>'.$row2['info'].'</td>';
			echo '<td>'.$row2['code1'].'</td>';
			echo '<td>'.$row2['code2'].'</td>';
			echo '<td>'.$row2['price'].'</td>';
	 	 echo "</tr>";
}

echo '<h2 class="red">3</h2><a class="myButton" href="https://extra.foodon.fi/accounting/valmis.csv" target="_blank">Lataa CSV-tiedosto</a>';
?>
</div>
</body>  
</html>  
