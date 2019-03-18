<?php

  $sec = "chart";

  require_once("../config/settings.php");
  
  $target_folder = $section[$sec]["path"];

  $baseuri = $baseuri . $sec . "/";

  foreach ($subsection[$sec] as $sk => $sv) {
  
    $html = null;
    $html .= '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>' . $site_title . ' | ' . $section[$sec]["name"] . '</title>
<link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="http://jiren.github.io/filter.js/assets/css/bootstrap.min.css" media="screen" rel="stylesheet" type="text/css">
<link href="http://jiren.github.io/filter.js/assets/css/jquery-ui-1.10.2.custom.min.css" media="screen" rel="stylesheet" type="text/css">
';

    if ($sv["lib"] == "jvectormap") {
      $html .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.3/jquery-jvectormap.min.css" crossorigin="anonymous" />
';
    }
      
    $html .= '<link href="' . $site_abs_path . 'css/common.css" media="screen" rel="stylesheet" type="text/css">
';

    if ($sv["lib"] == "perspective") {
      $html .= '<script src="https://unpkg.com/@jpmorganchase/perspective/build/perspective.js"></script>
<script src="https://unpkg.com/@jpmorganchase/perspective-viewer/build/perspective.view.js"></script>
<script src="https://unpkg.com/@jpmorganchase/perspective-viewer-hypergrid/build/hypergrid.plugin.js"></script>
<script src="https://unpkg.com/@jpmorganchase/perspective-viewer-highcharts/build/highcharts.plugin.js"></script>
';
    }
          
    $html .= '<script src="' . $section["project"]["data"] . '.js"></script>
<script src="http://jiren.github.io/filter.js/assets/js/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="http://jiren.github.io/filter.js/assets/js/jquery-ui-1.10.2.custom.min.js" type="text/javascript"></script>
';

    if ($sv["lib"] == "jvectormap") {
      $html .= '<script src="' . $site_abs_path . 'js/jvectormap.com/js/jquery-jvectormap-2.0.3.min.js"></script>
<script src="' . $site_abs_path . 'js/jvectormap.com/js/jquery-jvectormap-world-mill.js"></script>
';
    }

    $html .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.9.1/underscore-min.js" integrity="sha256-G7A4JrJjJlFqP0yamznwPjAApIKPkadeHfyIwiaa9e0=" crossorigin="anonymous"></script>

<script type="text/javascript" src="' . $site_abs_path . 'js/common.js"></script> 
';

  $html .= '<style>
#chart-' . $sk . ' {
  position: absolute;
  top: 60px;
  left: 0;
  right: 0;
  bottom: 0;
}
</style>
';

    $html .= '<script>
$(document).ready(function () {
';

    if ($sv["lib"] == "jvectormap") {
      $html .= 'var countries = _.map(projects, function (p) {
    return p.geocoverage_codes;
  });
  countries = _.flatten(countries);
  countries = _.groupBy(countries);
  var data = {};
  _.each(countries, function (v, k) {
    data[k] = _.size(v);
  }, data);

  $("#chart-' . $sk . '").vectorMap({
    map: "world_mill",
    series: {
      regions: [{
        values: data,
        scale: ["#C8EEFF", "#0071A4"],
        normalizeFunction: "polynomial"
      }]
    },
    onRegionTipShow: function (e, el, code) {
      el.html(el.html() + " - Projects: " + (data[code] ? data[code] : "unknown") );
    },
    onRegionClick: function(e, code){
      window.location.href = window.location.href + "project";
    }
  });
';
    }

    if ($sv["lib"] == "perspective") {
      $html .= '  document.addEventListener("WebComponentsReady", function () {
    var element = document.getElementById("chart-' . $sk . '");
    element.load(projects);
    element._toggle_config();
  });
';
    }
  
    $html .= '});
</script>
</head>
<body>
';

  $html .= $nav;
/*
  $html .= '<header class="page-header">
<div class="container">
<h1 class="title">' . $site_title . '</h1>
<p class="lead">' . $site_subtitle . '</p>
</div>
</header>
';
*/
    if ($sv["lib"] == "jvectormap") {
      $html .= '<div id="chart-' . $sk . '"></div>
';    
    }
  
//  $html .= '<article class="container">
//';  
    if ($sv["lib"] == "perspective") {
      $html .= $sv["graph"];
    }

//    $html .= '</article>        
//<footer>
//' . $footer . '
//</footer>
//';

  $html .= '</body>
</html>';

    echo "Creating file: " . $target_folder . $sk . ".html\n";
    if (file_put_contents($target_folder . $sk . ".html", $html)) {
      echo "Done." . "\n\n";
    }


  }
