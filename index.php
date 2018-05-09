<?php
  include_once 'simple_html_dom.php';

    // THIS IS A COMMENT. IT WONT RUN
    fetchImages("https://www.artforum.com/","artforum");
    // fetchImages("https://www.ft.com/","financial-times");
    // fetchImages("https://www.nytimes.com/","nytimes");
    // fetchImages("http://www.spiegel.de/international/","spiegel");
    // fetchImages("https://nypost.com/","nypost");
    // fetchImages("https://www.bloomberg.com/","bloomberg");
    // fetchImages("https://www.ft.com/","financial-times");
    // fetchImages("http://www.dailymail.co.uk/ushome/index.html","dailymail");


    function fetchImages($url, $directory) {

      $page           = $_REQUEST['page'];
      $html           = file_get_html($url.$page);
      $imageDirectory = "img/".$directory;
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

      // Find all images
      foreach($html->find('img') as $img) {

        preg_match_all($regexImageName, $img->src, $matches, PREG_SET_ORDER, 0);

        $filename = $dateDirectory."/".$matches[0][0];

        if ( !file_exists($filename) ) {
            //Get the file
            echo('<img src="'.$img->src.'">');
            $content = file_get_contents($img->src);
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