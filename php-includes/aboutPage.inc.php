<!-- ========================================================================= -->
<!--                       CITY SELECTION CAROUSEL                             -->
<?php
  if (isset($_GET['cityInfo']))  
    $cityID = $_GET['cityInfo'];
?>
<?php
  $stmt = $db->prepare("  SELECT detailImage, name, overview, history, gettingIn, seasons 
                FROM citydetails WHERE city_id = $cityID");
  $stmt->execute();
  $stmt->bind_result($detailImage, $name, $overview, $history, $gettingIn, $seasons);                   
  $stmt->fetch();
  $detailImage      =                         htmlentities($detailImage , ENT_QUOTES, "UTF-8");
  $name             =                         htmlentities($name        , ENT_QUOTES, "UTF-8");
  $overview         = htmlspecialchars_decode(htmlentities($overview    , ENT_QUOTES, "UTF-8"));
  $history          = htmlspecialchars_decode(htmlentities($history     , ENT_QUOTES, "UTF-8"));
  $gettingIn        = htmlspecialchars_decode(htmlentities($gettingIn   , ENT_QUOTES, "UTF-8"));
  $seasons          = htmlspecialchars_decode(htmlentities($seasons     , ENT_QUOTES, "UTF-8"));   
  $stmt->close();
?>

<div class="container">
  <div class="row">
    <div class="box" style="padding: 5px 5px;"> 
      <div id="carousel-example-generic" class="carousel slide">              
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <div class="item active">
            <?php
              echo " <img class=\"img-responsive img-full\" src=\"$detailImage\" alt=\"\">";
              echo " <div class=\"carousel-caption\" style=\"left: 2%; padding-bottom: 0px; bottom: 0px;\">";
              echo "   <h4 style=\"font-family: 'brandon-grotesque-1'; font-size: 1.2em; letter-spacing: 1.5px; font-weight: 100; text-shadow: 0 0 8px #FFFFFF; text-transform: capitalize; text-align:left; vertical-align: bottom; \">About $name</h4>";
              echo " </div>";
                          ?>
          </div>                
        </div>
      </div>
    </div>       
  </div>
</div>  

<!-- ========================================================================= -->   

<div class="container">
  <div class="box" style="padding: 10px 15px;">        
    <h3 class="intro-text text-center">
    </h3>

    <div class="panel-group" id="accordion">
      <div class="panel">
        <div class="panel-heading" style="color: #000; background-color: #C9C9C9;">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" >Overview ></a>
          </h4>
        </div>              
        <div id="collapse1" class="panel-collapse collapse">
          <div class="panel-body">
            <div class="row">
              <?php echo nl2br("<p class = \"text-justify\" style=\"padding: 15px 15px;\"> $overview </p>"); ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="panel-group" id="accordion">
      <div class="panel" >
        <div class="panel-heading" style="color: #000; background-color: #E3E3E3;">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" >History ></a>
          </h4>
        </div>              
        <div id="collapse2" class="panel-collapse collapse">
          <div class="panel-body">
            <div class="row">
              <?php echo nl2br("<p class = \"text-justify\" style=\"padding: 15px 15px;\"> $history </p>"); ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="panel-group" id="accordion">
      <div class="panel" >
        <div class="panel-heading" style="color: #000; background-color: #9AD3DE;">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3" >Getting in ></a>
          </h4>
        </div>              
        <div id="collapse3" class="panel-collapse collapse">
          <div class="panel-body">
            <div class="row">
              <?php echo nl2br("<p class = \"text-justify\" style=\"padding: 15px 15px;\"> $gettingIn </p>"); ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="panel-group" id="accordion">
      <div class="panel" >
        <div class="panel-heading" style="color: #000; background-color: #89BDD3;">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse4" >Seasons ></a>            
          </h4>
        </div>              
        <div id="collapse4" class="panel-collapse collapse">
          <div class="panel-body">
            <div class="row">
              <?php echo nl2br("<p class = \"text-justify\" style=\"padding: 1px 15px;\">$seasons</p>"); ?>
            </div>
          </div>
        </div>
      </div>
    </div>




  </div>
</div>




<div class="container" style="padding-bottom: 15px;">
  <div class="row">
    <div class="col text-center">
      <a type="button" class="btn btn-danger" href="attractionsPage.php?city_id=<?php echo $cityID ?> ">Back</a>
    </div>        
  </div>
</div>



<script type="text/javascript">
  $(document).ready(function() 
  {
      // Configure/customize these variables.
      var showChar = 100; // How many characters are shown by default
      var ellipsestext = "...";
      var moretext = "Show more >";
      var lesstext = "Show less";      

      $('.more').each(function() 
      {
          var content = $(this).html();   
          if(content.length > showChar) 
          {   
              var c = content.substr(0, showChar);
              var h = content.substr(showChar, content.length - showChar);   
              var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
   
              $(this).html(html);
          }
   
      });

      $(".morelink").click(function(){
          if($(this).hasClass("less")) {
              $(this).removeClass("less");
              $(this).html(moretext);
          } else {
              $(this).addClass("less");
              $(this).html(lesstext);
          }
          $(this).parent().prev().toggle();
          $(this).prev().toggle();
          return false;
      });
  });  
</script>