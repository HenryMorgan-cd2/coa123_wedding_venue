<?php

  function shutdown() {
    $error = error_get_last();
    if ($error != null) {
      $url = explode('?', $_SERVER['REQUEST_URI'])[0] . '?error';      
      // header("location: {$url}");
    }
  }

  register_shutdown_function('shutdown');
