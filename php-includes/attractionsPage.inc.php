<!-- ========================================================================= -->
<!-- HEADER ATTRACTIONS CAROUSAL                                               -->
<!-- ========================================================================= -->
<div class="container">
  <div class="row">
    <div class="box" style="padding: 5px 5px ;"> 
      <div id="carousel-example-generic" class="carousel slide">              
        <!-- Wrapper for slides -->

        <?php
          if (isset($_GET['city_id']))  
            $cityID = $_GET['city_id'];
        ?>

        <?php
              $stmt = $db->prepare("  SELECT COUNT(*) as counter FROM city_attractions 
                                      WHERE city_id = $cityID AND top IS TRUE ORDER BY attraction_id");
              $stmt->execute();
              $stmt->bind_result($counter);                   
              $stmt->fetch();
              $counter = htmlentities($counter, ENT_QUOTES, "UTF-8");
              $stmt->close();      
              
              echo  "<ol class='carousel-indicators hidden-xs'>";
              echo  "   <li data-target='#carousel-example-generic' data-slide-to='0' class='active'></li>";
              
              for($i=1;$i<$counter;$i++)
                echo "    <li data-target='#carousel-example-generic' data-slide-to='$i'></li>";                      
              echo "</ol>";
              echo "  <div class='carousel-inner'>";

              
              $stmt = $db->prepare("  SELECT C.name, CA.attraction_id, CA.name, CA.altImage 
                                      FROM city_attractions CA, city C WHERE 
                                      C.city_id = CA.city_id AND
                                      C.city_id = $cityID AND 
                                      CA.top IS TRUE 
                                      ORDER BY attraction_id DESC");
              $stmt->bind_result($c_name,$attraction_id, $name, $altImage);
              $stmt->execute();
              $stmt->fetch();
              $c_name         = htmlentities($c_name,         ENT_QUOTES, "UTF-8");
              $attraction_id  = htmlentities($attraction_id,  ENT_QUOTES, "UTF-8");
              $name           = htmlentities($name,           ENT_QUOTES, "UTF-8");
              $altImage       = htmlentities($altImage,       ENT_QUOTES, "UTF-8");

              echo "    <div class='item active'>";
              echo "      <a href=\"#\" data-toggle=\"modal\" data-target=\"#myModal$attraction_id\">";
              echo "        <img class='img-responsive img-full' src='$altImage' alt='$name'>";
              echo "        <div class='carousel-caption'>";
              echo "          <h4 style=\"font-family: 'PT Serif',serif; font-size: 4.0em; letter-spacing: 3px; font-weight: bold; text-shadow: 0 0 10px #FFFFFF;\">$c_name</h4>";
              echo "          <br>";
              echo "          <h5>";
              echo "            $name";
              echo "          </h5>";
              echo "          <br><br><br>";
              echo "        </div>";
              echo "      </a>";
              echo "    </div>";
              
              while($stmt->fetch())
              {
                $c_name         = htmlentities($c_name,         ENT_QUOTES, "UTF-8");
                $attraction_id  = htmlentities($attraction_id,  ENT_QUOTES, "UTF-8");
                $name           = htmlentities($name,           ENT_QUOTES, "UTF-8");
                $altImage       = htmlentities($altImage,       ENT_QUOTES, "UTF-8");
                echo "  <div class='item'>";
                echo "      <a href=\"#\" data-toggle=\"modal\" data-target=\"#myModal$attraction_id\">";                  
                echo "        <img class='img-responsive img-full' src='$altImage' alt='' style='margin: 0 auto;'>";
                echo "        <div class='carousel-caption'>";
                echo "          <h4 style=\"font-family: 'PT Serif',serif; font-size: 4.0em; letter-spacing: 3px; font-weight: bold; text-shadow: 0 0 10px #FFFFFF;\">$c_name</h4>";
                echo "          <br>";
                echo "          <h5>";
                echo "            $name";
                echo "          </h5>";
                echo "          <br><br><br>";
                echo "        </div>";
                echo "      </a>";
                echo "  </div>";
              }
              $stmt->close();
              echo "</div>"
            ?>          

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
          <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
          <span class="icon-next"></span>
        </a>

    </div>       
  </div>
</div>      

<!-- ========================================================================= -->  
<div class="container" >
  <div class="row" style="padding-right: 0px; padding-left: 0px;">
    <div class="col col-xs-6">
      <?php        
        echo "<a type=\"button\" class=\"btn btn-primary navbar-btn\" href = \"aboutPage.php?cityInfo=$cityID\">City-Info</a>";
      ?>
    </div>
    
    <div class="col col-xs-6 text-right">
      <a type="button" class="btn btn-danger navbar-btn" href = "index.php" >Back</a>
    </div>
  </div>      
</div>  

<!-- ========================================================================= -->
<!-- BOX OF ACCORDIANS                                -->
<!-- ========================================================================= -->

<div class="container">
  <div class="box" style="padding: 10px 10px;">        
    <h3 class="intro-text text-center">
      ATTRACTIONS
    </h3>   

    <!-- =================================================================== -->
    <!-- #1 SIGHTSEEING                                      -->
    <!-- =================================================================== -->

    <div class="panel-group" id="accordion">
      <div class="panel panel-default">

        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" >Sightseeing ></a>
          </h4>
        </div>              
        <div id="collapseOne" class="panel-collapse collapse in">
          <div class="panel-body">
            <div class="row">

              <!-- ============================================= -->
              <!-- THUMB #N1                                  -->
              <!-- ============================================= -->

              <?php              

                $stmt = $db->prepare("  SELECT attraction_id, name, thumbnail, description, 
                                        video_embed, latitude, longitude 
                                        FROM city_attractions WHERE
                                        city_id = $cityID AND 
                                        type = 1
                                        ORDER BY attraction_id DESC");
                $stmt->bind_result($attraction_id,$name, $thumbnail, $description, $video_embed, $latitude, $longitude);
                $stmt->execute();
                
                while($stmt->fetch())
                {
                  $attraction_id  = htmlentities($attraction_id,  ENT_QUOTES, "UTF-8");
                  $name           = htmlentities($name,           ENT_QUOTES, "UTF-8");
                  $thumbnail      = htmlentities($thumbnail,      ENT_QUOTES, "UTF-8");
                  $description    = htmlentities($description,    ENT_QUOTES, "UTF-8");
                  $video_embed    = htmlentities($video_embed,    ENT_QUOTES, "UTF-8");
                  $latitude       = htmlentities($latitude,       ENT_QUOTES, "UTF-8");
                  $longitude      = htmlentities($longitude,      ENT_QUOTES, "UTF-8");

                  echo " <div class=\"col col-sm-4 text-center thumb\"> ";
                  echo "    <a class=\"thumbnail\" href=\"#\" data-toggle=\"modal\" data-target=\"#myModal$attraction_id\">";
                  echo "      <img class=\"img-responsive img-full\" src=\"$thumbnail\" alt=\"\" style=\"width: 150 px; height: 150px;\">";
                  echo "      <h6>$name</h6>";
                  echo "    </a>";
                  // MODAL WINDOW
                  echo "    <div id=\"myModal$attraction_id\" class=\"modal fade\" role=\"dialog\">";
                  echo "      <div class=\"modal-dialog\">";                  
                  echo "        <div class=\"modal-content\">";
                  echo "          <div class=\"modal-header\">";
                  echo "            <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>";
                  echo "            <h4 class=\"modal-title\">$name</h4>";
                  echo "          </div>";
                  echo "          <div class=\"modal-body bottomHeader\">";
                  echo "            <p>$description</p>";                                          
                  echo "            <div class=\"embed-responsive embed-responsive-4by3\">";
                  echo "              <iframe class=\"embed-responsive-item\" src=\"$video_embed\" allowfullscreen></iframe>";
                  echo "            </div>";
                  echo "          </div>";
                  echo "          <div class=\"modal-footer\">";
                  echo "            <button type=\"button\" class=\"btn btn-danger\" data-dismiss=\"modal\">Close</button>";
                  echo "          </div>";
                  echo "      </div>";
                  echo "    </div>";
                  echo "  </div>";
                  echo " </div>";
                }
                $stmt->close();
              ?>

            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="panel-group" id="accordion">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" >Eat and Drink ></a>
          </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse in">
          <div class="panel-body">
            <div class="row">

              <!-- ============================================= -->
              <!-- THUMB #N2                                 -->
              <!-- ============================================= -->

              <?php                
                $stmt = $db->prepare("  SELECT attraction_id, name, thumbnail, description, 
                                        video_embed, latitude, longitude 
                                        FROM city_attractions WHERE
                                        city_id = $cityID AND 
                                        type = 2
                                        ORDER BY attraction_id DESC");
                $stmt->bind_result($attraction_id,$name, $thumbnail, $description, $video_embed, $latitude, $longitude);
                $stmt->execute();
                
                while($stmt->fetch())
                {
                  $attraction_id  = htmlentities($attraction_id,  ENT_QUOTES, "UTF-8");
                  $name           = htmlentities($name,           ENT_QUOTES, "UTF-8");
                  $thumbnail      = htmlentities($thumbnail,      ENT_QUOTES, "UTF-8");
                  $description    = htmlentities($description,    ENT_QUOTES, "UTF-8");
                  $video_embed    = htmlentities($video_embed,    ENT_QUOTES, "UTF-8");
                  $latitude       = htmlentities($latitude,       ENT_QUOTES, "UTF-8");
                  $longitude      = htmlentities($longitude,      ENT_QUOTES, "UTF-8");

                  echo " <div class=\"col col-sm-4 text-center thumb\"> ";
                  echo "    <a class=\"thumbnail\" href=\"#\" data-toggle=\"modal\" data-target=\"#myModal$attraction_id\">";
                  echo "      <img class=\"img-responsive img-full\" src=\"$thumbnail\" alt=\"\" style=\"width: 150 px; height: 150px;\">";
                  echo "      <h6>$name</h6>";
                  echo "    </a>";
                  // MODAL WINDOW
                  echo "    <div id=\"myModal$attraction_id\" class=\"modal fade\" role=\"dialog\">";
                  echo "      <div class=\"modal-dialog\">";                  
                  echo "        <div class=\"modal-content\">";
                  echo "          <div class=\"modal-header\">";
                  echo "            <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>";
                  echo "            <h4 class=\"modal-title\">$name</h4>";
                  echo "          </div>";
                  echo "          <div class=\"modal-body bottomHeader\">";
                  echo "            <p>$description</p>";                                          
                  echo "            <div class=\"embed-responsive embed-responsive-4by3\">";
                  echo "              <iframe class=\"embed-responsive-item\" src=\"$video_embed\" allowfullscreen></iframe>";
                  echo "            </div>";
                  echo "          </div>";
                  echo "          <div class=\"modal-footer\">";
                  echo "            <button type=\"button\" class=\"btn btn-danger\" data-dismiss=\"modal\">Close</button>";
                  echo "          </div>";
                  echo "      </div>";
                  echo "    </div>";
                  echo "  </div>";
                  echo " </div>";
                }
                $stmt->close();
              ?>

            </div>
        </div>
      </div>
    </div>
    </div>

    <div class="panel-group" id="accordion">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" >Play ></a>
          </h4>
        </div>
        <div id="collapseThree" class="panel-collapse collapse in">
          <div class="panel-body">
            <div class="row">             


              <!-- ============================================= -->
              <!-- THUMB #N3                                  -->
              <!-- ============================================= -->

              <?php              

                $stmt = $db->prepare("  SELECT attraction_id, name, thumbnail, description, 
                                        video_embed, latitude, longitude 
                                        FROM city_attractions WHERE
                                        city_id = $cityID AND 
                                        type = 3
                                        ORDER BY attraction_id DESC");
                $stmt->bind_result($attraction_id,$name, $thumbnail, $description, $video_embed, $latitude, $longitude);
                $stmt->execute();                
                while($stmt->fetch())
                {
                  $attraction_id  = htmlentities($attraction_id,  ENT_QUOTES, "UTF-8");
                  $name           = htmlentities($name,           ENT_QUOTES, "UTF-8");
                  $thumbnail      = htmlentities($thumbnail,      ENT_QUOTES, "UTF-8");
                  $description    = htmlentities($description,    ENT_QUOTES, "UTF-8");
                  $video_embed    = htmlentities($video_embed,    ENT_QUOTES, "UTF-8");
                  $latitude       = htmlentities($latitude,       ENT_QUOTES, "UTF-8");
                  $longitude      = htmlentities($longitude,      ENT_QUOTES, "UTF-8");

                  echo " <div class=\"col col-sm-4 text-center thumb\"> ";                  
                  echo "    <a class=\"thumbnail\" href=\"#\" data-toggle=\"modal\" data-target=\"#myModal$attraction_id\">";

                  echo "      <img class=\"img-responsive img-full\" src=\"$thumbnail\" alt=\"\" style=\"width: 150 px; height: 150px;\">";
                  echo "      <h6>$name</h6>";
                  echo "    </a>";
                  // MODAL WINDOW
                  echo "    <div id=\"myModal$attraction_id\" class=\"modal fade\" role=\"dialog\">";
                  echo "      <div class=\"modal-dialog\">";                  
                  echo "        <div class=\"modal-content\">";
                  echo "          <div class=\"modal-header\">";
                  echo "            <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>";
                  echo "            <h4 class=\"modal-title\">$name</h4>";
                  echo "          </div>";
                  echo "          <div class=\"modal-body bottomHeader\">";
                  echo "            <p>$description</p>";                                          
                  echo "            <div class=\"embed-responsive embed-responsive-4by3\">";
                  echo "              <iframe class=\"embed-responsive-item\" src=\"$video_embed\" allowfullscreen></iframe>";
                  echo "            </div>";
                  echo "          </div>";
                  echo "          <div class=\"modal-footer\">";
                  echo "            <button type=\"button\" class=\"btn btn-danger\" data-dismiss=\"modal\">Close</button>";
                  echo "          </div>";
                  echo "      </div>";
                  echo "    </div>";
                  echo "  </div>";
                  echo " </div>";
                }
                $stmt->close();
              ?>

            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row" style="padding: 5px;">
      <div class="box" style="padding: 5px;">        
        <div id="map" style="padding: 5px  ; width:auto;height:450px;">          
        </div>        
      </div>      
    </div>
  </div>
</div>


<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA0Nwpnj26MdANOLDgcYP9KsWSFr81QUW4">
      </script>      
      <?php 
          $stmt = $db->prepare("  SELECT attraction_id, name, latitude, longitude, type 
                                  FROM city_attractions WHERE
                                  city_id = $cityID                                  
                                  ORDER BY attraction_id");
          $stmt->bind_result($attraction_id,$name, $latitude, $longitude, $type);
          $stmt->execute();
          $i = 0;
          echo "<script type=\"text/javascript\">var locations= []; </script>";
          while($stmt->fetch())
                {
                  $attraction_id  = htmlentities($attraction_id,  ENT_QUOTES, "UTF-8");
                  $name           = htmlentities($name,           ENT_QUOTES, "UTF-8");                  
                  $latitude       = htmlentities($latitude,       ENT_QUOTES, "UTF-8");
                  $longitude      = htmlentities($longitude,      ENT_QUOTES, "UTF-8");
                  $type           = htmlentities($type,           ENT_QUOTES, "UTF-8");
                  echo "<script type=\"text/javascript\"> locations.push([$attraction_id, \"$name\", $latitude, $longitude, $type ]); </script>";
                  $i++;
                }                
          $stmt->close();
        ?>
      <script type="text/javascript">
        
        var sample = document.getElementById("out");
        //sample.innerHTML = locations[1][4];

        var map = new google.maps.Map(document.getElementById('map'), 
        {
          zoom: 11,
          center: new google.maps.LatLng(locations[0][2], locations[0][3]),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var infowindow = new google.maps.InfoWindow();

        var marker1, i;        
        for (i = 0; i < locations.length; i++) 
        {  
            if(locations[i][4]==1)
            {
              marker1 = new google.maps.Marker(
              {
                position: new google.maps.LatLng(locations[i][2], locations[i][3]),
                map: map,
                icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
              });
              

            }
            if(locations[i][4]==2)
            {
              marker1 = new google.maps.Marker(
              {
                position: new google.maps.LatLng(locations[i][2], locations[i][3]),
                map: map,
                icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png'
              });
            }
            if(locations[i][4]==3)
            {
              marker1 = new google.maps.Marker(
              {
                position: new google.maps.LatLng(locations[i][2], locations[i][3]),
                map: map,
                icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png'
              });
            }

          google.maps.event.addListener(marker1, 'click', (function(marker1, i) 
          {
            return function() 
            {
              infowindow.setContent(locations[i][1]);
              infowindow.open(map, marker1);
            }
          })(marker1, i));
        }
        var legend = document.createElement('div');
              legend.id = 'legend';
              var content = [];
              content.push('<p><div class="row color red bottomHeader"></div>Eat</p>');
              content.push('<p><div class="row color green bottomHeader"></div>Sightseeing</p>');
              content.push('<p><div class="row color blue bottomHeader"></div>Play</p>');              
              legend.innerHTML = content.join('');
              legend.index = 1;
              map.controls[google.maps.ControlPosition.RIGHT_TOP].push(legend);
      </script>


<style type="text/css">
      #legend {
        background-color: #e6e6e6;
        padding: 2px 20px 2px 20px;
        margin: 5px 5px 5px 5px;
        font-family:Georgia;  
        font-size:15px;
        font-style:normal; 
        font-weight:none; 
        text-decoration:none;
        text-transform:none;  
        font-variant:none; 
        color:000000;
        text-align: justify;
        text-justify: inter-word;
      }

      .color {
        border: 1px solid;
        height: 12px;
        width: 12px;
        margin-right: 3px;
        float: left;
      }

      .red {
        background: #ff6666;
      }

      .green {
        background: #70db70;
      }

      .blue {
        background: #80aaff;
      }

    </style>