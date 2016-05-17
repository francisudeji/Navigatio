<div class="container">

  <div class="row">
    <div class="box">
      <div class="col-lg-12">
        <hr>
        <h2 class="intro-text text-center">
          <?php
            $time = date("H");
            $timezone = date("e");
            if ($time<"12")
              echo "Good morning, ";
            else if ($time >= "12" && $time < "17")
              echo "Good afternoon, ";
            else if ($time > "17")
              echo "Good evening";
          ?>
          Welcome to <strong>Navigatio</strong>
        </h2>
        <hr>                  
        <hr class="visible-xs">
        <p>Navigatio aims to give you the best and most up to date information on the major travel destinations aronud the world. Here you can find the top attractions, hotels and other places to hangout.</p>        
      </div>
    </div>
  </div>

  <!-- ========================================================================= -->
  <!-- City select box                                                           -->
  <!-- ========================================================================= -->

  <div class="row">
    <div class="box">

      <hr>
      <h2 class="intro-text text-center">
        EXPLORE THE WORLD                
      </h2>
      <hr>
      
      <div class="col-lg-12 text-center">
        <div id="carousel-example-generic" class="carousel slide">
          <!-- Indicators -->          
            <?php
              $stmt = $db->prepare("SELECT COUNT(*) as counter FROM city WHERE TOP IS TRUE ORDER BY city_id");
              $stmt->execute();
              $stmt->bind_result($counter);              			
			        $stmt->fetch();
			        $counter = htmlentities($counter, ENT_QUOTES, "UTF-8");
              $stmt->close();
			
              ob_start();			  
              echo  "<ol class='carousel-indicators hidden-xs'>";
              echo  "   <li data-target='#carousel-example-generic' data-slide-to='0' class='active'></li>";			  			  

              $i=1;
              for($i=1;$i<$counter;$i++)
      			  {
      				echo "    <li data-target='#carousel-example-generic' data-slide-to='$i'></li>";				
      			  }
              echo "</ol>";          

              echo "  <div class='carousel-inner'>";
              
              $stmt = $db->prepare("SELECT city_id, mainImageTitle, mainImage FROM city WHERE TOP IS TRUE ORDER BY city_id");
              $stmt->bind_result($city_id, $mainImageTitle, $mainImage);
              $stmt->execute();
              $stmt->fetch();
              $city_id = htmlentities($city_id, ENT_QUOTES, "UTF-8");
              $mainImageTitle = htmlentities($mainImageTitle, ENT_QUOTES, "UTF-8");
              $mainImage = htmlentities($mainImage, ENT_QUOTES, "UTF-8");
              echo "    <div class='item active'>";
              echo "      <a href=\"attractionsPage.php?city_id=$city_id\" >";
              echo "        <img class='img-responsive img-full' src='$mainImage' alt='' style='margin: 0 auto;'>";
              echo "        <div class='carousel-caption'>";
              echo "          <h4 style='font-family: \"Lora\"  , serif; font-size: 2.5em; text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;'>$mainImageTitle</h4>";
              echo "        </div>";
              echo "      </a>";
              echo "    </div>";
              
              while($stmt->fetch())
              {
                $city_id = htmlentities($city_id, ENT_QUOTES, "UTF-8");
                $mainImageTitle = htmlentities($mainImageTitle, ENT_QUOTES, "UTF-8");
                $mainImage = htmlentities($mainImage, ENT_QUOTES, "UTF-8");
                echo "  <div class='item'>";
                echo "      <a href=\"attractionsPage.php?city_id=$city_id\" >";
                echo "    <img class='img-responsive img-full' src='$mainImage' alt='' style='margin: 0 auto;'>";
                echo "    <div class='carousel-caption'>";
                echo "      <h4 style='font-family: \"Lora\", serif; font-size: 2.5em; text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;'>$mainImageTitle</h4>";
                echo "    </div>";
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

    </br>
    <p>Swipe through and choose one of the top destinations
    </p> 

    <h3><strong>OR</strong></h3>


    <div class="row">
      <p>Select from the entire list of cities</p>
      <div class="col col-sm-4"></div>
      <div class="col col-sm-4">
        <form method="post">      
          <select name="citySelect" class="form-control">
            <?php
                $stmt = $db->prepare("SELECT city_id, name FROM city ORDER BY city_id");
                $stmt->bind_result($city_id, $name);              
                $stmt->execute();
                while($stmt->fetch())
                {
                  $city_id = htmlentities($city_id, ENT_QUOTES, "UTF-8");
                  $name = htmlentities($name, ENT_QUOTES, "UTF-8");
                  echo "<option value=\"$city_id\"> $name </option>";
                }
                $stmt->close();
            ?>
          </select>
          </br>        
          <input name="submit" type="submit" value="FIND">
          <?php
            if(isset($_POST['submit']))
            {
              if(!empty($_POST['citySelect'])) 
              {
                ob_end_clean();
                $select = $_POST['citySelect'];
                header("Location: attractionsPage.php?city_id=$select");
                exit;
              }
              else
                echo "<span>Please Select a city before proceeding</span><br/>";
            }          
          ?>
        </form>
      </div>
      <div class="col col-sm-4"></div>      
    </div>

    <h3><strong>OR</strong></h3>

    <!--====================================================================================================-->
    <!--                                           CURRENT LOCATION                                         -->
    <?php require_once 'php-includes/BL/current-location.inc.php'; ?>
    <!--====================================================================================================-->

</div>
</div>
</div>         

</div>