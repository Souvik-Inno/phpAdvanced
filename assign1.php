<?php

  // Fetches data from url and stores in object.
  require("classes/classJsonData.php");
  $url = 'https://ir-dev-d9.innoraft-sites.com/jsonapi/node/services';
  $jsonData = new JsonData();
  $data = $jsonData->fetchData($url);
  $jsonData->fetchContentData($data);
?>
<!DOCTYPE html>
<html>

<!-- Head Starts. -->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PHP Adv1</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Including Stylesheet. -->
  <link rel="stylesheet" href="css/style.css">

  <!-- Including jquery. -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<!-- Body starts here. -->
<body>
  <div class="main">
    <div class="main-container container">
      <?php

        // Outputs the data fetched from url.
        foreach ($jsonData->dataArray as $jdata) {
          ?>
          <div class='content-tile flex-just-bet'>
            <a href=<?php echo "{$jdata['explore_url']}";?>>
              <img class='arrayImg' title="<?php echo $jdata['title'];?>"
              src=<?php echo $jdata['img_src'];?>>
            </a>
            <div class='content-tile--text flex-col'>
              <a href=<?php echo "{$jdata['explore_url']}";?>>
                <h2><?php echo "{$jdata['title']}";?></h2>
              </a>
              <span><?php echo "{$jdata['field_services_processed']}";?></span>
              <a href=<?php echo "{$jdata['explore_url']}";?>>
                <button class='content-tile--button'>
                  <strong>EXPLORE MORE</strong>
                </button>
              </a>
            </div>
          </div>
          <?php
        }
      ?>
    </div>
  </div>
</body>

</html>
