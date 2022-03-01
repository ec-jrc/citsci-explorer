<?php

  $sec = "project";

  require_once("../config/settings.php");

  $baseuri = $baseuri . "project/";

  $fn[] = "category";
  $fn[] = "geoextent";
  $fn[] = "environmental_domain";
  $fn[] = "environmental_field";
  $fn[] = "social_uptake";
  $fn[] = "policy_aims";
  $fn[] = "policy_relevance";
  $fn[] = "source";
  
  $records = json_decode(file_get_contents($data_folder . "projects.json"), true);

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
    <link href="https://eloquentstudio.github.io/filter.js/assets/css/bootstrap.min.css" media="screen" rel="stylesheet" type="text/css">
    <link href="https://eloquentstudio.github.io/filter.js/assets/css/jquery-ui-1.10.2.custom.min.css" media="screen" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.3/jquery-jvectormap.min.css" crossorigin="anonymous" />
    
    <link href="<?php echo $site_abs_path; ?>css/common.css" media="screen" rel="stylesheet" type="text/css">    
    <link href="<?php echo $site_abs_path; ?>css/projects.css" media="screen" rel="stylesheet" type="text/css">
    <script src="https://eloquentstudio.github.io/filter.js/assets/js/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="https://eloquentstudio.github.io/filter.js/assets/js/jquery-ui-1.10.2.custom.min.js" type="text/javascript"></script>
    <script src="https://eloquentstudio.github.io/filter.js/filter.min.js" type="text/javascript"></script>

    <script src="<?php echo $site_abs_path; ?>js/jvectormap.com/js/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="<?php echo $site_abs_path; ?>js/jvectormap.com/js/jquery-jvectormap-world-mill.js"></script>
        
    <script type="text/javascript" src="<?php echo $site_abs_path; ?>js/common.js"></script>
    <script src="<?php echo $section[$sec]["data"] ; ?>.js" type="text/javascript"></script>
    <script src="<?php echo $site_abs_path; ?>js/projects-map.js" type="text/javascript"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.9.1/underscore-min.js" integrity="sha256-G7A4JrJjJlFqP0yamznwPjAApIKPkadeHfyIwiaa9e0=" crossorigin="anonymous"></script>    
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
          <h4 class='col-md-6'>Projects (<span id="total_projects">0</span>)</h4>
        </div>
        <div>
          <label class="sr-only" for="searchbox">Search</label>
          <input type="text" class="form-control" id="searchbox" placeholder="Search &hellip;" autocomplete="off">
          <span class="glyphicon glyphicon-search search-icon"></span>
        </div>
        <br>
        <div class="well">
            <fieldset id="category_criteria">
                <legend>Category</legend>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="All" id="all_category">
                    <span>All</span>
                  </label>
                </div>
<?php foreach ($filter["category"] as $filter_value) { ?>            
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
            <fieldset id="geoextent_criteria">
                <legend>Geographic extent</legend>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="All" id="all_geoextent">
                    <span>All</span>
                  </label>
                </div>
<?php foreach ($filter["geoextent"] as $filter_value) { ?>            
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
            <fieldset id="environmental_domain_criteria">
                <legend>Primary environmental domain</legend>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="All" id="all_environmental_domain">
                    <span>All</span>
                  </label>
                </div>
<?php foreach ($filter["environmental_domain"] as $filter_value) { ?>            
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
            <fieldset id="environmental_field_criteria">
                <legend>Primary environmental field</legend>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="All" id="all_environmental_field">
                    <span>All</span>
                  </label>
                </div>
<?php foreach ($filter["environmental_field"] as $filter_value) { ?>            
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
            <fieldset id="social_uptake_criteria">
                <legend>Social uptake</legend>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="All" id="all_social_uptake">
                    <span>All</span>
                  </label>
                </div>
<?php foreach ($filter["social_uptake"] as $filter_value) { ?>            
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
            <fieldset id="policy_aims_criteria">
                <legend>Policy aims</legend>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="All" id="all_aims_uptake">
                    <span>All</span>
                  </label>
                </div>
<?php foreach ($filter["policy_aims"] as $filter_value) { ?>            
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
            <fieldset id="policy_relevance_criteria">
                <legend>Policy relevance</legend>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="All" id="all_policy_relevance">
                    <span>All</span>
                  </label>
                </div>
<?php foreach ($filter["policy_relevance"] as $filter_value) { ?>            
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
          <div id="search-map" class="projects row col-md-12" style="height:300px;"></div>        
          <div id="pagination" class="pagination col-md-9"></div>
          <div class="col-md-3 content">
            Per Page: <span id="per_page" class="content"></span>
          </div>
        </div>
      </div>

      <div class="projects row col-md-12" id="projects"> </div>
      
    </section>
<!-- /.col-md-9 -->
</article>
<footer>
<?php echo $footer; ?>
</footer>
<!-- /.container -->
      <script id="project-template" type="text/html">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4><a href="./<%= id %>.html"><%= name %></a></h4>
          </div>
          <div class="panel-body">
            <p><%= description %></p>
          </div>
          <div class="panel-footer">
<!--          
            <p>
              <span class="icon icon-ca" title="Category">CA</span> <%= category %> 
              <span class="icon icon-ed" title="Primary environmental domain">ED</span> <%= environmental_domain %> 
              <span class="icon icon-ef" title="Primary environmental field">EF</span> <%= environmental_field %> 
              <span class="icon icon-su" title="Social uptake">SU</span> <%= social_uptake %>
              <span class="icon icon-pr" title="Policy relevance">PR</span> <%= policy_relevance %> 
              <span class="icon icon-pu" title="Policy aims">PU</span> <%= policy_aims %> 
            </p>
-->              
          </div>
        </div>
      </div>
      </script>
<!--      
      <script id="geoextent-template" type="text/html">
        <div class="checkbox">
          <label>
            <input type="checkbox" value="<%= geoextent %>"> <%= geoextent %>
          </label>
        </div>
      </script>
-->      
    </body>
  </html>
