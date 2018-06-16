<?php
  include_once '../vendor/simple_html_dom.php';

    fetchImages("https://www.artforum.com/","artforum");

    function fetchImages($url, $directory) {

      $html           = file_get_html($url);
      $imageDirectory = "../img/".$directory;
      $date           = date("Y-m-d");
      $dateDirectory  = $imageDirectory."/".$date;
      $regexImageName = '/[\w\.\-\$]+\/[\w\.\-\$]+(?=png|jpg|gif)\w+/';

      if ( !file_exists($imageDirectory) ) {
        mkdir ($imageDirectory);
      }

      if ( !file_exists($dateDirectory) ) {
        mkdir ($dateDirectory);
      }

      // Show a headline on the page
      echo('<h1>'.$directory.'</h1>');

      // Start contact sheet head
      $dir = $dateDirectory.'/cache';
      if ( !file_exists($dir) ) {
        mkdir ($dir, 0744);
      }
      $cachefile = $dir.'/'.$date.'.html';
      ob_start(); // start the output buffer
      // End Cache Head

      $bloglistArray = $html->find('.hp-bloglist__image');

      // Find all images
      foreach($bloglistArray as $img) {

        preg_match_all($regexImageName, 'https://www.artforum.com/'.$img->src, $matches, PREG_SET_ORDER, 0);
        $final_match = str_replace('/','-',$matches[0][0]);
        $filename = $dateDirectory."/".$final_match;

        if ( !file_exists($filename) ) {
            //Get the file
            echo('<img src="https://www.artforum.com/'.$img->src.'">');
            $content = file_get_contents('https://www.artforum.com/'.$img->src);
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
