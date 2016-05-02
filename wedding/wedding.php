<?php
  include 'wedding_results.inc';
?>
<html>
  <head>
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css' rel='stylesheet'>
    <link href='style.css' rel='stylesheet'>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js'></script>
    <script src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js'></script>
    <script src='script.js'></script>
  </head>
  <body>
    <header id='header'>
      <div id='header_inner'>
        <h1>Find My Venue</h1>
      </div>
    </header>
    <div id='page_wrapper'>
      <div id='page_container'>
        <div id='side_bar'>
          <h2>Filter Venues</h2>
          <form>
            <div class='field'>
              <label for='party_size'>Party Size</label>
              <input name='party_size' type='number' value='<?php if (isset($party_size)) echo $party_size; ?>'>
            </div>
            <div class='field'>
              <label>Quality Of Catering</label>
              <div class='rating_fields'>
                <div class='rating_field'>
                  <?php if ($quality && strpos($quality, '5') > -1): ?>
                  	<input checked='checked' class='hidden' id='quality_5' name='quality[]' type='checkbox' value='5'>
                  <?php else: ?>
                  	<input class='hidden' id='quality_5' name='quality[]' type='checkbox' value='5'>
                  <?php endif; ?>
                  <label for='quality_5'> &#9733; &#9733; &#9733; &#9733; &#9733;</label>
                </div>
                <div class='rating_field'>
                  <?php if ($quality && strpos($quality, '4') > -1): ?>
                  	<input checked='checked' class='hidden' id='quality_4' name='quality[]' type='checkbox' value='4'>
                  <?php else: ?>
                  	<input class='hidden' id='quality_4' name='quality[]' type='checkbox' value='4'>
                  <?php endif; ?>
                  <label for='quality_4'> &#9733; &#9733; &#9733; &#9733;</label>
                </div>
                <div class='rating_field'>
                  <?php if ($quality && strpos($quality, '3') > -1): ?>
                  	<input checked='checked' class='hidden' id='quality_3' name='quality[]' type='checkbox' value='3'>
                  <?php else: ?>
                  	<input class='hidden' id='quality_3' name='quality[]' type='checkbox' value='3'>
                  <?php endif; ?>
                  <label for='quality_3'> &#9733; &#9733; &#9733;</label>
                </div>
                <div class='rating_field'>
                  <?php if ($quality && strpos($quality, '2') > -1): ?>
                  	<input checked='checked' class='hidden' id='quality_2' name='quality[]' type='checkbox' value='2'>
                  <?php else: ?>
                  	<input class='hidden' id='quality_2' name='quality[]' type='checkbox' value='2'>
                  <?php endif; ?>
                  <label for='quality_2'> &#9733; &#9733;</label>
                </div>
                <div class='rating_field'>
                  <?php if ($quality && strpos($quality, '1') > -1): ?>
                  	<input checked='checked' class='hidden' id='quality_1' name='quality[]' type='checkbox' value='1'>
                  <?php else: ?>
                  	<input class='hidden' id='quality_1' name='quality[]' type='checkbox' value='1'>
                  <?php endif; ?>
                  <label for='quality_1'> &#9733;</label>
                </div>
              </div>
            </div>
            <div class='fields'>
              <div class='field'>
                <label for='earliest'>Earliest</label>
                <input class='datepicker' name='earliest'>
              </div>
              <div class='field'>
                <label for='latest'>Latest</label>
                <input class='datepicker' name='latest'>
              </div>
            </div>
            <div class='actions'>
              <input type='submit' value='Update'>
            </div>
          </form>
        </div>
        <div id='page_content'>
          <!-- Print errors -->
          <?php if (isset($_GET['error'])): ?>
          	<div class='notice error'>We're sorry an error has occured.</div>
          <?php endif; ?>
          <?php
            if (sizeof($venues) > 0):
              foreach($venues as $venue) {
                $venue->render();
              }
            else:
          ?>
          <div class='notice info'>
            Sorry, we have no venues to match your current query.
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </body>
</html>
