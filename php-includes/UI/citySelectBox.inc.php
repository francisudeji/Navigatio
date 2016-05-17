<div class="row">
  <p>Select from the entire list of cities</p>
  <form method="post">      
    <select name="citySelect">
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

  </br>
  
</div>