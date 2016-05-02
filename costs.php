<?php include 'database.inc' ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Venue Details</title>
  </head>
  <body></body>
  <table></table>
  <table>
    <thead>
      <th>Name</th>
      <th>Price</th>
    </thead>
    <tbody>
      <?php foreach(getAvailableVenuesWithCapacity($_GET['date'], $_GET['partySize']) as $result): ?>
      <tr>
        <?php foreach($result as $column => $value): ?>
        <td><?php echo $value; ?></td>
        <?php endforeach; ?>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</html>
