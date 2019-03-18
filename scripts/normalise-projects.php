<?php

  require_once("../config/sources.php");
  require_once("../config/baseuri.php");
  require_once("../config/folders.php");

//  $src[1] = "../src/citsci.csv";
//  $src[1] = "../src/1-projects-citsci.csv";

  $target_folder = $norm_folder;

  $baseuri = $baseuri . "project/";

  foreach ($src["projects"] as $i => $file) {
    $src["projects"][$i] = $src_folder . $file;
  }

  foreach ($src["projects"] as $i => $file) {

  $catalog_id = $i + 10000;
  $n = $i * 10000;
 
  $countries = json_decode(file_get_contents("../base/countries.json"),true);

//var_dump($countries);
//exit;

// Transforming the souce CSV file into JSON
  
  if (($handle = fopen($file, "r")) === false) {
    die("can't open the file.");
  }

  $csv_headers = fgetcsv($handle);
  $csv_json = array();

  while ($row = fgetcsv($handle)) {
    $csv_json[] = array_combine($csv_headers, $row);
  }

  fclose($handle);

  $json = json_encode($csv_json, JSON_PRETTY_PRINT);  

  $input = json_decode($json, true);

//  var_dump($input);
//  exit; 

  foreach ($input as $k => $v) {
    foreach ($v as $fn => $fv) {
      $input[$k][$fn] = trim($fv);
    }
  }

//  var_dump($input);
//  exit; 

  $rn = 1;
  
  foreach ($input as $k => $v) {
//    var_dump($v);
    
    $output[$k]["cid"] = $catalog_id;
    if (isset($v["id"]) && trim($v["id"]) != '' && is_int($v["id"] + 0)) {
      $output[$k]["id"] = $v["id"] + $n;
    }
    else {
      echo "WARNING - Record " . $rn . ": Missing ID or using an ID which is not an integer. ID now assigned by the system.\n";
      $output[$k]["id"] = $rn + $n;
    }
    if (isset($v["name"]) && trim($v["name"])) {
      $output[$k]["name"] = trim($v["name"]);
    }
    else {
      echo "ERROR - Record " . $rn . ": Mandatory field missing: 'name'\n";
      exit;
    }
    $output[$k]["url"] = $v["url"];
    if (filter_var(trim($v["contact"]), FILTER_VALIDATE_EMAIL)) {
      $output[$k]["contact"] = "mailto:" . trim($v["contact"]);
    }
    else {
      if (filter_var(trim($v["contact"]), FILTER_VALIDATE_URL)) {
        $output[$k]["contact"] = trim($v["contact"]);
      }
      else {
        $output[$k]["contact"] = "";
      }
    }
    $output[$k]["description"] = trim($v["description"]);
    $output[$k]["geoextent"] = trim($v["geoextent"]);
//    $output[$k]["geocoverage"] = $v["geocoverage_dirty"];
    $output[$k]["geocoverage"] = array_map('trim', explode(',', $v["geocoverage"]));

    $output[$k]["geocoverage_codes"] = array();
    foreach ($output[$k]["geocoverage"] as $gk => $gn) {
      foreach ($countries as $country) {
        if (strtolower($gn) == strtolower($country["name"])) {
          $output[$k]["geocoverage_codes"][] = $country["code"];
        }
      }
    }

    $output[$k]["lead_organisation"]["name"] = trim($v["lead_organisation_name"]);
    $output[$k]["lead_organisation"]["category"] = trim($v["lead_organisation_category"]);
    $output[$k]["lead_organisation_name"] = trim($v["lead_organisation_name"]);
    $output[$k]["lead_organisation_category"] = trim($v["lead_organisation_category"]);
    $output[$k]["start_date"] = trim($v["start_date"]);
    $output[$k]["active"] = trim($v["active"]);
    $output[$k]["end_date"] = trim($v["end_date"]);
    $output[$k]["environmental_domain"] = ucfirst(mb_strtolower(trim($v["environmental_domain"])));
    $output[$k]["environmental_field"] = ucfirst(mb_strtolower(trim($v["environmental_field"])));
    $output[$k]["category"] = ucfirst(mb_strtolower(trim($v["category"])));
    $output[$k]["social_uptake"] = ucfirst(mb_strtolower(trim($v["social_uptake"])));
    $output[$k]["policy_uptake"] = ucfirst(mb_strtolower(trim($v["policy_uptake"])));
    $output[$k]["policy_uptake_explanation"] = trim($v["policy_uptake_explanation"]);
    $output[$k]["policy_relevance"] = ucfirst(mb_strtolower(trim($v["policy_relevance"])));
    $output[$k]["unsdg"][1]  = $v["sdg1"];
    $output[$k]["unsdg"][2]  = $v["sdg2"];
    $output[$k]["unsdg"][3]  = $v["sdg3"];
    $output[$k]["unsdg"][4]  = $v["sdg4"];
    $output[$k]["unsdg"][5]  = $v["sdg5"];
    $output[$k]["unsdg"][6]  = $v["sdg6"];
    $output[$k]["unsdg"][7]  = $v["sdg7"];
    $output[$k]["unsdg"][8]  = $v["sdg8"];
    $output[$k]["unsdg"][9]  = $v["sdg9"];
    $output[$k]["unsdg"][10] = $v["sdg10"];
    $output[$k]["unsdg"][11] = $v["sdg11"];
    $output[$k]["unsdg"][12] = $v["sdg12"];
    $output[$k]["unsdg"][13] = $v["sdg13"];
    $output[$k]["unsdg"][14] = $v["sdg14"];
    $output[$k]["unsdg"][15] = $v["sdg15"];
    $output[$k]["unsdg"][16] = $v["sdg16"];
    $output[$k]["unsdg"][17] = $v["sdg17"];
    
    $rn++;

  }
  
  echo "Creating file: " . $target_folder . basename($file, ".csv") . ".json\n";
  if (file_put_contents($target_folder . basename($file, ".csv") . ".json", json_encode($output, JSON_PRETTY_PRINT))) {
    echo "Done." . "\n\n";
  }

//echo json_encode($output, JSON_PRETTY_PRINT);
  
  }
  exit; 

?>
