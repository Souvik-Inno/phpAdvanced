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
            <?php echo "<a href={$jdata['explore_url']}>"; ?>
              <img class='arrayImg' title="<?php echo $jdata['title'];?>"
              src=<?php echo $jdata['img_src'];?>>
            <?php echo "</a>"; ?>
            <div class='content-tile--text flex-col'>
              <?php echo "<a href={$jdata['explore_url']}>"; ?>
                <?php echo "<h2>{$jdata['title']}</h2>"; ?>
              <?php echo "</a>"; ?>
              <?php echo "<span>{$jdata['field_services_processed']}</span>"; ?>
              <button class='content-tile--button'>
                <?php echo "<a href={$jdata['explore_url']}>"; ?>
                  <strong>EXPLORE MORE</strong>
                <?php echo "</a>"; ?>
              </button>
            </div>
          </div>
          <?php
        }
      ?>
    </div>
  </div>

  <script>
    // Add Base url to all the href generated.
    $('a[href]').each(function () {
      var url = $(this).attr('href');
      url = 'https://ir-dev-d9.innoraft-sites.com' + url;
      $(this).attr('href', url);
    });
  </script>
</body>

</html>
