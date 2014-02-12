$(function() {


  map_function();
  // map function

	$('.tab-pills a').on('click', function(e) {
    e.preventDefault();
    $(this).tab('show');
  });

  if($("#lat").val() == "") {
    var latitude = 14.609673471665063;
  }
  else{
    var latitude = parseFloat($("#lat").val());
  }
  if($("#long").val() == "") {
    var longitude = 120.99182313232421;
  }
  else{
    var longitude = parseFloat($("#long").val());
  }

  if(typeof nokia != 'undefined') {
    nokia.Settings.set("app_id", "DemoAppId01082013GAL");
    nokia.Settings.set("app_code", "AJKnXv84fjrb0KIHawS0Tg");
    // Use staging environment (remove the line for production environment)
    nokia.Settings.set("serviceMode", "cit");
      var mapContainer = document.getElementById("map-item");
    // Create a map inside the map container DOM node
    var map = new nokia.maps.map.Display(mapContainer, {
      // initial center and zoom level of the map
      center: [latitude, longitude],
      zoomLevel: 8
    });
  }

  $('#see-map').on('click', function(e) {
    e.preventDefault();
    $('#item-map').slideToggle('slow');
  });
});

var map_function = function(){
  setTimeout(function(){
    $('#frame').attr('src','/contest/maps');
  },1000);
  var year = 'year6';
  var catt = '';

  $('#filters').on('change',function(){
    var item = $(this).val();

    if(item == 'cate'){
      $('#bycatyear6').fadeOut(200);
      $('#bycatyear5').fadeOut(200);
      $('#byear').fadeOut(200);
      $('#bycatall').fadeIn(200);
    }else if(item='comp'){
      $('#bycatall').fadeOut(200);
      $('#byear').fadeIn(200);

    }
  });
 $('#bycatall').on('change',function(){
  var item = $(this).val();
    $('#frame').attr('src','/contest/maps/?year=all&url='+item);
 });

  $('#byear').on('change',function(){
     var x = $(this).val();
         if(x=='year5'){
          $('#bycatyear6').fadeOut(200);
          $('#bycatyear5').fadeIn(200);
          year = x;
          catt = 'SOURCE_DT_TAB_FINALTOP30'
         }
         else if(x=='year6'){
          $('#bycatyear5').fadeOut(200);
          $('#bycatyear6').fadeIn(200);
          year = x;
          catt = 'ALLYEAR6'
         }

         $('#frame').attr('src','/contest/maps/?year='+year+'&url='+catt );
  });
  $('#bycatyear5').on('change',function(){
    var cat =  $(this).val();
    $('#frame').attr('src','/contest/maps/?year='+year+'&url='+cat);
  });
   $('#bycatyear6').on('change',function(){
    var cat =  $(this).val();
    $('#frame').attr('src','/contest/maps/?year=year6&url='+cat);
  });
}
