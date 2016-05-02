<?php
  // include '/diska/www/include/coa123-13-connect.php'
  include 'config.inc';
  $dbh = new PDO('mysql:host=localhost;dbname=coa123wdb', $username1, $password1);

  function getVenueDetails($id) {
    global $dbh;
    $query = $dbh->prepare('SELECT * FROM venue WHERE venue_id=?');
    $query->execute(array($id));
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    return $results;
  }

  function getVenueBetweenCapacities($min, $max) {
    global $dbh;
    $query = $dbh->prepare('SELECT name, weekend_price, weekday_price FROM `venue` WHERE `capacity`<=:max AND `capacity`>=:min');
    $query->execute(array(':min' => $min, ':max' => $max));
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    return $results;
  }

  function getAvailableVenuesWithCapacity($date, $partySize) {
    global $dbh;
    $day = DateTime::createFromFormat("d/m/Y", $date)->format('N');
    if ($day>=6) {
      $qString = 'SELECT name, weekend_price as price FROM `venue`,`venue_booking` WHERE venue.venue_id = venue_booking.venue_id AND venue_booking.date_booked != :date AND venue.capacity <= :partySize GROUP BY name';
    } else {
      $qString = 'SELECT name, weekday_price as price FROM `venue`,`venue_booking` WHERE venue.venue_id = venue_booking.venue_id AND venue_booking.date_booked != :date AND venue.capacity <= :partySize GROUP BY name';
    }
    $query = $dbh->prepare($qString);
    $query->execute(array(':date' => $date, ':partySize' => $partySize));
    $results = $query->fetchAll();
    return $results;
  }
