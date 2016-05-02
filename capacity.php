<?php include 'database.inc' ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Capacity</title>
  </head>
  <body></body>
  <table>
    <thead>
      <th>Name</th>
      <th>Weekend Price</th>
      <th>Weekday Price</th>
    </thead>
    <tbody>
      <?php foreach(getVenueBetweenCapacities($_GET['minCapacity'], $_GET['maxCapacity']) as $result): ?>
      <tr>
        <?php foreach($result as $column => $value): ?>
        <td><?php echo $value; ?></td>
        <?php foreach(getVenueBetweenCapacities($_GET['minCapacity'], $_GET['maxCapacity']) as $column => $value): ?>
        <?php endforeach; ?>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</html>
