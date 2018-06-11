<?php
  include_once 'simple_html_dom.php';

    fetchImages("https://www.techradar.com/","techradar");

    function fetchImages($url, $directory) {

      $html           = file_get_html($url);
      $imageDirectory = "img/".$directory;
      $date           = date("Y-m-d");
      $dateDirectory  = $imageDirectory."/".$date;



      if ( !file_exists($imageDirectory) ) {
        mkdir ($imageDirectory);
      }

      if ( !file_exists($dateDirectory) ) {
        mkdir ($dateDirectory);
      }


      // Start contact sheet head
      $dir = $dateDirectory.'/cache';
      if ( !file_exists($dir) ) {
        mkdir ($dir, 0744);
      }
      $cachefile = $dir.'/'.$date.'.html';
      ob_start(); // start the output buffer
      // End Cache Head

      // Find all images
      foreach($html->find('.feature-block-item img') as $img) {
          $source = $img->getAttribute('data-original-mos');

          $regexImageName = '/[\w\.\-\$]+(?=png|jpg|gif)\w+/';
          preg_match($regexImageName, $source, $match, PREG_OFFSET_CAPTURE, 0);

          $filename = $dateDirectory."/".$match[0][0];

          if ( !file_exists($filename) ) {
            //Get the file
            echo('<img src="'.$source.'">');

            $content = file_get_contents($source);
            //Store in the filesystem.
            $fp = fopen($filename, "w");
            fwrite($fp, $content);
            fclose($fp);
          }
      }

      // Start Cache Footer
      $fp = fopen($cachefile, 'a'); // open the cache file for writing
      fwrite($fp, ob_get_contents()); // save the contents of output buffer to the file
      fclose($fp); // close the file
      ob_end_flush(); // Send the output to the browser
      // End Cache Footer
    }
?>
