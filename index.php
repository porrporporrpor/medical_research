<?php 
session_start(); 
if(empty($_SESSION['dataList']) && empty($_SESSION['typeCal'])) {
  header( 'Location: setDefault.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Research</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- css bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css">
  <!-- custom css -->
  <link rel="stylesheet" type="text/css" href="style.css">

  <!-- awesome font-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
  
  <!--ajax -->  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- popper script -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

  <!--bootstrap javascript-->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

  <!-- canvasJs -->
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  

</head>

<body>

  <div class="container-fluid">
    <div class="row content">
      <div class="col-md-3 col-xs-1 sidenav" id="main_nav" >
        <div style="position: relative;">
        <h3 onclick="closeNav()" class="fa fa-times click-cursor" style="float:right"></h3>
        <h5>CUSTOMIZE<br>YOUR CHART</h5>
        <hr>
        
        <div class="custom-plot">
          <!-- customize chart  -->
          <form action="setDefault.php" method="GET" id="customizeChart">

          <p class="text-left">Select chart type</p>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" class="custom-control-input" id="customRadio" name="typeChart" value="scatter" checked>
              <label class="custom-control-label" for="customRadio">Scatter Plot</label>
            </div>
    
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" class="custom-control-input" id="customRadio2" name="typeChart" value="boxplot">
              <label class="custom-control-label" for="customRadio2">Box Plot</label>
            </div>
            <br><br>
            <p class="text-left">Select date from</p>

            <div>
              <input class="form-control" type="date" id="startDate" name="startDate" value="">
            </div>

          <br><p class="text-left">to</p>

            <div>
              <input type="date" class="form-control" id="endDate" name="endDate"  value="">
            </div>
            <br>
            
          <input id="typeCal" name="typeCal" style="display:none" />

          <input type="submit" value="Submit" class="btn btn-sm btn-primary"/>

          </form>
          

      </div>
    </div>
  </div>
      <!--end nav side -->

      <div id="blur-body"></div>

      <br><br>
      <div class="col-md contentside">

        <h3 onclick="openNav()" class="fas fa-bars click-cursor" style="position: absolute;"></h3>
        <h4 class="text-center"><span class="fas fa-columns"></span> Research</h4><hr>

        <!-- minicard section -->
        <div id="minicard">
          <div class="card-columns">

             <!-- male card -->
            <div id="male-card" class="card">
             <div class="card-body">
              <div class="row">
                <span class="column col-md-3">
                  <h1 class="fas fa-male"></h1>
                </span>
                <span class="column col-md-8" style="float:right">
                 <h3><?php echo $_SESSION['male']; ?></h3>
                 <small>Male</small>
               </span>
             </div>
           </div>
         </div>

          <!-- female card -->
         <div id="female-card" class="card">
           <div class="card-body">
            <div class="row">
              <span class="column col-md-3">
                <h1 class="fas fa-female"></h1>
              </span>
              <span class="column col-md-8" style="float:right">
               <h3><?php echo $_SESSION['female']; ?></h3>
               <small>Female</small>
             </span>
           </div>
         </div>
       </div>

        <!-- average card -->
       <div id="average-card" class="card">
         <div class="card-body">
          <div class="row">
            <span class="column col-md-3">
              <h1 class="fas fa-chart-line"></h1>
            </span>
            <span class="column col-md-8" style="float:right">
             <h3><?php echo $_SESSION['male']+$_SESSION['female']; ?></h3>
             <small>Total</small>
           </span>
         </div>
       </div>
     </div>

    </div>
 </div>

 <!-- overview section -->
 <div id="overview">
  <h4 style="display:inline-block">Overview</h4>
    <!-- select view chart by type -->
    <div class="btn-group dropleft" style="float:right; padding-right: 10px;">
  <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Select type
  </button>
  <div class="dropdown-menu" style="cursor:pointer">
    <a class="dropdown-item" id="fat" onclick="setTypeCal('fat')">Fat</a>
    <a class="dropdown-item" id="BMI" onclick="setTypeCal('BMI')">BMI</a>
    <a class="dropdown-item" id="muscle" onclick="setTypeCal('muscle')">Muscle Mass Index</a>
    <a class="dropdown-item" id="handGrip" onclick="setTypeCal('handGrip')">Hand Grip</a>
    <a class="dropdown-item" id="meterTime" onclick="setTypeCal('meterTime')">6 Meter Time</a>
  </div>
  
</div>
  <!-- Tab panes -->
  <div class=" graph-canvas">
    <div id="displayChart" class="container tab-pane active text-center"><br>
      <?php include 'displayChart.php' ?>
    </div>
<br>
</div>
  

</div>
<!-- end overview section -->


</div>


</div>
<!-- end contentside -->

</div>
</div>

<script type="text/javascript">
  function closeIt()
  {
    <?php session_destroy(); ?>
    return undefined;
  }
  window.onbeforeunload = closeIt;

  function setTypeCal(typeCal) {
    let currentType = '<?php echo $_SESSION['typeChart']; ?>';
    let currentStart = '<?php echo $_SESSION['startDate']; ?>';
    let currentEnd = '<?php echo $_SESSION['endDate']; ?>';

    document.getElementById('typeCal').value = typeCal;
    document.getElementById('startDate').value = currentStart;
    document.getElementById('endDate').value = currentEnd;
    if(currentType == 'boxplot') {
      document.getElementsByName('typeChart')[1].checked = true;
    }

    document.getElementById('customizeChart').submit();
  }

  function openNav() {
  document.getElementById("main_nav").style.display = "block";
  document.getElementById("blur-body").style.display = "block";
  document.body.style.overflow = "hidden";
}

function closeNav() {
  document.getElementById("main_nav").style.display = "none";
  document.getElementById("blur-body").style.display = "none";
  document.body.style.overflow = "visible";
}

</script>

</body>
</html>