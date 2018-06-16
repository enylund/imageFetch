<?php
  include_once '../vendor/simple_html_dom.php';
    $siteArray = [
      ["http://www.breitbart.com/","breitbart"], // Works
      ["https://cryptonews.com/","crytonews"], // Works images small
      ["http://www.espn.com/","espn"], //Not working
      ["http://www.foxnews.com/","foxnews"], // Works
      ["https://www.gamespot.com/news/","game-spot"], // Works
      ["https://gunmagwarehouse.com/","gunmagwarehouse"], // Works
      ["https://hiphopdx.com/","hiphopdx"], // Works
      ["https://www.infowars.com/","infowars"], // Works
      ["https://www.nationalenquirer.com/","nationalenquirer"], // Works
      ["https://nypost.com/","nypost"], // Works
      ["https://www.nytimes.com/","nytimes"], // Works
      ["http://thesource.com/","thesource"], // Works
      ["https://www.theverge.com/","theverge"], // Works HUGE files
      ["http://time.com/","time"], // Works
      ["http://www.tmz.com/?adid=TMZ_Web_Nav_News","tmz"], // Works
      ["https://www.washingtontimes.com/","washingtontimes"], // Works
      ["https://www.wired.com/","wired"] // Works HUGE files
    ];

    foreach($siteArray as &$site) {
      fetchImages($site[0],$site[1]);
    }

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
