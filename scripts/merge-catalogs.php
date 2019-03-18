<?php

  require_once("../config/baseuri.php");
  require_once("../config/folders.php");
  require_once("../config/sources.php");

//  $src[1] = "../src/citsci.json";
//  $src[1] = "../src/1-catalog-citsci.json";

  $target_folder = $data_folder;
  $filename = "catalogs";

  $baseuri = $baseuri . "catalog/";
  
  $input = array();

  foreach ($src["catalog"] as $i => $file) {
//    $input = $input + json_decode(file_get_contents($norm_folder . basename($file, ".csv") . ".json"), true);
    foreach (json_decode(file_get_contents($norm_folder . basename($file, ".csv") . ".json"), true) as $entry) {
      $input[$entry["c_id"]] = $entry;
    }
  }

  sort($input);
  
  echo "Creating file: " . $target_folder . $filename . ".json\n";
  if (file_put_contents($target_folder . $filename . ".json", json_encode($input, JSON_PRETTY_PRINT))) {
    echo "Done." . "\n\n";
  }
  echo "Creating file: " . $target_folder . $filename . ".js\n";
  if (file_put_contents($target_folder . $filename . ".js", "var " . $filename . " = " . json_encode($input, JSON_PRETTY_PRINT))) {
    echo "Done." . "\n\n";
  }
/*
  $input = array();

  $field[] = "geoextent";
  $field[] = "geocoverage";
  $field[] = "category";
  $field[] = "environmental_domain";
  $field[] = "environmental_field";
  $field[] = "social_uptake";
  $field[] = "policy_uptake";
  $field[] = "policy_relevance";

  $file = $target_folder . $filename . ".json";
  $records = json_decode(file_get_contents($file), true);
  
  foreach ($field as $fn) {

    $input = array();
 
//    foreach ($src as $i => $file) {
//      $records = json_decode(file_get_contents($file), true);
      foreach ($records as $rk => $rv) {
        if (is_array($rv[$fn])) {
          foreach ($rv[$fn] as $fv) {
           $input[] = $fv;
          }
//          $input = $input + $rv[$fn];
//var_dump($v[$fn]);
        }
        else {
          $input[] = $rv[$fn];
        }
      }
//    }


    if ($fn == "geocoverage") {
      $prj_per_country = array_count_values($input);
//var_dump($prj_per_country);
//exit;
      echo "Creating file: " . $target_folder . "projects-per-country.json\n";
      if (file_put_contents($target_folder . "projects-per-country.json", json_encode($prj_per_country, JSON_PRETTY_PRINT))) {
        echo "Done." . "\n\n";
      }
      echo "Creating file: " . $target_folder . "projects-per-country.js\n";
        if (file_put_contents($target_folder . "projects-per-country.js", "var prj_per_country = " . json_encode($prj_per_country, JSON_PRETTY_PRINT))) {
        echo "Done." . "\n\n";
      }
    }

    $input = array_values(array_unique($input));
    sort($input);

    echo "Creating file: " . $target_folder . $fn . ".json\n";
    if (file_put_contents($target_folder . $fn . ".json", json_encode($input, JSON_PRETTY_PRINT))) {
      echo "Done." . "\n\n";
    }
    echo "Creating file: " . $target_folder . $fn . ".js\n";
      if (file_put_contents($target_folder . $fn . ".js", "var " . $fn . " = " . json_encode($input, JSON_PRETTY_PRINT))) {
      echo "Done." . "\n\n";
    }

  }

//echo json_encode($output, JSON_PRETTY_PRINT);
  
  exit; 
*/
?>
