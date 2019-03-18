<?php

  require_once("../config/baseuri.php");
  require_once("../config/folders.php");

//  $root_abs_path = dirname(dirname(__FILE__)) . "/";

//  $site_abs_path = "/test/citsci/";

//  $baseuri = "http://purl.otg/citsci-x/";

//  $data_folder = "data/";

  $site_title = "CitSci-X";
  $site_subtitle = "Exploring Citizen Science projects";
  $site_description = "These pages allow you to explore Citizen Science projects that have been collected from different partners in an integrated and harmonized way. Projects can be discovered using a text-based, as well as, a graphic-based approach. We also list the contributing partners and offer the possibility to add your own project descriptions.";

  $twitter = "";
  $github = "https://github.com/ec-jrc/citsci-explorer/";

  $footer = '<p></p>';

// Web site sections. Used to generated the navbar and the titles used in the different pages.

//  $section["about"]["name"] = "About";
//  $section["about"]["url"] = $site_abs_path;
   
  $section["project"]["name"] = "Projects";
  $section["project"]["icon"] = "fa-group";
  $section["project"]["descr"] = "Explore the citizen science projects collected by our partners and us. Find past and current projects addressing different domains, participatory approaches, etc. Discover their relationships to the Sustainable Development Goals, and much more.";
  $section["project"]["url"] = $site_abs_path . "project/";
  $section["project"]["path"] = $root_abs_path . "project/";
//  $section["project"]["data"] = $site_abs_path . $data_folder . "projects";
  $section["project"]["data"] = $data_path . "projects";
/*   
  $section["i-chart"]["name"] = "Interactive Charts";
  $section["i-chart"]["url"] = $site_abs_path . "datavis/";
  $section["i-chart"]["path"] = $root_abs_path . "datavis/";
*/   
  $section["chart"]["name"] = "Gallery";
  $section["chart"]["icon"] = "fa-area-chart";
  $section["chart"]["descr"] = "Enjoy graphic representations of citizen science projects based on their core characteristics, including geographic and thematic coverage, policy uptake and policy relevance. Browse the already prepared views, and create dynamic visualizations.";
  $section["chart"]["url"] = $site_abs_path . "chart/";
  $section["chart"]["path"] = $root_abs_path . "chart/";

  $section["catalog"]["name"] = "Sources";
  $section["catalog"]["icon"] = "fa-download";
  $section["catalog"]["descr"] = "Get to know the surveys, catalogs and data sets of Citizen Science projects that are integrated here. Find out how you could add your own project, or results from a longitudinal study.";
  $section["catalog"]["url"] = $site_abs_path . "catalog/";
  $section["catalog"]["path"] = $root_abs_path . "catalog/";
//  $section["catalog"]["data"] = $site_abs_path . $data_folder . "catalogs";
  $section["catalog"]["data"] = $data_path . "catalogs";
   
  $subsection["chart"]["10001"]["name"] = "Geographic coverage";
  $subsection["chart"]["10001"]["icon"] = "fa-globe";
  $subsection["chart"]["10001"]["descr"] = "Countries covered by the different projects. Hovering the mouse on one country, a tooltip shows the number of projects covering it.";
//  $subsection["chart"]["10001"]["url"] = $site_abs_path . "chart/10001.html";
//  $subsection["chart"]["10001"]["path"] = $root_abs_path . "chart/10001.html";
//  $subsection["chart"]["10001"]["data"] = $site_abs_path . $data_folder . "projects";
  $subsection["chart"]["10001"]["data"] = $data_path . "projects";
  $subsection["chart"]["10001"]["graph"] = '<div id="chart-10001"></div>';
  $subsection["chart"]["10001"]["lib"] = 'jvectormap';

  $subsection["chart"]["10002"]["name"] = "Enviromental field";
  $subsection["chart"]["10002"]["icon"] = "fa-area-chart";
//  $subsection["chart"]["10002"]["descr"] = "The dominant environmental field tackled by the project activities. Hovering the mouse on an environmental field name, a tooltip shows the number of projects tackling it.";
  $subsection["chart"]["10002"]["descr"] = "The dominant environmental fields tackled by the project activities.";
//  $subsection["chart"]["10002"]["url"] = $site_abs_path . "chart/10002.html";
//  $subsection["chart"]["10002"]["path"] = $root_abs_path . "chart/10002.html";
//  $subsection["chart"]["10002"]["data"] = $site_abs_path . $data_folder . "projects";
  $subsection["chart"]["10002"]["data"] = $data_path . "projects";
  $subsection["chart"]["10002"]["graph"] = '<perspective-viewer view="treemap" row-pivots=\'["environmental_field"]\' sort=\'[["id", "asc"]]\' columns=\'["id", "geocoverage"]\' aggregates=\'{"id": "distinct count"}\' id="chart-10002"></perspective-viewer>';
  $subsection["chart"]["10002"]["lib"] = 'perspective';
  
  $subsection["chart"]["10003"]["name"] = "Lead organization category";
  $subsection["chart"]["10003"]["icon"] = "fa-area-chart";
//  $subsection["chart"]["10003"]["descr"] = "Type of organisation represented by the lead project partners. Hovering the mouse on an organization category, a tooltip shows the number of projects with lead partners that belong in this category.";
  $subsection["chart"]["10003"]["descr"] = "Distrubtion of type of organisation represented by the lead project partners.";
//  $subsection["chart"]["10003"]["url"] = $site_abs_path . "chart/10003.html";
//  $subsection["chart"]["10003"]["path"] = $root_abs_path . "chart/10003.html";
//  $subsection["chart"]["10003"]["data"] = $site_abs_path . $data_folder . "projects";
  $subsection["chart"]["10003"]["data"] = $data_path . "projects";
  $subsection["chart"]["10003"]["graph"] = '<perspective-viewer view="treemap" row-pivots=\'["lead_organisation_category"]\' columns=\'["id", "name"]\' id="chart-10003"></perspective-viewer>';
  $subsection["chart"]["10003"]["lib"] = 'perspective';
  
  $subsection["chart"]["10004"]["name"] = "Environmental domain vs. environmental field";
  $subsection["chart"]["10004"]["icon"] = "fa-area-chart";
  $subsection["chart"]["10004"]["descr"] = "Joint visual representation of the primary project environmental domain and the primary project environmental field.";
//  $subsection["chart"]["10004"]["url"] = $site_abs_path . "chart/10004.html";
//  $subsection["chart"]["10004"]["path"] = $root_abs_path . "chart/10004.html";
//  $subsection["chart"]["10004"]["data"] = $site_abs_path . $data_folder . "projects";
  $subsection["chart"]["10004"]["data"] = $data_path . "projects";
  $subsection["chart"]["10004"]["graph"] = '<perspective-viewer view="sunburst" row-pivots=\'["environmental_domain", "environmental_field"]\' sort=\'[["id", "asc"]]\' columns=\'["id", "geocoverage"]\' id="chart-10004"></perspective-viewer>';
  $subsection["chart"]["10004"]["lib"] = 'perspective';
  
  $subsection["chart"]["10005"]["name"] = "Policy uptake vs. project category";
  $subsection["chart"]["10005"]["icon"] = "fa-area-chart";
  $subsection["chart"]["10005"]["descr"] = "Joint visual representation of the project policy uptake and the project category.";
//  $subsection["chart"]["10005"]["url"] = $site_abs_path . "chart/10005.html";
//  $subsection["chart"]["10005"]["path"] = $root_abs_path . "chart/10005.html";
//  $subsection["chart"]["10005"]["data"] = $site_abs_path . $data_folder . "projects";
  $subsection["chart"]["10005"]["data"] = $data_path . "projects";
  $subsection["chart"]["10005"]["graph"] = '<perspective-viewer view="sunburst" row-pivots=\'["policy_uptake", "category"]\' sort=\'[["id", "asc"]]\' columns=\'["id", "geocoverage"]\' id="chart-10005"></perspective-viewer>';
  $subsection["chart"]["10005"]["lib"] = 'perspective';
  
  $subsection["chart"]["10006"]["name"] = "Policy relevance vs. project category";
  $subsection["chart"]["10006"]["icon"] = "fa-area-chart";
  $subsection["chart"]["10006"]["descr"] = "Joint visual representation of the project policy relevance and the project category.";
//  $subsection["chart"]["10006"]["url"] = $site_abs_path . "chart/10006.html";
//  $subsection["chart"]["10006"]["path"] = $root_abs_path . "chart/10006.html";
//  $subsection["chart"]["10006"]["data"] = $site_abs_path . $data_folder . "projects";
  $subsection["chart"]["10006"]["data"] = $data_path . "projects";
  $subsection["chart"]["10006"]["graph"] = '<perspective-viewer view="x_bar" row-pivots=\'["policy_relevance", "category"]\' sort=\'[["id", "asc"]]\' columns=\'["id"]\' id="chart-10006"></perspective-viewer>';
  $subsection["chart"]["10006"]["lib"] = 'perspective';
  
  $subsection["chart"]["10007"]["name"] = "Social uptake vs. lead organisation category";
  $subsection["chart"]["10007"]["icon"] = "fa-area-chart";
  $subsection["chart"]["10007"]["descr"] = "Joint visual representation of the project social uptake and the project lead partner category.";
//  $subsection["chart"]["10007"]["url"] = $site_abs_path . "chart/10007.html";
//  $subsection["chart"]["10007"]["path"] = $root_abs_path . "chart/10007.html";
//  $subsection["chart"]["10007"]["data"] = $site_abs_path . $data_folder . "projects";
  $subsection["chart"]["10007"]["data"] = $data_path . "projects";
  $subsection["chart"]["10007"]["graph"] = '<perspective-viewer view="x_bar" row-pivots=\'["social_uptake", "lead_organisation_category"]\' sort=\'[["id", "asc"]]\' columns=\'["id"]\' id="chart-10007"></perspective-viewer>';
  $subsection["chart"]["10007"]["lib"] = 'perspective';
  
  $subsection["chart"]["10008"]["name"] = "Policy uptake vs. social uptake";
  $subsection["chart"]["10008"]["icon"] = "fa-area-chart";
  $subsection["chart"]["10008"]["descr"] = "Joint visual representation of the project policy uptake and the project social uptake.";
//  $subsection["chart"]["10008"]["url"] = $site_abs_path . "chart/10008.html";
//  $subsection["chart"]["10008"]["path"] = $root_abs_path . "chart/10008.html";
//  $subsection["chart"]["10008"]["data"] = $site_abs_path . $data_folder . "projects";
  $subsection["chart"]["10008"]["data"] = $data_path . "projects";
  $subsection["chart"]["10008"]["graph"] = '<perspective-viewer view="sunburst" row-pivots=\'["policy_uptake", "social_uptake"]\' sort=\'[["id", "asc"]]\' columns=\'["id", "start_date"]\' id="chart-10008"></perspective-viewer>';
  $subsection["chart"]["10008"]["lib"] = 'perspective';

  foreach ($subsection["chart"] as $ssk => $ssv) {
    $subsection["chart"][$ssk]["url"] = $site_abs_path . "chart/" . $ssk . ".html";
    $subsection["chart"][$ssk]["path"] = $root_abs_path . "chart/" . $ssk . ".html";
  }  
  
  
  $nav = null;
  $nav .= '<nav role="navigation" class="navbar navbar-default">' . "\n";
  $nav .= '<div class="container">' . "\n";
//  $nav .= '<p class="navbar-header"><a class="navbar-brand" href="' . $site_abs_path . '">About</a></p>' . "\n";
  $nav .= '<p class="navbar-header"><a class="navbar-brand" href="' . $site_abs_path . '">' . $site_title . '</a></p>' . "\n";
  $nav .= '<ul class="nav navbar-nav collapse navbar-collapse">' . "\n";
  foreach ($section as $sk => $sv) {
    $liclasses = array();
    $aattr = "";
    $decoration = "";
    $subitems = "";
    
    if ($sk == $sec) {
      $liclasses[] = "active";
    }
    if (isset($subsection[$sk])) {
//      $liclasses[] = "dropdown";
//      $aattr = ' class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"';
//      $decoration = ' <span class="caret"></span>';
      $subitems .= "\n" . '<ul role="menu" class="dropdown-menu">' . "\n";
      foreach ($subsection[$sk] as $ssk => $ssv) {
        $subitems .= '<li><a href="' . $ssv["url"] . '">' . $ssv["name"] . '</a></li>' . "\n";
      }
      $subitems .= "</ul>\n";
    }
    $liclasses = ' class="' . join(" ", $liclasses) . '"';
    $nav .= '<li' . $liclasses . '><a href="' . $sv["url"] . '"' . $aattr . '>' . $sv["name"] . $decoration . '</a>';
//    $nav .= $subitems;
    $nav .= '</li>' . "\n";
  }
  $nav .= '</ul>' . "\n";
  $nav .= '<ul class="nav navbar-nav collapse navbar-collapse navbar-right">' . "\n";
  if ($twitter != "") {
    $nav .= '<li><a target="_blank" href="' . $twitter . '" title="Twitter"><i class="fa fa-twitter"></i></a></li>' . "\n";
  }
  if ($github != "") {
    $nav .= '<li><a target="_blank" href="' . $github . '" title="GitHub"><i class="fa fa-github"></i> About ' . $site_title . '</a></li>' . "\n";
  }
  $nav .= '</ul>' . "\n";
  $nav .= '</div>' . "\n";
  $nav .= '</nav>' . "\n";


?>
