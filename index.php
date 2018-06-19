<?php

  function dirToArray($dir) {

     $result = array();

     $cdir = scandir($dir);
     foreach ($cdir as $key => $value)
     {
        if (!in_array($value,array(".","..",".DS_Store","cache")))
        {
           if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
           {
              $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
           }
           else
           {
              $result[] = $value;
           }
        }
     }

     return $result;
  }

  $directory_structure_array = dirToArray('img');
  $directory_structure_json = json_encode($directory_structure_array);
  // echo '<pre>' , var_dump($directory_structure["africanews"]["2018-05-18"][0]) , '</pre>';

  // $regexImageName = '/[\w\.\-\$]+(?=png|jpg|gif)\w+/';
  // preg_match_all($regexImageName, $bottom_image_path, $bottom_image_matches, PREG_SET_ORDER, 0);

  // while (empty($bottom_image_matches)) {
  //   $bottom_image_path = fetchPath();
  //   preg_match_all($regexImageName, $bottom_image_path, $bottom_image_matches, PREG_SET_ORDER, 0);
  // }

  // $top_image_path = fetchPath();
  // preg_match_all($regexImageName, $top_image_path, $top_image_matches, PREG_SET_ORDER, 0);

  // while (empty($top_image_matches)) {
  //   $top_image_path = fetchPath();
  //   preg_match_all($regexImageName, $top_image_path, $top_image_matches, PREG_SET_ORDER, 0);
  // }
?>

<!DOCTYPE html>
<!--[if lte IE 6]><html class="preIE7 preIE8 preIE9"><![endif]-->
<!--[if IE 7]><html class="preIE8 preIE9"><![endif]-->
<!--[if IE 8]><html class="preIE9"><![endif]-->
<!--[if gte IE 9]><!-->
<html><!--<![endif]-->
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1">
      <title>Sun Scraper</title>
    <meta name="author" content="name">
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">
    <link rel="stylesheet" type="text/css" href="assets/main.css">
  </head>
  <body data-json='<?php echo $directory_structure_json ?>'>
    <div class="image-one"></div>
    <div class="image-two"></div>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="assets/get_json.js" type="text/javascript"></script>
</html>
