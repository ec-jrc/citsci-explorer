<?php

  require_once("../config/sources.php");
  require_once("../config/baseuri.php");
  require_once("../config/folders.php");

  $src[1] = "../src/citsci.csv";
  $src[1] = "../src/1-projects-citsci.csv";

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
    if (isset($v["UID"]) && trim($v["UID"]) != '' && is_int($v["UID"] + 0)) {
      $output[$k]["id"] = $v["UID"] + $n;
    }
    else {
      echo "WARNING - Record " . $rn . ": Missing ID or using an ID which is not an integer. ID now assigned by the system.\n";
      $output[$k]["id"] = $rn + $n;
    }
    if (isset($v["Name"]) && trim($v["Name"])) {
      $output[$k]["name"] = trim($v["Name"]);
    }
    else {
      echo "ERROR - Record " . $rn . ": Mandatory field missing: 'name'\n";
      exit;
    }
    $output[$k]["url"] = $v["Website"];
    if (filter_var(trim($v["Contact"]), FILTER_VALIDATE_EMAIL)) {
      $output[$k]["contact"] = "mailto:" . trim($v["Contact"]);
    }
    else {
      if (filter_var(trim($v["Contact"]), FILTER_VALIDATE_URL)) {
        $output[$k]["contact"] = trim($v["Contact"]);
      }
      else {
        $output[$k]["contact"] = "";
      }
    }
    $output[$k]["description"] = trim($v["Brief description"]);
    $output[$k]["geoextent"] = trim($v["Geographical extent"]);
//    $output[$k]["geocoverage"] = $v["geocoverage_dirty"];
    $output[$k]["geocoverage"] = array_map('trim', explode(',', $v["Geographic coverage"]));

    $output[$k]["geocoverage_codes"] = array();
    foreach ($output[$k]["geocoverage"] as $gk => $gn) {
      foreach ($countries as $country) {
        if (strtolower($gn) == strtolower($country["name"])) {
          $output[$k]["geocoverage_codes"][] = $country["code"];
        }
      }
    }

    $output[$k]["lead_organisation"]["name"] = trim($v["Lead organisation name"]);
    $output[$k]["lead_organisation"]["category"] = trim($v["Lead organisation category"]);
    $output[$k]["lead_organisation_name"] = trim($v["Lead organisation name"]);
    $output[$k]["lead_organisation_category"] = trim($v["Lead organisation category"]);
    $output[$k]["start_date"] = trim($v["Start year"]);
    $output[$k]["active"] = trim($v["Still active"]);
    $output[$k]["end_date"] = trim($v["End year"]);
    $output[$k]["environmental_domain"] = ucfirst(mb_strtolower(trim($v["Primary environmental domain"])));
    $output[$k]["environmental_field"] = ucfirst(mb_strtolower(trim($v["Primary environmental field"])));
    $output[$k]["category"] = ucfirst(mb_strtolower(trim($v["Primary category of project"])));
    $output[$k]["social_uptake"] = ucfirst(mb_strtolower(trim($v["Social uptake"])));
    $output[$k]["policy_aims"] = ucfirst(mb_strtolower(trim($v["Policy aims"])));
    $output[$k]["policy_aims_explanation"] = trim($v["Policy aims explanation"]);
    $output[$k]["policy_relevance"] = ucfirst(mb_strtolower(trim($v["Policy relevance"])));
    $output[$k]["unsdg"][1]  = $v["SDG 1 - Poverty"];
    $output[$k]["unsdg"][2]  = $v["SDG 2 - Food, sustainable agriculture"];
    $output[$k]["unsdg"][3]  = $v["SDG 3 - Health and well-being"];
    $output[$k]["unsdg"][4]  = $v["SDG 4 - Education"];
    $output[$k]["unsdg"][5]  = $v["SDG 5 - Gender equality"];
    $output[$k]["unsdg"][6]  = $v["SDG 6 - Water availability and sustainable management"];
    $output[$k]["unsdg"][7]  = $v["SDG 7 - Energy affordable, reliable, sustainable"];
    $output[$k]["unsdg"][8]  = $v["SDG 8 - Sustainable economic growth and employment"];
    $output[$k]["unsdg"][9]  = $v["SDG 9 - Resilient infrastructure, innovation"];
    $output[$k]["unsdg"][10] = $v["SDG 10 - Reduce inequality"];
    $output[$k]["unsdg"][11] = $v["SDG 11 - Sustainable, resilient cities/settlements"];
    $output[$k]["unsdg"][12] = $v["SDG 12 - Sustainable consumption and production"];
    $output[$k]["unsdg"][13] = $v["SDG 13 - Action to combat climate change and its impacts"];
    $output[$k]["unsdg"][14] = $v["SDG 14 - Marine conservation and sustainable development"];
    $output[$k]["unsdg"][15] = $v["SDG 15 - Terrestrial biodiversity conservation, sustainable forest management and land use management"];
    $output[$k]["unsdg"][16] = $v["SDG 16 - Peace, justice for all"];
    $output[$k]["unsdg"][17] = $v["SDG 17 - Strengthen Global Partnership for Sustainable Development"];
	$output[$k]["source"] = $v["Source"];
    
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
