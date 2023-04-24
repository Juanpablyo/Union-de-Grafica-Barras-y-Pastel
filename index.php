<!DOCTYPE html>
<html>
    <head>
        <title>Crea </title>
        <div><img src="spidey vs batman.jpg" width="500"> <img src="thanosbig.jpg" width="500"> <img src="sanic.jpg" width="1000"></div>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript">

            function drawChart() {
                // call ajax function to get sports data
                var jsonData = $.ajax({
                    url: "getData.php",
                    dataType: "json",
                    async: false
                }).responseText;
                //The DataTable object is used to hold the data passed into a visualization.
                var data = new google.visualization.DataTable(jsonData);
 
                // To render the pie chart.
                var chart = new google.visualization.PieChart(document.getElementById('chart_container'));
                chart.draw(data, {width: 800, height: 500});
            }


            // load the visualization api
            google.charts.load('current', {'packages':['corechart']});
 
            // Set a callback to run when the Google Visualization API is loaded.
            google.charts.setOnLoadCallback(drawChart);



        </script>


        
    </head>
    <body>
           <div id="chart_container"></div>
    </body>
</html>

<?php

    $con = new mysqli("localhost","root","","comics"); // Conectar a la BD
    $sql = "select * from venta"; // Consulta SQL
    $query = $con->query($sql); // Ejecutar la consulta SQL
    $data = array(); // Array donde vamos a guardar los datos
    while($r = $query->fetch_object()){ // Recorrer los resultados de Ejecutar la consulta SQL
        $data[]=$r; // Guardar los resultados en la variable $data
    }

    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Grafica de Barra y Lineas con PHP y MySQL</title>
        <script src="chart.min.js"></script>
    </head>
    <body>
    <h1>Grafica de Barra y Lineas con PHP y MySQL</h1>
    <canvas id="chart1" style="width:100%;" height="100"></canvas>
    <script>
    var ctx = document.getElementById("chart1");
    var data = {
            labels: [ 
            <?php foreach($data as $d):?>
            "<?php echo $d->date_at?>", 
            <?php endforeach; ?>
            ],
            datasets: [{
                label: '$ Ventas',
                data: [
            <?php foreach($data as $d):?>
            <?php echo $d->val;?>, 
            <?php endforeach; ?>
                ],
                backgroundColor:  "#5922C6",
                borderColor: "#F768AB",
                borderWidth: 2
            }]
        };
    var options = {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        };
    var chart1 = new Chart(ctx, {
        type: 'bar', /* valores: line, bar*/
        data: data,
        options: options
    });
    </script>
    </body>
    </html>