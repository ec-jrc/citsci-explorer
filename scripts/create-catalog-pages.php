<?php

  require_once("../config/baseuri.php");
  require_once("../config/folders.php");
  
  $sec = "catalog";

  require_once("../config/settings.php");

  $target_folder = $section[$sec]["path"];

  $baseuri = $baseuri . "catalog/";

  $data[1] = $data_folder . 'catalogs.json';

  $prj_db =  $data_folder . 'projects.json';

  foreach ($data as $i => $file) {

//  $n = $i * 10000;

  $json = file_get_contents($file);

  $d = json_decode($json, true);

//  var_dump($d);
//  exit; 

//  foreach ($d["data"] as $k => $v) {
  foreach ($d as $k => $v) {
//    var_dump($v);

//    $id = $v["id"] + $n;
    $id = $v["c_id"];
    $name = $v["c_name"];
    $url = $v["c_url"];
    $contact = $v["c_contact"];
    $description = $v["c_description"];
    $publisher = $v["c_publisher"];
    $type = $v["c_type"];
//    $geoextent = $v["geoextent"];
//    $geocoverage = $v["geocoverage_dirty"];
//    $geocoverage = $v["geocoverage"];
//    $lead_organisation["name"] = $v["lead_organisation"]["name"];
//    $lead_organisation["category"] = $v["lead_organisation"]["category"];
//    $start_date = $v["start_date"];
//    $active = $v["active"];
//    $end_date = $v["end_date"];
//    $environmental_domain = $v["environmental_domain"];
//    $environmental_field = $v["environmental_field"];
//    $category = $v["category"];
//    $social_uptake = $v["social_uptake"];
//    $policy_aims = $v["policy_aims"];
//    $policy_uptake_explanation = $v["policy_aims_explanation"];
//    $policy_relevance = $v["policy_relevance"];
/*
    $unsdg[1]  = $v["unsdg"][1];
    $unsdg[2]  = $v["unsdg"][2];
    $unsdg[3]  = $v["unsdg"][3];
    $unsdg[4]  = $v["unsdg"][4];
    $unsdg[5]  = $v["unsdg"][5];
    $unsdg[6]  = $v["unsdg"][6];
    $unsdg[7]  = $v["unsdg"][7];
    $unsdg[8]  = $v["unsdg"][8];
    $unsdg[9]  = $v["unsdg"][9];
    $unsdg[10] = $v["unsdg"][10];
    $unsdg[11] = $v["unsdg"][11];
    $unsdg[12] = $v["unsdg"][12];
    $unsdg[13] = $v["unsdg"][13];
    $unsdg[14] = $v["unsdg"][14];
    $unsdg[15] = $v["unsdg"][15];
    $unsdg[16] = $v["unsdg"][16];
    $unsdg[17] = $v["unsdg"][17];
*/


  $json = file_get_contents($prj_db);

  $prj = json_decode($json, true);
  $related_projects = array();

  foreach ($prj as $pdata) {
    if ($pdata["cid"] === $id) {
      $related_projects[] = $pdata;
    }
  }

//var_dump($related_projects);
//exit;

  $json = null;
  $prj = null;
  
  $prj_nr = count($related_projects);
  
  $prj_geocoverage = array();
  foreach ($related_projects as $pdata) {
    foreach ($pdata as $pk => $pv) {
      if ($pk == "geocoverage") {
        foreach ($pv as $pgc) {
          $prj_geocoverage[] = $pgc;
        }
      }
    }
  }

  $prj_geocoverage = array_count_values($prj_geocoverage);
  arsort($prj_geocoverage);
  
  $html = '<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
<title>' . $site_title . ' | ' . $name . '</title>
<link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://eloquentstudio.github.io/filter.js/assets/css/bootstrap.min.css" media="screen" rel="stylesheet" type="text/css">
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css" media="screen"/>
<link href="https://eloquentstudio.github.io/filter.js/assets/css/jquery-ui-1.10.2.custom.min.css" media="screen" rel="stylesheet" type="text/css">
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" media="screen"/>
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/select/1.2.1/css/select.dataTables.min.css" media="screen"/>
<link type="text/css" rel="stylesheet" href="https://getbootstrap.com/docs/3.3/assets/css/docs.min.css"/>
<link href="' . $site_abs_path . 'css/common.css" media="screen" rel="stylesheet" type="text/css">
<script type="text/javascript" src="https://eloquentstudio.github.io/filter.js/assets/js/jquery-1.11.3.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://eloquentstudio.github.io/filter.js/assets/js/jquery-ui-1.10.2.custom.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://eloquentstudio.github.io/filter.js/filter.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="https://getbootstrap.com/docs/3.3/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://getbootstrap.com/docs/3.3/assets/js/docs.min.js"></script> 

<script type="text/javascript" src="' . $site_abs_path . 'js/common.js"></script> 
';
/*
<title>' . $name . '</title>
<link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/readable/bootstrap.min.css" media="screen"/>
<link type="text/css" rel="stylesheet" href="https://getbootstrap.com/docs/3.3/assets/css/docs.min.css"/>
<style rel="stylesheet" type="text/css">
.metadata dd {
  margin-left: 40px;
}
.metadata a, .metadata code, .metadata pre {
  overflow-wrap: break-word;
  word-wrap: break-word;
  word-break: break-all;
}
</style>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://getbootstrap.com/docs/3.3/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://getbootstrap.com/docs/3.3/assets/js/docs.min.js"></script>  
<script type="text/javascript">
$(document).ready(function() {
//$("header").addClass("navbar bg-primary container-fluid");
//$("header > h1").addClass("navbar-header container");
//$("header > p").addClass("lead container");
$("header").addClass("bs-docs-header");
$("header > h1").addClass("container");
$("header > p").addClass("container");
$("header").addClass("hide");
$("nav").addClass("navbar navbar-default container-fluid");
$("nav > p").addClass("navbar-header");
$("nav > p > a").addClass("navbar-brand");        
$("nav > ul").addClass("nav navbar-nav collapse navbar-collapse");
$("nav > ul li > ul").addClass("dropdown-menu");
$("nav > ul li > ul").attr("role", "menu");
$("nav > ul li > ul").parent().addClass("dropdown");
$("body > article").addClass("bs-docs-container container");
$("body > article section").addClass("bs-docs-section").css("padding","1em");
$("footer").addClass("page-footer container text-muted small text-center").css("padding","1em");
});
</script>
*/

  $html .= '<script>
$(document).ready(function() {
  var related_projects_table = $("#related_projects").DataTable( { 
    "scrollY": "500px", "scrollCollapse": true, "paging": false, "dom": "Bfrtip", 
    "order": [[ 1, "asc" ]],
    "buttons": [ "copy", "csv", "excel", "pdf" ] 
  } );
  related_projects_table.columns().every( function () {
    var that = this;
    $( "input.filter", this.footer() ).on( "keyup change", function () {
      if ( that.search() !== this.value ) {
        that.search( this.value ).draw();
      }
    } );
  } );    
});
</script>
';  

  $html .= '<script type="application/ld+json">
{
  "@context":"http://schema.org",
  "@type":"Dataset",
  "@id":"' . $baseuri . $id . '",
  "name":"' . $name . '",
  "url":"' . $url . '",
  "description":"' . $description . '"
';
/*
  $html .= '"spatialCoverage":[
';

  foreach ($geocoverage as $gk => $gc) {
    $html .= '    {"@type":"Place","name":"' . $gc . '"}';
    if ($gk < count($geocoverage)) {
      $html .= ",\n";
    }
    else {
      $html .= "\n";
    }
  }  
  
  $html .= "  ]";
*/
  $html .= '
}
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
  $html .= '<article class="container">
<aside class="sidebar col-md-3">
<div>
<div class="well">
';
  $html .= '<p><strong>Project number</strong></p>
<p>' . $prj_nr . '</p>
';
  $html .= '<p><strong>Project coverage</strong></p>
';
  foreach ($prj_geocoverage as $pgck => $pgcv) {
    $html .= '<p>' . $pgck . ' (' . $pgcv . ')</p>
';
  }  
/*
  $html .= '<p><strong>Category</strong></p>
<p>' . $category . '</p>
<p><strong>Geographic extent</strong></p>
<p>' . $geoextent . '</p>
<p><strong>Geographic coverage</strong></p>
<p>' . join(", ", $geocoverage) . '</p>
<p><strong>Primary environmental domain</strong></p>
<p>' . $environmental_domain . '</p>
<p><strong>Primary environmental field</strong></p>
<p>' . $environmental_field . '</p>
<p><strong>Social uptake</strong></p>
<p>' . $social_uptake . '</p>
<p><strong>Policy aims</strong></p>
<p>' . $policy_uptake . '</p>
<p><strong>Policy relevance</strong></p>
<p>' . $policy_relevance . '</p>
';
*/
  $html .= '</div>
</div>
</aside>
<section class="col-md-9">
<h2>' . $name . '</h2>
<address class="small">Publisher: ' . $publisher . '</address>
<p>' . $description . '</p>
';
/*
if ($policy_uptake == 'Yes') {
  $html .= '<section>
<h3>Policy aims explanation</h3>
<p>' . $policy_uptake_explanation . '</p>
';
}
*/
  $html .= '<section>
<h3>Additional information</h3>
<table class="table table-hover table-striped">
<tbody>
<tr>
<th>Source type</th>
<td>' . $type . '</td>
</tr>
';
  if ($url != '') {
    $html .= '<tr>
<th>Web site</th>
<td><a href="' . $url . '">' . $url . '</a></td>
</tr>
';
  }
  if ($contact != '') {
    $html .= '<tr><th>Contact point</th>
<td><a href="' . $contact . '">' . $contact . '</a></td></tr>
';
  }
/*
  $html .= '<tr>
<th>Start/end date</th>
<td>' . $start_date . ' - ' . $end_date . '</td>
</tr>
<tr>
<th>Still active?</th>
<td>' . $active . '</td>
</tr>
';
*/
  $html .= '</tbody>
</table>
</section>
';
/*
  $html .= '<section>
<h3>Contribution to UN Sustainable Development Goals</h3>
';
  $html .= '<table id="table-unsdg">
<tbody>
<tr>
';
*/
/*
  for ($i = 5; $i > 0; $i--) {
    $html .= '<tr>';
    foreach ($unsdg as $c) {
      if ($c == $i || $c > $i) {
        $html .= '  <td class="filled" title="' . $c . '">&nbsp;</td>';
      }
      else {
        $html .= '  <td>&nbsp;</td>';
      }
    }
    $html .= '</tr>';
  }
*/
/*
    $html .= '<tr>';
    foreach ($unsdg as $c) {
      $contrib = '';
      if ($c == "1") {
        $contrib = "Direct";
      }
      if ($c == "2") {
        $contrib = "Indirect";
      }
      if ($c != '') {
        $html .= '  <td class="unsdg-' . strtolower($contrib) . '" title="' . $contrib . '">' . substr($contrib,0,1) . '</td>';
      }
      else {
        $html .= '  <td>&nbsp;</td>';
      }
    }
    $html .= '</tr>';

  $html .= '</tbody>
<tfoot>
<tr>
<th title="">SDG1</th>
<th title="">SDG2</th>
<th title="">SDG3</th>
<th title="">SDG4</th>
<th title="">SDG5</th>
<th title="">SDG6</th>
<th title="">SDG7</th>
<th title="">SDG8</th>
<th title="">SDG9</th>
<th title="">SDG10</th>
<th title="">SDG11</th>
<th title="">SDG12</th>
<th title="">SDG13</th>
<th title="">SDG14</th>
<th title="">SDG15</th>
<th title="">SDG16</th>
<th title="">SDG17</th>
</tr>
</tfoot>
</table>
';
  $html .= '</section>
*/
  $html .= '<section>
<h3>Related projects</h3>
';
//var_dump($related_projects);

  if (count($related_projects) > 0) {
    $html .= '<table id="related_projects" class="table table-hover table-striped">
<thead>
<tr>
<th>Project</th>
<th>Category</th>
<th>Geo extent</th>
</tr>
</thead>
<tbody>
';
    foreach ($related_projects as $rp) {
//      $score = count($rp) - 1;
//      $score = 100*((count($rp) - 1)/10) . "%";
      $html .= '<tr>
<td><a href="../project/' . $rp["id"] . '.html">' . $rp["name"] . '</a></td>
<td>' . $rp["category"] . '</td>      
<td>' . $rp["geoextent"] . '</td>      
</tr>
';
    }
  $html .= '</tbody>
<tfoot>
<tr>
<th><input class="filter" type="text" placeholder="Filter by project" data-index="0" /></th>
<th><input class="filter" type="text" placeholder="Filter by category" data-index="1" /></th>
<th><input class="filter" type="text" placeholder="Filter by geo extent" data-index="2" /></th>
</tr>
</tfoot>
</table>
';  
  }
  
  $html .= '</section>
</section>
</article>
<footer>
' . $footer . '
</footer>
</body>
</html>
';

    echo "Creating file: " . $target_folder . $id . ".html\n";
    if (file_put_contents($target_folder . $id . ".html", $html)) {
      echo "Done." . "\n\n";
    }

  }
  
  }
//  exit; 

?>
