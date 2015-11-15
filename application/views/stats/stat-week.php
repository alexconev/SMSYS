      <article>
        <h2>Седмичен трафик</h2> 
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
          [07,11,5]                 
        ]);

        var options = {
          hAxis: {title: '27.07 - 02.08',  titleTextStyle: {color: '#333'}, ticks: [1,2,3,4,5,6,7]},
          vAxis: {title: 'Брой', minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>    
