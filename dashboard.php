<!DOCTYPE html>
<html lang="en" style="height:100%;">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="js/bootstrap.js">
    <?php
    include_once("php/connection.php");
    session_start();
     ?>
    <link rel="stylesheet" type="text/css" href="css/<?php
    include_once("php/styleloader.php");
    ?>"
    >
    <script type="text/javascript" src="js/jquery-3.2.0.min.js"></script>
    <!--Load the AJAX API-->
   <script type="text/javascript" src="js/loader.js"></script>
   <script type="text/javascript" src="js/xepOnline.jqPlugin.js"></script>
   <script type="text/javascript">
   <?php

   //graph 1
   $sql = "SELECT count(type) as total, type FROM `item` group by type";
   $result = $connection->query($sql);
   $i = 1;
   while ($obj = $result->fetch_object()) {
     $type[$i] = $obj->type;
     $amount[$i] = $obj->total;
     $i++;
   }

    ?>
     // Load the Visualization API and the corechart package.
     google.charts.load('current', {'packages':['corechart']});

     // Set a callback to run when the Google Visualization API is loaded.
     google.charts.setOnLoadCallback(drawChart);
     var svg;
     var svg2 = '#chart_div';
     function AddNamespaceHandler(){
        svg = jQuery(svg2+' svg');
        svg.attr("xmlns", "http://www.w3.org/2000/svg");
        svg.css('overflow','visible');
    }

     // Callback that creates and populates a data table,
     // instantiates the pie chart, passes in the data and
     // draws it.

     function drawChart() {

       var data1 = new google.visualization.DataTable();
       data1.addColumn('string', 'Type');
       data1.addColumn('number', 'Amount');
       data1.addRows([
         <?php
         for ($i=1; $i <= count($type); $i++) {
           if ($i !== count($type)) {
            echo "['$type[$i]', $amount[$i]],";
          } else
           echo "['$type[$i]', $amount[$i]]";
         }
          ?>
       ]);

       var options = {'title':'Types of cars',
                      'width':400,
                      'height':300};

       var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
       google.visualization.events.addListener(chart, 'ready', AddNamespaceHandler);
       chart.draw(data1, options);
       svg2 = '#chart_div1';

       //graph 2
       <?php
       $sql ="SELECT month(date) as mes, SUM(value) as total FROM cart Group By monthname(date) order by mes;";
       $result = $connection->query($sql);
       $mes = [];
       $i = 1;
       while ($obj = $result->fetch_object()) {
          $nombremes[$i] = $obj->mes;
          $mes[$i] = $obj->total;
          $i++;
       }
        ?>
       var data = google.visualization.arrayToDataTable([
           ["Mes", "Valor total de ventas", { role: "style" } ],
           <?php
           for ($i=1; $i <= count($mes); $i++) {
             $dateObj   = DateTime::createFromFormat('!m', $nombremes[$i]);
             $monthName = $dateObj->format('F');
             if ($i !== count($mes)) {
              echo '["'.$monthName.'", '.$mes[$i].', "color: #9575cd" ],';
            } else
             echo '["'.$monthName.'", '.$mes[$i].', "color: #9575cd" ]';
           }
            ?>
       ]);




       var view = new google.visualization.DataView(data);
       view.setColumns([0, 1,
                        { calc: "stringify",
                          sourceColumn: 1,
                          type: "string",
                          role: "annotation" },
                        2]);

       var options = {
         title: "Valor total de ventas por mes",
         width: 400,
         height: 300,
         bar: {groupWidth: "95%"},
         legend: { position: "none" },
       };

       var chart = new google.visualization.ColumnChart(document.getElementById("chart_div1"));
       google.visualization.events.addListener(chart, 'ready',  AddNamespaceHandler);
       chart.draw(view, options);
       svg2 = '#chart_div2';
       //graph 3
       <?php
       $sql= "SELECT `item.reference` as referencia, sum(quantity) as value FROM `quantity` group by referencia";
       $result = $connection->query($sql);
       $i = 1;
       while ($obj = $result->fetch_object()) {
          $sql1= "SELECT name FROM `item` WHERE reference = $obj->referencia";
          $result1 = $connection->query($sql1);
          $obj1 = $result1->fetch_object();
          $name[$i] = $obj1->name;
          $quantity[$i] = $obj->value;
          $i++;
       }
        ?>
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Type');
        data.addColumn('number', 'number');
        data.addRows([
          <?php
          for ($i=1; $i <= count($name); $i++) {
            if ($i !== count($name)) {
             echo "['$name[$i]', $quantity[$i]],";
           } else
            echo "['$name[$i]', $quantity[$i]]";
          }
           ?>
        ]);

        // Set chart options
        var options = {'title':'Cars sold',
                       'width':400,
                       'height':300};


        var chart = new google.visualization.PieChart(document.getElementById('chart_div2'));
        google.visualization.events.addListener(chart, 'ready',  AddNamespaceHandler);
        chart.draw(data, options);
        svg2 = '#chart_div3';
        <?php
        //graph 4
        $sql = "SELECT count(*) as total FROM users where type = 'user'";
        $result = $connection->query($sql);
        $obj = $result->fetch_object();
        $normies = $obj->total;
        $sql = "SELECT count(*) as total FROM users where type = 'admin'";
        $result = $connection->query($sql);
        $obj = $result->fetch_object();
        $admins = $obj->total;
         ?>

       var data = new google.visualization.DataTable();
       data.addColumn('string', 'Type');
       data.addColumn('number', 'number');
       data.addRows([
         ['Normal user', <?php echo "$normies"?>],
         ['Admins', <?php echo "$admins"?>],
       ]);

       var options = {'title':'Admins and users',
                      'width':400,
                      'height':300};

       var chart = new google.visualization.PieChart(document.getElementById('chart_div3'));
       google.visualization.events.addListener(chart, 'ready',  AddNamespaceHandler);
       chart.draw(data, options);

       var click="return xepOnline.Formatter.Format('JSFiddle', {render:'download', srctype:'svg'})";
     }
   </script>
    </head>
    <body style="height:100%;">
      <?php
      if ($_SESSION == NULL) {
        $_SESSION["user"]= "unloged";
      }
      ?>
       <?php
       if ($_SESSION["type"] == "admin") {
         include_once("controlpanel.php");
       }
        ?>
        <div class="col-md-12" id="container" style="min-height:100%;">
          <div class="col-md-12" id="header">
                        <a href="index.php"><img class="pull-left" src="images/logo.png" style="height:50px; width:auto;"/></a>
            <nav class="navbar navbar-default" id="navbar">
              <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                  data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand active" href="index.php">Home</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    <li><a href="cart.php">Cart <?php if(isset($_SESSION['cartadd']) && !empty($_SESSION['cartadd'])) {echo "<i class='glyphicon glyphicon-exclamation-sign'></i>";}?></a></li>
                    <li><a href="contact.php">Contact</a></li>
                  </ul>
                  <form class="navbar-form navbar-left" method="GET" action="index.php">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Search" name="searchname" required>
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                  </form>
                  <ul class="nav navbar-nav navbar-right">
                    <!--Login-->

                    <?php

                    if($_SESSION["user"] == "unloged" or "" ) {
                       echo "
                       <li><a href='register.php'>Register</a></li>
                       <li class='dropdown'>
                        <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button'
                        aria-haspopup='true' aria-expanded='false'>Log in<span class='caret'></span></a>
                        <ul class='dropdown-menu'>
                          <form class='navbar-form navbar-left' id='loger' method='POST' action='php/login.php'>
                            <div class='form-group'>
                                <!--user-->
                              <input type='text' class='form-control' name='user' placeholder='user' required><br><br>
                                <!--password-->
                              <input type='password' class='form-control' name='password' placeholder='password' required><br><br>
                            </div>
                            <input type='checkbox' id='remember' name='remember' value='rememberme'>
                              <label for='remember'>Remember me</label>
                            <button type='submit' class='btn btn-default' value='login'>Log In</button>
                          </form>
                        </ul>
                      </li>";
                    } else { echo "
                      <li><a href='profile.php'>".$_SESSION['user']."</a></li>
                      <li><a id='logerout' onclick='return alertlogout()' href='#' value='logout'>Logout</a></li>
                      ";
                  }
                  unset($connection);
                    ?>
                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav>

          </div>
          <div class="col-md-12" id="content" style="height:100%; overflow:auto;">
            <div id="buttons">

            </div>
            <div id="chart1" class="col-md-3 col-sm-6 col-xs-12" style="margin-top: 15px;">
                <div id="chart_div"></div>
              <button class='btn btn-primary btn-xs' onclick="return xepOnline.Formatter.Format('chart1', {render:'download', srctype:'svg'})">To pdf</button>
            </div>
            <div id="chart2" class="col-md-3 col-sm-6 col-xs-12" style="margin-top: 15px;">
              <div id="chart_div1"></div>
              <button class='btn btn-primary btn-xs' onclick="return xepOnline.Formatter.Format('chart2', {render:'download', srctype:'svg'})">To pdf</button>
            </div>
            <div id="chart3" class="col-md-3 col-sm-6 col-xs-12" style="margin-top: 15px;">
              <div id="chart_div2"></div>
              <button class='btn btn-primary btn-xs' onclick="return xepOnline.Formatter.Format('chart3', {render:'download', srctype:'svg'})">To pdf</button>
            </div>
            <div id="chart4" class="col-md-3 col-sm-6 col-xs-12" style="margin-top: 15px;">
              <div id="chart_div3"></div>
              <button class='btn btn-primary btn-xs' onclick="return xepOnline.Formatter.Format('chart4', {render:'download', srctype:'svg'})">To pdf</button>
            </div>
          </div>
          <!-- footer -->
          <div class="col-md-2" id="footerL">
            <address>
              <strong>2AsirTriana</strong><br>
              1355 Market Street, Suite 900<br>
              San Francisco, CA 94103<br>
            </address>
          </div>
          <div class="col-md-8" id="footer">

          </div>
          <div class="col-md-2" id="footerR">
            <address>
              <strong>Full Name</strong><br>
                <abbr title="Phone">P:</abbr> (123) 456-7890
              <a href="mailto:#">first.last@example.com</a>
            </address>
          </div>
          <!-- end of footer -->
          </div>
        </div>
         <script type="text/javascript" src="js/bootstrap.min.js">
         </script>
         <script type="text/javascript" src="js/check.js">
         </script>
    </body>
</html>
