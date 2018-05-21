<?php

  function fetchPath() {
    $dirs = array_filter(glob('img/*'), 'is_dir');
    $rand_key = array_rand($dirs);
    $rand_folder = $dirs[$rand_key];


    $subdirs = array_filter(glob($rand_folder.'/*'), 'is_dir');
    $rand_sub_key = array_rand($subdirs);
    $rand_sub_folder = $subdirs[$rand_sub_key];

    $rand_image_array = scandir($rand_sub_folder);

    $rand_image_key = array_rand($rand_image_array);
    $rand_image = $rand_image_array[$rand_image_key];

    return $rand_sub_folder.'/'.$rand_image;
  }

  $bottom_image_path = fetchPath();
  $regexImageName = '/[\w\.\-\$]+(?=png|jpg|gif)\w+/';
  preg_match_all($regexImageName, $bottom_image_path, $bottom_image_matches, PREG_SET_ORDER, 0);

  while (empty($bottom_image_matches)) {
    $bottom_image_path = fetchPath();
    preg_match_all($regexImageName, $bottom_image_path, $bottom_image_matches, PREG_SET_ORDER, 0);
  }

  $top_image_path = fetchPath();
  preg_match_all($regexImageName, $top_image_path, $top_image_matches, PREG_SET_ORDER, 0);

  while (empty($top_image_matches)) {
    $top_image_path = fetchPath();
    preg_match_all($regexImageName, $top_image_path, $top_image_matches, PREG_SET_ORDER, 0);
  }
?>

<!DOCTYPE html>
<!--[if lte IE 6]><html class="preIE7 preIE8 preIE9"><![endif]-->
<!--[if IE 7]><html class="preIE8 preIE9"><![endif]-->
<!--[if IE 8]><html class="preIE9"><![endif]-->
<!--[if gte IE 9]><!-->
<html style="background: url(<?php echo $bottom_image_path ?>) no-repeat center center fixed;background-size: cover; background-color: red;
  background-blend-mode: multiply;"><!--<![endif]-->
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1">
      <title>Image Fetch</title>
    <meta name="author" content="name">
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">
    <link rel="stylesheet" type="text/css" href="assets/main.css">
  </head>
  <body>
    <div class="context-info">
      <div class="path-wrapper"><?php echo $bottom_image_path ?></div>
      <div class="timer-wrapper"></div>
    </div>
    <canvas id="image-canvas" data-path="/image-fetch/<?php echo $top_image_path ?>"></canvas>
    <script src="assets/main.js" type="text/javascript"></script>
  </body>
</html>
