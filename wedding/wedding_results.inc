<?php
  include 'bin/error_handler.inc';
  include 'bin/database.inc';
  require 'bin/venue.cls';

  $conditions = [];

  if (!empty($_GET['party_size'])) {
    $party_size = $_GET['party_size'];
    print_r(preg_match('/^\d+$/', $party_size));
    array_push($conditions, "venue.capacity <= {$party_size}");
  }

  if (!empty($_GET['quality'])) {
    $quality = $_GET['quality'];
    // array
  }

  // $quality = (!empty($_GET['quality'])) ? join(array_values($_GET['quality']), ',') : '1,2,3,4,5';
  // $earliest = (!empty($_GET['earliest'])) ? DateTime::createFromFormat("d/m/Y", $_GET['earliest']) : null;
  // $latest = (!empty($_GET['latest'])) ? DateTime::createFromFormat("d/m/Y", $_GET['latest']) : null;


  // $condition_query = implode($conditions, ' AND ');

  // $venues = Venue::where($condition_query);

  // $venues = Venue::where([
  //   "venue.capacity >= {$party_size}",
  //   "catering.quality IN $quality",
  //   'earliest' => $earliest,
  //   'latest' => $latest,
  // ]);

  // foreach($venues as $venue) {
  //   include 'partials/venue_result.html';
  // }