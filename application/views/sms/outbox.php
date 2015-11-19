      <article>
        <h2>Изходящи съобщения</h2>  
        <div class="list">
          <?php foreach ($outbox as $sms_item): ?>
            <div class="item">
              <div class="number"><?php echo $sms_item['Recipient'] ?></div>
              <div class="message"><?php echo $sms_item['Content'] ?></div>
              <div class="date"><?php echo date("H:i d.m.Y", strtotime($sms_item['Date'])); ?></div>
              <div class="controls">
                <a class="delete" href="#">&nbsp;</a>
              </div>
              <div class="clear"></div>
            </div>
          <?php endforeach; ?>  
        </div>    
        <?php echo $paging; ?>                
        <div class="clear"></div>
      </article>
