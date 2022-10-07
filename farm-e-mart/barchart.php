<?php 

include "config.php";

?>
<html>
  <head>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="datatable/dataTable.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/clientstyle.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses', 'Profit'],
          <?php
            $query="select * from barchart";
            $res=mysqli_query($conn,$query);
            while($data=mysqli_fetch_array($res)){
              $year=$data['year'];
              $sale=$data['sale'];
              $expenses=$data['expenses'];
              $profit=$data['profit'];
          ?>
          ['<?php echo $year;?>',<?php echo $sale;?>,<?php echo $expenses;?>,<?php echo $profit;?>],   
          <?php   
          }
          ?> 
        ]);

        var options = {
          chart: {
            title: 'Company Performance',
            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
          },
          bars: 'vertical' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  </head>
  
  <body>
    <!-- SIDEBAR -->
	<section id="sidebar">
		<a href="farmersite.php" class="brand">
			<i class="fas fa-shopping-basket"></i>
			<span class="text">&nbsp;Farm-E-Mart</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="dashboard.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">My Store</span>
				</a>
			</li>
			<li>
				<a href="barchart.php">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Analytics</span>
				</a>
			</li>
			<li>
				<a href="clientsinfo.php">
					<i class='bx bxs-group' ></i>
					<span class="text">Clients</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->

    <div id="barchart_material" style="width: 900px; height: 500px; margin-left: 45em; margin-top: 8em;"></div>
  </body>
</html>

