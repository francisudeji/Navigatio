<!--===================================================================================-->
<!-- Function: currentLocation            Author: Vishnu Vidyan                        -->
<!-- Action: CREATED                       Date: 20-11-2015                            -->
<!-- Description: To find the nearest city based on the current location coordinates   -->
<!--===================================================================================-->                               
<?php  
  $details = json_decode(file_get_contents("http://ipinfo.io/"));        
  $location = explode(",",$details->loc);

  ob_end_flush();      

  $stmt = $db->prepare(
    "SELECT city_id, ( 3959 * acos( cos( radians($location[0]) ) * cos( radians( latitude ) ) * 
      cos( radians( longitude ) - radians($location[1])) + sin( radians($location[0]) ) * 
      sin( radians( latitude ) ) ) ) AS distance FROM city;"
  );
  $stmt->bind_result($near_city_id,$dist);              
  $stmt->execute();

  $tempDis = 500;
  $tempCty = 1;
  while($stmt->fetch())
  {
    $near_city_id = htmlentities($near_city_id, ENT_QUOTES, "UTF-8");
    $dist = htmlentities($dist, ENT_QUOTES, "UTF-8");          
    if($dist<$tempDis)
    {
      $tempDis = $dist;
      $tempCty = $near_city_id;
    }            
  }       
  echo "<a href=\"attractionsPage.php?city_id=$tempCty\" class=\"btn btn-default btn-lg\">Choose the nearest city to explore</a>";        
?>
<!--===================================================================================-->
