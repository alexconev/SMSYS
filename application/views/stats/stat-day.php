      <article>
        <h2>Дневен трафик</h2> 
        <div id="chart_div" style="width: 100%; height: 450px;"></div>
        <div class="clear"></div>
      </article>
    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Дата', 'Входящи', 'Изходящи'],
          [00,10,4],
          [01,11,5],
          [02,10,4],
          [03,6,11],   
          [04,10,5],
          [05,10,4],
          [06,11,5],           
          [07,11,5],      
          [08,11,5],          
          [09,6,11],
          [10,6,11],
          [11,10,5],
          [12,6,11],
          [13,10,4],
          [14,10,5],
          [15,10,4],
          [16,11,5],
          [17,6,11],
          [18,10,5],            
          [19,10,4],
          [20,11,5],          
          [21,10,5],
          [22,6,11],
          [23,10,5]               
        ]);

        var options = {
          hAxis: {title: '15.05.2015',  titleTextStyle: {color: '#333'}, ticks: [0,2,4,6,8,10,12,14,16,18,20,22]},
          vAxis: {title: 'Брой', minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>         
