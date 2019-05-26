<!DOCTYPE html>
<html lang="en">
<head>
  <title>BMI</title>
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

  

</head>

<body>

  <div class="container-fluid">
    <div class="row content">
      <div class="col-md-3 sidenav" id="main_nav" >
        <div style="position: relative;">
        <h5>CUSTOMIZE<br>YOUR CHART</h5>
        <hr>
        <div class="custom-plot ">
          <!-- graph type  -->
          <form action="setDefault.php" method="GET" id="graph-type">

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
              <input class="form-control" type="date" name="startDate" value="">
            </div>

          <br><p class="text-left">to</p>

            <div>
              <input type="date" class="form-control"  name="endDate"  value="">
            </div>
            <br>
            
          <div name="typeCal" style="display:none;"></div>

          <input type="submit" value="Submit" class="btn btn-sm btn-primary"/>

          </form>
          

      </div>
    </div>
  </div>
      <!--end nav side -->

      <br><br>
      <div class="col-md contentside">

        <a href="#main_nav"><h3 id="menuclick" class="fas fa-bars" style="position: absolute;"></h3></a>
        <h4 class="text-center"><span class="fas fa-columns"></span> Upload</h4><hr>

        <br>      

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
                 <h3>00</h3>
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
               <h3>00</h3>
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
             <h3>00.0</h3>
             <small>Average</small>
           </span>
         </div>
       </div>
     </div>

   </div>
 </div>

 <br>

 <!-- overview section -->
 <div id="overview">
  <h4 style="display:inline-block">Overview</h4>

  <br>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs nav-justified" role="tablist" style="width: 100%">
    <li class="nav-item custom-card">
      <a class="nav-link active" data-toggle="tab" href="#fat">Fat/Muscle Mass Ratio(kg/Kg)</a>
    </li>
    <li class="nav-item custom-card">
      <a class="nav-link" data-toggle="tab" href="#bmi">BMI(Kg/M<sup>2</sup>)</a>
    </li>
    <li class="nav-item custom-card">
      <a class="nav-link" data-toggle="tab" href="#muscle">Muscle Mass Index(Kg/M<sup>2</sup>)</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content graph-canvas">

    <!-- graph 1 -->
    <div id="fat" class="container tab-pane active"><br>
      <figure class="text-center">
        <?php //include 'boxplotDisplay.php' ?>
      </figure>
    </div>

    <!-- graph 2 -->
    <div id="bmi" class="container tab-pane fade"><br>
      <figure class="text-center">
        <?php //include 'scatterplot.php' ?>
      </figure>
    </div>

    <!-- graph 3 -->
    <div id="muscle" class="container tab-pane fade"><br>
      <figure class="text-center">
        <?php //include 'scatterplot.php' ?>
      </figure>
    </div>

  </div>

</div>
<!-- end overview section -->


</div>


</div>
<!-- end contentside -->

</div>
</div>

<script type="text/javascript">
  var nav = document.getElementById('menuclick'),
  body = document.body;
  nav.addEventListener('click', function(e) {
    body.className = body.className? '' : 'with_nav';
    e.preventDefault();
  });

</script>

</body>
</html>