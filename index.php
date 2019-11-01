<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
?>
<!DOCTYPE html>
<html lang="fi">
<head>
    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/index.css">
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
            <a href="index.html" style="color:black;" class="navbar-brand">Tilikauha.fi</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a class="smoothScroll" href="#">
                    <span class="glyphicon glyphicon-log-in"></span> Kirjaudu 
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!--navbar finish-->
<!-- User guide start -->
<br>
<div class="container-fluid ohje-osio">
    <div class="container">
    <div class="row">
        <div class="col-sm-8 col-md-12">
            <h2 class="hero">TKO- Tilikauha kirjanpito ohjelma käyttöohje</h2>
            <hr>
            <ol>
                <li>Valitse CSV-tiedosto ja paina luo painiketta</li>
                <li>Syöttää tarvitteassa jokaiselle riville kahden ALV arvoja muodossa 12,00-13,00</li>
                <li>Paina "Lähetä" painikke joka löytyy viimeisen rivin jälkeen</li>
            </ol>
            <ul>
                <li>Tarkista muokattu rivit ja lataa muokattu CSV tiedosto</li>
                <li>Voit tarvitteassa avata CSV-tiedosto LibreOffice tai Excel kautta (sarake erotettu puolipisteellä)</li>
                <li>Huomaa! luotu CSV-tiedosto sisältää muokattu rivit sekä muuntamattomia riviä</li>
                <li>Huomaa! Ohjelma ei voi käyttää samaa aikaa enemmän kuin yksi työntekijä.</li>
            </ul>
        </div>
    </div>
</div>
</div>
<!-- User guide finish -->
<br>
<div class="container">
  <div class="row">
    <div class="col-md-2">
      <form action="index.php" method="post" enctype="multipart/form-data">
        Valitse CSV tiedosto: <input  type="file" name="upload_file" /><br>
        <input class="btn btn-primary btn-block" type="submit" value="luo" />
      </form>
    </div>
</div>
<?php
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
//echo '<pre>';
//print_r($csv_array);
//echo '</pre>';
$file_input = fopen('file3.csv', 'w');
foreach ($csv_array as $row) {
       //fputcsv($file_input, $row);
       fputcsv($file_input, $row,';','"');
}
// start of program
//echo "not clicked";
}
$csv = array_map(function($v){return str_getcsv($v, ";");}, file('file3.csv'));

echo '
<!--first table start--> 
<h2> Löydetty rivit muokkaukselle </h2>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">PVM</th>
      <th scope="col">TOSITELAJI</th>
      <th scope="col">KUITIN NIMI</th>
      <th scope="col">TILINUMERO 1</th>
      <th scope="col">TILINUMERO 2</th>
      <th scope="col">SUMMA</th>
      <th scope="col">ALV 24-14</th>
    </tr>
  </thead>';


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
echo '<tbody>';
echo '<form action="index.php" method="post">';
foreach($array as $key2=>$row2){
      echo "<tr>";
          echo '<td scope="row">'.$row2['id'].'</td>';
      echo '<td>'.$row2['date'].'</td>';
      echo '<td>'.$row2['number'].'</td>';
     // echo '<td>'.$row2['empty1'].'</td>';
     // echo '<td>'.$row2['empty2'].'</td>';
      echo '<td>'.$row2['name'].'</td>';
      //echo '<td>'.$row2['info'].'</td>';
      echo '<td>'.$row2['code1'].'</td>';
      echo '<td>'.$row2['code2'].'</td>';
      echo '<td>'.$row2['price'].'</td>';
      echo '<td><input type="text" name="alv14['.$row2['id'].']" maxlength="35" size="10"></td>'; 
     echo "</tr>";
    }


//echo '<td><h2 class="red">2</h2><input type="submit" class="myButton" value="Lähetä"></td>';

echo '</table>
    <!--first table finish-->';
echo'<div class="row">
        <div class="col-md-2">
          <input class="btn btn-primary btn-block" type="submit" value="Lähetä"/>
       </div>
    </div>
<hr></form>';



//print "<pre>";
//print_r($_POST); //$_POST['alv14'];
//print "</pre>";
/*-----------get input values ------------*/
$key = [];
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
echo '
<!--second table start-->
<h2>Muokattu rivit. Ole hyvä tarkista ja lataa CSV-tiedosto</h2>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">PVM</th>
      <th scope="col">TOSITELAJI</th>
      <th scope="col">KUITIN NIMI</th>
      <th scope="col">TILINUMERO 1</th>
      <th scope="col">TILINUMERO 2</th>
      <th scope="col">SUMMA</th>
    </tr>
  </thead>
  <tbody>';
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
    }else{
      $unneededRow0 = array(
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
      $arrayFull[] = $unneededRow0;
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
    }else{
      $unneededRow1 = array(
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
      $arrayFull[] = $unneededRow1;
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
    return (int)$a['id'] - (int)$b['id'];
}
usort($collectionOfModifyAndUnmodifyArrays, 'sortByOrder');


/*print "<pre>";
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
          echo '<td scope="row">'.$row2['id'].'</td>';
      echo '<td>'.$row2['date'].'</td>';
      echo '<td>'.$row2['number'].'</td>';
     // echo '<td>'.$row2['empty1'].'</td>';
      //echo '<td>'.$row2['empty2'].'</td>';
      echo '<td>'.$row2['name'].'</td>';
      //echo '<td>'.$row2['info'].'</td>';
      echo '<td>'.$row2['code1'].'</td>';
      echo '<td>'.$row2['code2'].'</td>';
      echo '<td>'.$row2['price'].'</td>';
     echo "</tr>";
}

//echo '<h2 class="red">3</h2><a class="myButton" href="https://extra.foodon.fi/accounting/valmis.csv" target="_blank">Lataa CSV-tiedosto</a>'

echo'<div class="row">
      <div class="col-md-2">
        <a class="btn btn-success btn-block" href="https://extra.foodon.fi/kirjanpito/valmis.csv" target="_blank" type="submit"/>Lataa CSV-tiedosto</a>
     </div>
    </div>';

echo'
  </tbody>
</table>';
?>
<!--second table finish-->
</div>
</body>
</html>