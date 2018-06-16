<?php
  include_once '../vendor/simple_html_dom.php';

    fetchImages("http://www.africanews.com/","africanews");

    function fetchImages($url, $directory) {

      $html           = file_get_html($url);
      $imageDirectory = "../img/".$directory;
      $date           = date("Y-m-d");
      $dateDirectory  = $imageDirectory."/".$date;
      $regexImageName = '/[\w\.\-\$]+(?=png|jpg|gif)\w+/';


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

      // Show a headline on the page
      echo('<h1>'.$directory.'</h1>');

      // Find all images
      foreach($html->find('img') as $img) {

        preg_match_all($regexImageName, $img->src, $matches, PREG_SET_ORDER, 0);

        list($width, $height, $type, $attr) = getimagesize($img->src);

        if($width > 1 AND $height > 1) {

          $filename = $dateDirectory."/".$matches[0][0];

          if ( !file_exists($filename) ) {
              //Get the file
              echo('<img src="'.$img->src.'">');
              $content = file_get_contents($img->src);

              //Store in the filesystem.
              if($content !== false AND !empty($content)) {
                $fp = fopen($filename, "w");
                fwrite($fp, $content);
                fclose($fp);
              }
          }

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
