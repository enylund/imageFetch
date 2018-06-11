<?php
  include_once 'simple_html_dom.php';

    fetchImages("http://www.mtv.com/","mtv");

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
      foreach($html->find('div#tier_1 div.image_holder') as $story) {
          $source = $story->getAttribute('data-info');
              $re = '/\/\/.+?(?=png|jpg|gif)\w+/';
          preg_match($re, $source, $matches, PREG_OFFSET_CAPTURE, 0);
          $finalurl = substr($matches[0][0], 2);
          $regexImageName = '/[\w\.\-\$]+(?=png|jpg|gif)\w+/';
          preg_match($regexImageName, $finalurl, $matchesTwo, PREG_OFFSET_CAPTURE, 0);
          $withdots = $matchesTwo[0][0];
          $nodots = preg_replace('/\.(?=.*\.)/', '', $withdots);

          $filename = $dateDirectory."/".$nodots;
          echo($filename);

          if ( !file_exists($filename) ) {
            //Get the file
            echo('<img src="http://'.$finalurl.'">');

            $content = file_get_contents('http://'.$finalurl);
            //Store in the filesystem.
            $fp = fopen($filename, "w");
            fwrite($fp, $content);
            fclose($fp);
          }
      }
      foreach($html->find('div#tier_2 div.image_holder') as $story) {
          $source = $story->getAttribute('data-info');
              $re = '/\/\/.+?(?=png|jpg|gif)\w+/';
          preg_match($re, $source, $matches, PREG_OFFSET_CAPTURE, 0);
          $finalurl = substr($matches[0][0], 2);
          $regexImageName = '/[\w\.\-\$]+(?=png|jpg|gif)\w+/';
          preg_match($regexImageName, $finalurl, $matchesTwo, PREG_OFFSET_CAPTURE, 0);
          $withdots = $matchesTwo[0][0];
          $nodots = preg_replace('/\.(?=.*\.)/', '', $withdots);

          $filename = $dateDirectory."/".$nodots;
          echo($filename);

          if ( !file_exists($filename) ) {
            //Get the file
            echo('<img src="http://'.$finalurl.'">');

            $content = file_get_contents('http://'.$finalurl);
            //Store in the filesystem.
            $fp = fopen($filename, "w");
            fwrite($fp, $content);
            fclose($fp);
          }
      }
      foreach($html->find('div#tier_3 div.image_holder') as $story) {
          $source = $story->getAttribute('data-info');
              $re = '/\/\/.+?(?=png|jpg|gif)\w+/';
          preg_match($re, $source, $matches, PREG_OFFSET_CAPTURE, 0);
          $finalurl = substr($matches[0][0], 2);
          $regexImageName = '/[\w\.\-\$]+(?=png|jpg|gif)\w+/';
          preg_match($regexImageName, $finalurl, $matchesTwo, PREG_OFFSET_CAPTURE, 0);
          $withdots = $matchesTwo[0][0];
          $nodots = preg_replace('/\.(?=.*\.)/', '', $withdots);

          $filename = $dateDirectory."/".$nodots;
          echo($filename);

          if ( !file_exists($filename) ) {
            //Get the file
            echo('<img src="http://'.$finalurl.'">');

            $content = file_get_contents('http://'.$finalurl);
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
