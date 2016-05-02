<?php
  $min = $_GET['min'];
  $max = $_GET['max'];
  $c1 = $_GET['c1'];
  $c2 = $_GET['c2'];
  $c3 = $_GET['c3'];
  $c4 = $_GET['c4'];
  $c5 = $_GET['c5'];
?>
<!DOCTYPE html>
<html></html>
<head>
  <title></title>
</head>
<body></body>
<table>
  <?php
    $start = ($max-$min)%5 == 0 ? $min : $min/5*5;
    $end = ($max-$min)%5 == 0 ? $max : (1+$max/5)*5;
  ?>
  <table>
    <thead>
      <tr>
        <th></th>
        <th><?php echo $c1; ?></th>
        <th><?php echo $c2; ?></th>
        <th><?php echo $c3; ?></th>
        <th><?php echo $c4; ?></th>
        <th><?php echo $c5; ?></th>
      </tr>
    </thead>
    <tbody>
      <?php for($i=$start; $i<=$end; $i+=5): ?>
      <tr>
        <th><?php echo $i; ?></th>
        <td><?php echo $c1 * $i; ?></td>
        <td><?php echo $c2 * $i; ?></td>
        <td><?php echo $c3 * $i; ?></td>
        <td><?php echo $c4 * $i; ?></td>
        <td><?php echo $c5 * $i; ?></td>
      </tr>
      <?php endfor; ?>
    </tbody>
  </table>
</table>
