<?php

  $sec = "chart";

  require_once("../config/settings.php");

  $baseuri = $baseuri . $sec . "/";

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo $site_title; ?> | <?php echo $section[$sec]["name"]; ?></title>
<link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="http://jiren.github.io/filter.js/assets/css/bootstrap.min.css" media="screen" rel="stylesheet" type="text/css">
<link href="http://jiren.github.io/filter.js/assets/css/jquery-ui-1.10.2.custom.min.css" media="screen" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.3/jquery-jvectormap.min.css" crossorigin="anonymous" />
<link href="<?php echo $site_abs_path; ?>css/common.css" media="screen" rel="stylesheet" type="text/css">

<script src="https://unpkg.com/@jpmorganchase/perspective/build/perspective.js"></script>
<script src="https://unpkg.com/@jpmorganchase/perspective-viewer/build/perspective.view.js"></script>
<script src="https://unpkg.com/@jpmorganchase/perspective-viewer-hypergrid/build/hypergrid.plugin.js"></script>
<script src="https://unpkg.com/@jpmorganchase/perspective-viewer-highcharts/build/highcharts.plugin.js"></script>
        
<script src="<?php echo $section["project"]["data"]; ?>.js"></script>
<script src="http://jiren.github.io/filter.js/assets/js/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="http://jiren.github.io/filter.js/assets/js/jquery-ui-1.10.2.custom.min.js" type="text/javascript"></script>
<!--
<script src="http://jvectormap.com/js/jquery-jvectormap-2.0.3.min.js"></script>
<script src="http://jvectormap.com/js/jquery-jvectormap-world-mill.js"></script>
-->
<script src="<?php echo $site_abs_path; ?>js/jvectormap.com/js/jquery-jvectormap-2.0.3.min.js"></script>
<script src="<?php echo $site_abs_path; ?>js/jvectormap.com/js/jquery-jvectormap-world-mill.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.9.1/underscore-min.js" integrity="sha256-G7A4JrJjJlFqP0yamznwPjAApIKPkadeHfyIwiaa9e0=" crossorigin="anonymous"></script>

<script type="text/javascript" src="<?php echo $site_abs_path; ?>js/common.js"></script> 
<style>
<?php   

  $chart_id = array();
  foreach ($subsection[$sec] as $ssk => $ssv) {
    $chart_id[] = "#chart-" . $ssk;
    $chart_lib[$ssv["lib"]][] = "#chart-" . $ssk;
  }
  
?>
<?php echo join(",", $chart_id); ?> {width: 100%;height: 340px;}
.thumbnail .caption p {height:50px;}
</style>
<script>
$(document).ready(function () {
<?php if (isset($chart_lib["jvectormap"])) { ?>
  var countries = _.map(projects, function (p) {
    return p.geocoverage_codes;
  });
  countries = _.flatten(countries);
  countries = _.groupBy(countries);
  var data = {};
  _.each(countries, function (v, k) {
    data[k] = _.size(v);
  }, data);

  $('<?php echo join(",",$chart_lib["jvectormap"])?>').vectorMap({
    map: 'world_mill',
    series: {
      regions: [{
        values: data,
        scale: ['#C8EEFF', '#0071A4'],
        normalizeFunction: 'polynomial'
      }]
    },
    onRegionTipShow: function (e, el, code) {
      el.html(el.html() + ' - Projects: ' + (data[code] ? data[code] : 'unknown') );
    },
    onRegionClick: function(e, code){
      window.location.href = window.location.href + 'project';
    }
  });
<?php } ?>
<?php if (isset($chart_lib["perspective"])) { ?>
  document.addEventListener("WebComponentsReady", function () {
    for (var el of document.getElementsByTagName('perspective-viewer')) {
      el.load(projects);
    }
  });
<?php } ?>
});
</script>
</head>
<body>
<?php echo $nav; ?>    
<!--
<header class="page-header">
<div class="container">
<h1 class="title"><?php echo $site_title; ?></h1>
<p class="lead"><?php echo $site_subtitle; ?></p>
</div>
</header>
-->
<article class="container">
<div class="row thumbnails-container">
<?php

  foreach ($subsection[$sec] as $sk => $sv) {

//    echo '<div class="col-sm-6 col-md-3">' . "\n";  
//    echo '<a class="col-sm-6 col-md-3 block-link" href="' . $sv["url"] . '">' . "\n";
//    echo '<a class="col-sm-6 col-md-6 block-link" href="' . $sv["url"] . '">' . "\n";
    echo '<div class="col-sm-6 col-md-6 block-link" href="' . $sv["url"] . '">' . "\n";
    echo '<div class="thumbnail">' . "\n";
    if (isset($sv["graph"])) {
      echo $sv["graph"] . "\n";
    }
    else {
      echo '<div class="img"><span class="fa ' . $sv["icon"] . '"></span></div>' . "\n";
    }
    echo '<div class="caption">' . "\n";
    echo '<h3>' . $sv["name"] . '</h3>' . "\n";
    echo '<p>' . $sv["descr"] . '</p>' . "\n";
    echo '<a class="btn btn-primary block-link center-block" href="' . $sv["url"] . '">Open this graph</a>' . "\n";
    echo '</div>' . "\n";
    echo '</div>' . "\n";
    echo '</div>' . "\n";
//    echo '</a>' . "\n";
//    echo '</div>' . "\n";
  }

?>
</div>
</article>        
<footer>
<?php echo $footer; ?>
</footer>
</body>
</html>
