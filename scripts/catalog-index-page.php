<?php

  $sec = "catalog";

  require_once("../config/settings.php");

  $baseuri = $baseuri . "catalog/";

  $fn[] = "c_publisher";
  $fn[] = "c_type";
  
  $records = json_decode(file_get_contents($data_folder . "catalogs.json"), true);

  foreach ($records as $rv) {
    foreach ($fn as $fv) {
      $filter[$fv][] = $rv[$fv];
    }
  }
  
  foreach ($fn as $fv) {
    $filter[$fv] = array_unique($filter[$fv]);
    sort($filter[$fv]);
  }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo $site_title; ?> | <?php echo $section[$sec]["name"]; ?></title>
<link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="http://jiren.github.io/filter.js/assets/css/bootstrap.min.css" media="screen" rel="stylesheet" type="text/css">
<link href="http://jiren.github.io/filter.js/assets/css/jquery-ui-1.10.2.custom.min.css" media="screen" rel="stylesheet" type="text/css">
<link href="<?php echo $site_abs_path; ?>css/common.css" media="screen" rel="stylesheet" type="text/css">
<link href="<?php echo $site_abs_path; ?>css/catalogs.css" media="screen" rel="stylesheet" type="text/css">
<script src="http://jiren.github.io/filter.js/assets/js/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="http://jiren.github.io/filter.js/assets/js/jquery-ui-1.10.2.custom.min.js" type="text/javascript"></script>
<script src="http://jiren.github.io/filter.js/filter.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $site_abs_path; ?>js/common.js"></script>
<script src="<?php echo $section[$sec]["data"]; ?>.js" type="text/javascript"></script>
<script src="<?php echo $site_abs_path; ?>js/catalogs.js" type="text/javascript"></script>
<style>
  .panel-footer {font-size:.8em;}
</style>
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
      <aside class="sidebar col-md-3">
        <div>
          <h4 class='col-md-6'><?php echo $section[$sec]["name"]; ?> (<span id="total_catalogs">0</span>)</h4>
        </div>
        <div>
          <label class="sr-only" for="searchbox">Search</label>
          <input type="text" class="form-control" id="searchbox" placeholder="Search &hellip;" autocomplete="off">
          <span class="glyphicon glyphicon-search search-icon"></span>
        </div>
        <br>
        <div class="well">
          <fieldset id="publisher_criteria">
            <legend>Publisher</legend>
            <div class="checkbox">
              <label>
                <input type="checkbox" value="All" id="all_publisher">
                <span>All</span>
              </label>
            </div>
<?php foreach ($filter["c_publisher"] as $filter_value) { ?>            
            <div class="checkbox">
              <label>
                <input type="checkbox" value="<?php echo $filter_value; ?>">
                <span><?php echo $filter_value; ?><span>
              </label>
            </div>
<?php } ?>            
          </fieldset>
        </div>
        <div class="well">
          <fieldset id="type_criteria">
            <legend>Type</legend>
            <div class="checkbox">
              <label>
                <input type="checkbox" value="All" id="all_type">
                <span>All</span>
              </label>
            </div>
<?php foreach ($filter["c_type"] as $filter_value) { ?>            
            <div class="checkbox">
              <label>
                <input type="checkbox" value="<?php echo $filter_value; ?>">
                <span><?php echo $filter_value; ?><span>
              </label>
            </div>
<?php } ?>            
          </fieldset>
        </div>
    </aside>

<!-- /.col-md-3 -->
    <section class="col-md-9">
      <div class="row">
        <div class="content col-md-12">
          <div id="pagination" class="pagination col-md-9"></div>
          <div class="col-md-3 content">
            Per Page: <span id="per_page" class="content"></span>
          </div>
        </div>
      </div>

      <div class="catalogs row col-md-12" id="catalogs"> </div>
      
    </section>
<!-- /.col-md-9 -->
</article>
<footer>
<?php echo $footer; ?>
</footer>
<!-- /.container -->
      <script id="catalog-template" type="text/html">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4><a href="./<%= c_id %>.html"><%= c_name %></a></h4>
          </div>
          <div class="panel-body">
            <p><%= c_description %></p>
          </div>
          <div class="panel-footer">
            <p>
          </div>
        </div>
      </div>
      </script>
<!--
            <dl>
              <dt>Category</dt>
              <dd><%= category %></dd>
              <dt>Geographic extent</dt>
              <dd><%= geoextent %></dd>
              <dt>Primary environmental domain</dt>
              <dd><%= environmental_domain %></dd>
              <dt>Primary environmental field</dt>
              <dd><%= environmental_field %></dd>
            </dl>
-->
<!--
      <script id="publisher-template" type="text/html">
        <div class="checkbox" fjs-criteria="field=c_publisher,ele=#publishers input:checkbox">
          <label>
            <input type="checkbox" value="<%= c_publisher %>"> <%= c_publisher %>
          </label>
        </div>
      </script>
      <script id="type-template" type="text/html">
        <div class="checkbox">
          <label>
            <input type="checkbox" value="<%= c_type %>"> <%= c_type %>
          </label>
        </div>
      </script>
-->      
    </body>
  </html>
