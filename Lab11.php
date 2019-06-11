<?php
//Fill this place

//****** Hint ******
//connect database and fetch data here

$db = mysqli_connect("localhost","labpj","18302010030","travel");
if ( mysqli_connect_errno() ) {
            die( mysqli_connect_error() );  
         }

$result = mysqli_query($db, 'SELECT *  FROM continents');
$countries = mysqli_query($db, 'SELECT *  FROM countries');
$images = mysqli_query($db, 'SELECT *  FROM imagedetails');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Lab11</title>

      <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    
    

    <link rel="stylesheet" href="css/captions.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.css" />    

</head>

<body>
    <?php include 'header.inc.php'; ?>
    


    <!-- Page Content -->
    <main class="container">
        <div class="panel panel-default">
          <div class="panel-heading">Filters</div>
          <div class="panel-body">
            <form action="Lab11.php" method="get" class="form-horizontal" id="form">
              <div class="form-inline">
              <select name="continent" class="form-control" id="continent">
                <option value="0">Select Continent</option>
                <?php
                //Fill this place

                //****** Hint ******
                //display the list of continents
                while($row = $result->fetch_assoc()) {
                 	echo '<option value=' . $row['ContinentCode'] . '>' . $row['ContinentName'] . '</option>';
                }
	mysqli_close($result);
	
                ?>
              </select>     
              
              <select name="country" class="form-control" id="country">
                <option value="0">Select Country</option>
                <?php 
                //Fill this place

                //****** Hint ******
                /* display list of countries */ 
	while($countryrow = $countries->fetch_assoc()) {
		echo '<option value=' . $countryrow['ISO'] . '>' . $countryrow['CountryName'] . '</option>';
                }

	mysqli_close($countries);
	
                ?>
              </select>    
              <input type="text"  placeholder="Search title" class="form-control" name=title>
              <button type="submit" class="btn btn-primary">Filter</button>
              </div>
            </form>

          </div>
        </div>     
                                    

		<ul class="caption-style-2">

            <?php
            $continent = 0;
            $country = 0;
	if($_GET){
		$continent = $_GET['continent'];
		$country = $_GET['country'];
		}

    while($imagerow = $images->fetch_assoc()) {
        $path = $imagerow['Path'];
        $imageid = $imagerow['ImageID'];
        $title = $imagerow['Title'];

        $foo = <<< EOD
            <li>
              <a href="detail.php?id=$title" class="img-responsive">
                <img src="images/square-medium/$path" style="height:225px;weight:225px" alt="$imageid">
                <div class="caption">
                  <div class="blur"></div>
                  <div class="caption-text">
                    <p>$title</p>
                  </div>
                </div>
              </a>
            </li>
EOD;

	if(!$_GET){
		echo $foo;
	}elseif($imagerow['ContinentCode'] == $continent & $imagerow['CountryCodeISO'] == $country){
        echo $foo;
    }elseif($imagerow['ContinentCode'] == $continent & $country == '0'){
        echo $foo;
    }elseif($continent == '0' & $imagerow['CountryCodeISO'] == $country){
        echo $foo;
    }
    }
                ?>
       </ul>       

      
    </main>
    
    <footer>
        <div class="container-fluid">
                    <div class="row final">
                <p>Copyright &copy; 2017 Creative Commons ShareAlike</p>
                <p><a href="#">Home</a> / <a href="#">About</a> / <a href="#">Contact</a> / <a href="#">Browse</a></p>
            </div>            
        </div>
        

    </footer>


        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>