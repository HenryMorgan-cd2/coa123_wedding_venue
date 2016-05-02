<?php include 'database.inc' ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Venue Details</title>
  </head>
  <body></body>
  <table>
    <?php foreach(getVenueDetails($_GET['venueId'])[0] as $column => $value): ?>
    <tr>
      <th><?php echo $column; ?></th>
      <td><?php echo $value; ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
</html>
