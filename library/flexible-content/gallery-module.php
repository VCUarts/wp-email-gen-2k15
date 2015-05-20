<table cellpadding="0" cellspacing="0" border="0" align="center">
  <tr>

  <?php 
  $items = get_sub_field('gallery_item');
  $itemCount = 0;

  if (get_sub_field('columns') == 3):
    foreach( $items as $item): $itemCount++;

      if ($itemCount % 3 == 0 ): ?>
        <td class="column column-last" width="180" valign="top">
          <?php 
          echo $itemCount; 
          $itemCount = 0; ?>
      <?php 
      elseif ($itemCount % 2 == 1 ): ?>
        <td class="column column-first" width="180" valign="top">
          <?php echo $itemCount; ?>
      <?php 
      else: ?>
        <td class="column column-mid" width="180" valign="top">
          <?php echo $itemCount; ?>
      <?php 
      endif; ?>
        </td>
    <?php 
    endforeach; ?>

  <?php 
  elseif (get_sub_field('columns') == 2):
    foreach( $items as $item): $itemCount++;
      if ($itemCount % 2 == 1 ): ?>
        <td class="column column-one" width="265" valign="top">
          <?php echo $itemCount; ?>
      <?php 
      else: ?>
        <td class="column column-two" width="265" valign="top">
          <?php echo $itemCount; ?>
      <?php 
      endif; ?>
        </td>
    <?php 
    endforeach; ?>
  
  <?php 
  else: ?>
    <td>
    <?php
    foreach( $items as $item): ?>
        <?php echo $itemCount; ?>
    <?php
    endforeach; ?>
    </td>

  <?php 
  endif; 
  ?>

  </tr>
</table>