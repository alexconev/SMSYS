      <article>
        <h2>Месечен трафик</h2> 
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
          [01,330,150],
          [02,300,120],
          [03,180,330],   
          [04,300,150],
          [05,300,120],
          [06,330,150],           
          [07,330,150],      
          [08,330,150],          
          [09,180,330],
          [10,180,330],
          [11,300,150],
          [12,180,330],
          [13,300,120],
          [14,300,150],
          [15,300,120],
          [16,330,150],
          [17,180,330],
          [18,300,150],            
          [19,300,120],
          [20,330,150],          
          [21,300,150],
          [22,180,330],
          [23,300,150],
          [24,300,120],
          [25,330,150],
          [26,300,120],
          [27,180,330],   
          [28,300,150],
          [29,300,120],
          [30,330,150],                        
        ]);

        var options = {
          hAxis: {title: 'Май 2015',  titleTextStyle: {color: '#333'}, ticks: [2,4,6,8,10,12,14,16,18,20,22,24,26,28,30]},
          vAxis: {title: 'Брой', minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>    
