$(document).ready(function () {

  //configuring JVecorMap
  var countries = _.map(projects, function (p) {
      return p.geocoverage_codes;
  });
  countries = _.flatten(countries);
  countries = _.groupBy(countries);
  var data = {};
  _.each(countries, function (v, k) {
      data[k] = _.size(v);
  }, data);

  var map = new jvm.Map({
    map: 'world_mill',
    container: $('#search-map'),
    regionsSelectable: true,
    regionStyle: {
      selected: {
        fill: '#F4A582'
      }
    },
    series: {
      regions: [{
        values: data,
        scale: ['#C8EEFF', '#0071A4'],
        normalizeFunction: 'polynomial'
      }]
    },
    onRegionTipShow: function (e, el, code) {
      var current_data = map.series.regions[0].values;
      el.html(el.html() + ' - Projects: ' + (current_data[code] ? current_data[code] : 'unknown'));
    },
    onRegionSelected: function (e, code, is_selected, selected_regions) {
      var active_projects = _.filter(projects, function(project){
        return _.isEmpty(this.selected_regions) || ! _.isEmpty(_.intersection(project.geocoverage_codes, this.selected_regions));
      },{selected_regions:selected_regions});
      FJS.removeRecords({'id.$gt': 0});
      FJS.addRecords(active_projects);
      FJS.filter();
    }
  });

  initSliders();

  //NOTE: To append in different container
  var appendToContainer = function (htmlele, record) {
      console.log(record)
  };

  var afterFilter = function (result, jQ) {
    $('#total_projects').text(result.length);

    var checkboxes = $("#category_criteria :input:gt(0)");

    checkboxes.each(function () {
      var c = $(this), count = 0

      if (result.length > 0) {
        count = jQ.where({ 'category': c.val() }).count;
      }
      c.next().text(c.val() + ' (' + count + ')')
    });

    var checkboxes = $("#geoextent_criteria :input:gt(0)");

    checkboxes.each(function () {
      var c = $(this), count = 0

      if (result.length > 0) {
        count = jQ.where({ 'geoextent': c.val() }).count;
      }
      c.next().text(c.val() + ' (' + count + ')')
    });
    
    var checkboxes = $("#social_uptake_criteria :input:gt(0)");

    checkboxes.each(function () {
      var c = $(this), count = 0

      if (result.length > 0) {
        count = jQ.where({ 'social_uptake': c.val() }).count;
      }
      c.next().text(c.val() + ' (' + count + ')')
    });
    
    var checkboxes = $("#policy_uptake_criteria :input:gt(0)");

    checkboxes.each(function () {
      var c = $(this), count = 0

      if (result.length > 0) {
        count = jQ.where({ 'policy_uptake': c.val() }).count;
      }
      c.next().text(c.val() + ' (' + count + ')')
    });
    
    var checkboxes = $("#policy_relevance_criteria :input:gt(0)");

    checkboxes.each(function () {
      var c = $(this), count = 0

      if (result.length > 0) {
        count = jQ.where({ 'policy_relevance': c.val() }).count;
      }
      c.next().text(c.val() + ' (' + count + ')')
    });
    var checkboxes = $("#environmental_domain_criteria :input:gt(0)");

    checkboxes.each(function () {
      var c = $(this), count = 0

      if (result.length > 0) {
        count = jQ.where({ 'environmental_domain': c.val() }).count;
      }
      c.next().text(c.val() + ' (' + count + ')')
    });
    
    var checkboxes = $("#environmental_field_criteria :input:gt(0)");

    checkboxes.each(function () {
      var c = $(this), count = 0;

      if (result.length > 0) {
        count = jQ.where({ 'environmental_field': c.val() }).count;
      }
      c.next().text(c.val() + ' (' + count + ')')
    });

    // Managing JVectorMap
    
    var countries = _.map(result, function (p) {
      return p.geocoverage_codes;
    });
    countries = _.flatten(countries);
    countries = _.groupBy(countries);
    var data = {};
    _.each(countries, function (v, k) {
      data[k] = _.size(v);
    }, data);
    
    map.series.regions[0].clear();
    map.series.regions[0].setValues(data);
  };

  var FJS = FilterJS(projects, '#projects', {
    template: '#project-template',
    search: { ele: '#searchbox' },
    //search: {ele: '#searchbox', fields: ['runtime']}, // With specific fields
    callbacks: {
      afterFilter: afterFilter
    },
    pagination: {
      container: '#pagination',
      visiblePages: 5,
      perPage: {
        values: [10, 20, 50],
        container: '#per_page'
      },
    }
  });

  FJS.addCriteria({ field: 'category', ele: '#category_criteria input:checkbox' });
  FJS.addCriteria({ field: 'geoextent', ele: '#geoextent_criteria input:checkbox' });
  FJS.addCriteria({ field: 'social_uptake', ele: '#social_uptake_criteria input:checkbox' });
  FJS.addCriteria({ field: 'policy_uptake', ele: '#policy_uptake_criteria input:checkbox' });
  FJS.addCriteria({ field: 'policy_relevance', ele: '#policy_relevance_criteria input:checkbox' });
  FJS.addCriteria({ field: 'environmental_domain', ele: '#environmental_domain_criteria input:checkbox' });
  FJS.addCriteria({ field: 'environmental_field', ele: '#environmental_field_criteria input:checkbox' });

  window.FJS = FJS;
});

function initSliders() {
  $('#category_criteria :checkbox').prop('checked', true);
  $('#all_category').on('click', function () {
      $('#category_criteria :checkbox').prop('checked', $(this).is(':checked'));
  });
  $('#geoextent_criteria :checkbox').prop('checked', true);
  $('#all_geoextent').on('click', function () {
      $('#geoextent_criteria :checkbox').prop('checked', $(this).is(':checked'));
  });
  $('#social_uptake_criteria :checkbox').prop('checked', true);
  $('#all_social_uptake').on('click', function () {
      $('#social_uptake_criteria :checkbox').prop('checked', $(this).is(':checked'));
  });
  $('#policy_uptake_criteria :checkbox').prop('checked', true);
  $('#all_policy_uptake').on('click', function () {
      $('#policy_uptake_criteria :checkbox').prop('checked', $(this).is(':checked'));
  });
  $('#policy_relevance_criteria :checkbox').prop('checked', true);
  $('#all_policy_relevance').on('click', function () {
      $('#policy_relevance_criteria :checkbox').prop('checked', $(this).is(':checked'));
  });
  $('#environmental_domain_criteria :checkbox').prop('checked', true);
  $('#all_environmental_domain').on('click', function () {
      $('#environmental_domain_criteria :checkbox').prop('checked', $(this).is(':checked'));
  });
  $('#environmental_field_criteria :checkbox').prop('checked', true);
  $('#all_environmental_field').on('click', function () {
      $('#environmental_field_criteria :checkbox').prop('checked', $(this).is(':checked'));
  });
}
