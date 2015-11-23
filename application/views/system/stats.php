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
          <?php 
            if(isset($arData) && is_array($arData))
              foreach ($arData as $day => $arItem) {
                echo "[".$day.",".$arItem['inbox'].",".$arItem['outbox']."],";
              }   
          ?>            
        ]);

        var options = {
          hAxis: {title: '<?php echo date("m.Y"); ?>',  titleTextStyle: {color: '#333'}, ticks: [1,2,4,6,8,10,12,14,16,18,20,22,24,26,28,30,31]},
          vAxis: {title: 'Брой съобщения', minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>         
