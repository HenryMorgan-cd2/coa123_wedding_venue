<?php
require 'database.inc';

class Venue {

  private $venue_columns = ['name', 'capacity', 'weekend_price', 'weekday_price', 'licensed'];
  private $venue_booking_columns = ['booked_dates'];
  private $catering_columns = ['catering_options'];

  function __construct($id) {
    $this->id = $id;
    $this->description = $this->descriptions[$id % 10];
    $this->image = $this->images[$id % 10];
  }

  public function __get($key) {
    if (in_array($key, $this->venue_columns)) {
      $this->perform_venue_query();
      return $this->$key;
    } elseif (in_array($key, $this->venue_booking_columns)) {
      $this->perform_booking_query();
      return $this->$key;
    } elseif (in_array($key, $this->catering_columns)) {
      $this->perform_catering_query();
      return $this->$key;
    }
  }

  public function render() {
    $venue = $this;
    include 'partials/venue_result.html';
  }

  private $descriptions = [
    'The lodge is a lovely open venue, with a large amount of seating to accomate you and your loved ones.',
    'The lodge is a lovely open venue, with a large amount of seating to accomate you and your loved ones.',
    'The lodge is a lovely open venue, with a large amount of seating to accomate you and your loved ones.',
    'The lodge is a lovely open venue, with a large amount of seating to accomate you and your loved ones.',
    'The lodge is a lovely open venue, with a large amount of seating to accomate you and your loved ones.',
    'The lodge is a lovely open venue, with a large amount of seating to accomate you and your loved ones.',
    'The lodge is a lovely open venue, with a large amount of seating to accomate you and your loved ones.',
    'The lodge is a lovely open venue, with a large amount of seating to accomate you and your loved ones.',
    'The lodge is a lovely open venue, with a large amount of seating to accomate you and your loved ones.',
    'The lodge is a lovely open venue, with a large amount of seating to accomate you and your loved ones.',
  ];

  private $images = [
    'images/venue_1.jpg',
    'images/venue_2.jpg',
    'images/venue_3.jpg',
    'images/venue_4.jpg',
    'images/venue_1.jpg',
    'images/venue_2.jpg',
    'images/venue_3.jpg',
    'images/venue_4.jpg',
    'images/venue_1.jpg',
    'images/venue_2.jpg',
  ];



  static function find($id) {
    $ids = (is_array($id)) ? $id : [$id];
    $results = [];
    foreach($ids as $id) {
      $venue = new Venue($id);
    }
    return $results;
  }

  private function perform_venue_query() {
    if ($this->venue_query_executed) return;
    global $dbh;
    $query_string = 'SELECT * FROM venue WHERE venue_id = ?';
    $query = $dbh->prepare($query_string);
    $query->execute([$this->id]);

    $this->venue_query_executed = true;

    $this->inflate_venue_results($query->fetch(PDO::FETCH_ASSOC));  
  }

  private function inflate_venue_results($results) {
    $this->venue_id = $results['venue_id'];
    $this->name = $results['name'];
    $this->capacity = $results['capacity'];
    $this->weekend_price = $results['weekend_price'];
    $this->weekday_price = $results['weekday_price'];
    $this->licensed = $results['licensed'];
  }

  private function perform_booking_query() {
    if ($this->booking_query_executed) return;
    global $dbh;
    $query_string = 'SELECT date_booked FROM venue_booking WHERE venue_id = ?';
    $query = $dbh->prepare($query_string);
    $query->execute([$this->id]);

    $this->booking_query_executed = true;

    $this->inflate_booking_results($query->fetchAll(PDO::FETCH_ASSOC)); 
  }
  
  private function inflate_booking_results($results) {
    $this->booked_dates = [];
    foreach($results as $result) {
      $date = DateTime::createFromFormat("Y-m-d", $result['date_booked']);
      array_push($this->booked_dates, $date);
    }
  }

  private function perform_catering_query() {
    if ($this->catering_query_executed) return;
    global $dbh;
    $query_string = 'SELECT grade, cost FROM catering WHERE venue_id = ?';
    $query = $dbh->prepare($query_string);
    $query->execute([$this->id]);

    $this->catering_query_executed = true;

    $this->inflate_catering_results($query->fetchAll(PDO::FETCH_ASSOC));    
  }

  private function inflate_catering_results($results) {
    $this->catering_options = $results;
  }


  #TODO sanitize conditions - currently unsafe to pass user input directly
  static function where($conditions, $return_data=false) {
    global $dbh;
    if (empty($conditions)) return Venue::all();

    $query_string = 'SELECT DISTINCT venue.venue_id FROM venue, venue_booking, catering WHERE venue.venue_id = venue_booking.venue_id AND venue.venue_id = catering.venue_id AND ' . $conditions;
    echo $query_string;
    $results = $dbh->query($query_string)->fetchAll(PDO::FETCH_NUM);

    $venues = [];
    foreach ($results as $result) {
      array_push($venues, new Venue($result[0]));
    }
    return $venues;
  }

  static function all() {
    global $dbh;
    $query_string = 'SELECT DISTINCT venue_id FROM venue';
    $results = $dbh->query($query_string)->fetchAll(PDO::FETCH_NUM);

    $venues = [];
    foreach ($results as $result) {
      array_push($venues, new Venue($result[0]));
    }
    return $venues;    
  }

}
