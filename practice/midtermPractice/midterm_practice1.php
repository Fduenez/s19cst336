<!--get is in the url(get from url), you can bookmark it, usually used for searches (usernames and such)-->
<!--post comes with the webpage, is when you want it to be hidden, not bookmarks, can be used for passwords-->

<?php
//Time Stamp: 
//print_r($_POST);//post creates an array
$_POST;
$months = array(
    'January' => 31,
    'February' => 28,
    'November' => 30,
    'December' => 31
    );
    
$countriesAndImages = array(
    'France' => array('bordeaux', 'le_havre', 'lyon', 'montpellier', 'paris', 'strasbourg'),
    'Mexico' => array('acapulco', 'cabos', 'cancun', 'chichenitza', 'huatulco', 'mexico_city'),
    'USA' => array('chicago', 'hollywood', 'las_vegas', 'ny', 'washington_dc', 'yosemite')
    );
function getDestinationForCountry($country){
    global $countriesAndImages;
    shuffle($countriesAndImages[$country]);
    $location =  array_pop($countriesAndImages[$country]);
    $imgURL = "./img/$country/" . $location . ".png";
    return array(
        "imgURL" => $imgURL, 
        "location"=> $location
    );
}
function createRandomMappings($numDaysInMonth, $numSiteSeeingDays, $country){
    $mappings = array();
    
    //initialize all the days to be false
    for($i=0; $i < $numDaysInMonth; $i++){
        array_push($mappings, false);
    }
    //set the $numSiteSeeingDays to have images
    for($i=0; $i<$numSiteSeeingDays; $i++){
        $mappings[$i] = array(
            //'img' => "./img/USA/chicago.png"
            //'img' => getImageForCountry($country)
            'destination' => getDestinationForCountry($country)
        );
    }
    shuffle($mappings);
    
    return $mappings;
}
function generateCalendar(){
    global $months;
    $month = $_POST["month"];
    $daysInMonth = $months[$month];
    //echo "DAYS = $daysInMonth !!!!!!! <br/>";
    
    echo "<table>"; //like a cout statement
    
    $mappings = createRandomMappings($daysInMonth, $_POST['num-site-seeing-days'], $_POST['country']);
    
    
    //to place 3 random images in the calendar
    //create an array of 31 elements(or 30, 28) depending on the month
    //set the first 3 elements to be arrays 
        //{'img' ==> http://randomURL}
    
    $date = 1;
    for($week = 0; $week < 5; $week++){
        echo "<tr>"; //table row
        for($day = 0; $day < 7; $day++){
            echo "<td>";
            echo "$date";
            if($mappings[$date-1]){ //if it exists
                echo "<img src='".$mappings[$date-1]['destination']['imgURL']. "'>"; //dots are like a plus sign
                echo "<div>".$mappings[$date-1]['destination']['location']. "</div>";
            }
            
            echo "</td>";
            $date++;
            if($date > $daysInMonth){
                break;
            }
        }
        echo "</tr>";
        if($date > $daysInMonth){
            break;
        }
    }
    echo "</table>";
    
}

//grab the month info from the form

function getErrors(){
    $errors = array();
    if($_POST['month'] == "Select"){
        array_push($errors, "Must select month");
    }
    if(!isset($_POST['num-site-seeing-days'])){
        array_push($errors, "Must select number of days");
    }
    return $errors;
}
function displayErrors($errors){
    echo "<ul>";
    foreach($errors as $error){
        echo "<li>$error</li>";
    }
    echo "</ul>";
}
?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            table td{
                padding: 30px;
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <h1> Winter Vacation Planner</h1>
        <form method="post">
            <select name="month">
                <option value="Select">Select</option>
                <option value="November">November</option>
                <option value="December">December</option>
                <option value="January">January</option>
                <option value="February">February</option>
            </select>
            <input type="radio" name="num-site-seeing-days" value="3"> 3
            <input type="radio" name="num-site-seeing-days" value="4"> 4
            <input type="radio" name="num-site-seeing-days" value="5"> 5
            <br/>
            <select name="country">
                <option value="USA">USA</option>
                <option value="France">France</option>
                <option value="Mexico">Mexico</option>
            </select>
            
            <input type="submit" name = "travel-info-submit-btn">
        </form>
        <h1> Itinerary </h1>
        
        <?php 
        if(isset($_POST['travel-info-submit-btn'])){
            $errors = getErrors();
            if(count($errors)>0){
                displayErrors($errors);
            }
            else{
                generateCalendar();
            }
        }
        ?>
        
          
    <table border="1" width="600">
    <tbody><tr><th>#</th><th>Task Description</th><th>Points</th></tr>
    <tr style="background-color:#FFC0C0">
      <td>1</td>
      <td>The page includes the form elements as the Program Sample: dropdown menu, radio buttons, etc.</td>
      <td width="20" align="center">5</td>
    </tr>
    <tr style="background-color:#FFC0C0">
      <td>2</td>
      <td>Errors are displayed if month or number of locations are not submitted.</td>
      <td width="20" align="center">5</td>
    </tr> 
    <tr style="background-color:#FFC0C0">
      <td>3</td>
      <td>Header and Subheader are displayed with info submitted. </td>
      <td align="center">5</td>
    </tr>    
	<tr style="background-color:#FFC0C0">
      <td>4</td>
      <td>A table with days and weeks is displayed when submitting the form</td>
      <td align="center">5</td>
    </tr> 
    <tr style="background-color:#FFC0C0">
      <td>5</td>
      <td>The number of days in the table correspond to the month selected</td>
      <td align="center">10</td>
    </tr>
    <tr style="background-color:#FFC0C0">
      <td>6</td>
      <td>Random images are displayed in random days</td>
      <td align="center">5</td>
    </tr>       
    <tr style="background-color:#FFC0C0">
      <td>7</td>
      <td>The number of random images correspond to the number of locations and country submitted</td>
      <td align="center">10</td>
    </tr>  
    <tr style="background-color:#FFC0C0">
      <td>8</td>
      <td>The proper name of the location is displayed below the image 
      		(e.g. "New York", "Las Vegas")</td>
      <td align="center">10</td>
    </tr>  
    <tr style="background-color:#FFC0C0">
      <td>9</td>
      <td>The list of months submitted along with the country and number of locations is displayed below the table (using Sessions)</td>
      <td align="center">15</td>
    </tr>    
    <tr style="background-color:#FFC0C0">
      <td>10</td>
      <td>Random locations should be ordered alphabetically, if user checks corresponding radio button (A-Z or Z-A). </td>
      <td align="center">15</td>
    </tr>        
    <tr style="background-color:#FFC0C0">
      <td>11</td>
      <td>The web page uses Bootstrap and has a nice look. </td>
      <td align="center">5</td>
    </tr>        
 <!--   <tr style="background-color:#99E999">
      <td>12</td>
      <td>This rubric is properly included AND UPDATED (BONUS)</td>
      <td width="20" align="center">2</td>
    </tr>   -->  
     <tr>
      <td></td>
      <td>T O T A L </td>
      <td width="20" align="center"><b></b></td>
    </tr> 
  </tbody></table>


    </body>
</html>