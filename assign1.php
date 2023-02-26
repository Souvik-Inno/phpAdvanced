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
          <?php echo "<a href={$jdata[3]}>"; ?>
            <img class='arrayImg' title="<?php echo $jdata[0];?>"
            src=<?php echo $jdata[1];?>>
          <?php echo "</a>"; ?>
          <div class='content-tile--text flex-col'>
            <?php echo "<h2>{$jdata[0]}</h2>"; ?>
            <?php echo "<span>{$jdata[2]}</span>"; ?>
            <button class='content-tile--button'>
                <?php echo "<a href={$jdata[3]}>"; ?>
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
    $('a[href]').each(function () {
      var url = $(this).attr('href');
      url = 'https://ir-dev-d9.innoraft-sites.com' + url;
      $(this).attr('href', url);
    });
  </script>
</body>

</html>
