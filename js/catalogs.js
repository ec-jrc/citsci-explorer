$(document).ready(function(){

  initSliders();

  var appendToContainer = function(htmlele, record){
    console.log(record)
  };

  var afterFilter = function(result, jQ){
    $('#total_catalogs').text(result.length);

    var checkboxes  = $("#publisher_criteria :input:gt(0)");

    checkboxes.each(function(){
      var c = $(this), count = 0

      if(result.length > 0){
        count = jQ.where({ 'c_publisher': c.val() }).count;
      }
      c.next().text(c.val() + ' (' + count + ')')
    });

    var checkboxes  = $("#type_criteria :input:gt(0)");

    checkboxes.each(function(){
      var c = $(this), count = 0

      if(result.length > 0){
        count = jQ.where({ 'c_type': c.val() }).count;
      }
      c.next().text(c.val() + ' (' + count + ')')
    });
    
  }

  var FJS = FilterJS(catalogs, '#catalogs', {
    template: '#catalog-template',
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

  FJS.addCriteria({field: 'c_publisher', ele: '#publisher_criteria input:checkbox'});
  FJS.addCriteria({field: 'c_type', ele: '#type_criteria input:checkbox'});

  window.FJS = FJS;
});


function initSliders(){

  $('#publisher_criteria :checkbox').prop('checked', true);
  $('#all_publisher').on('click', function(){
    $('#category_publisher :checkbox').prop('checked', $(this).is(':checked'));
  });
  $('#type_criteria :checkbox').prop('checked', true);
  $('#all_type').on('click', function(){
    $('#type_criteria :checkbox').prop('checked', $(this).is(':checked'));
  });

}
