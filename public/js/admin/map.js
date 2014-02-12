/*  Setup authentication app_id and app_code 
* WARNING: this is a demo-only key
* please register for an Evaluation, Base or Commercial key for use in your app.
* Just visit http://developer.here.com/get-started for more details. Thank you!
*/
nokia.Settings.set("app_id", "DemoAppId01082013GAL"); 
nokia.Settings.set("app_code", "AJKnXv84fjrb0KIHawS0Tg");
// Use staging environment (remove the line for production environment)
nokia.Settings.set("serviceMode", "cit");
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

var coord = {
  latitude : latitude,
  longitude : longitude
}

    var map = new nokia.maps.map.Display(document.getElementById("map"), {
      // Initial center and zoom level of the map
      zoomLevel: 10, 
      center: [latitude, longitude],
      components: [new nokia.maps.map.component.Behavior(),
        // Creates UI to easily switch between street map satellite and terrain mapview modes
        new nokia.maps.map.component.TypeSelector(),
        // ZoomBar provides a UI to zoom the map in & out
        new nokia.maps.map.component.ZoomBar(),
        // Add ContextMenu component so we get context menu on right mouse click / long press tap
        new nokia.maps.map.component.ContextMenu(),

      ]
    });
    
        var standardMarker = new nokia.maps.map.StandardMarker(coord);
// Next we need to add it to the map's object collection so it will be rendered onto the map.
    map.objects.add(standardMarker);

    var mapPlaceWidget = new nokia.places.widgets.Place({
      map: map
    });
    
    var mapResultList = new nokia.places.widgets.ResultList({
      targetNode: "mapResultlist",
      map: map,
      onRenderPage: function () {
        mapResultList.displayOnMap();
      },
      events: [
        {
          rel: "nokia-place-name",
          name: "click",
          handler: function (place) {
            mapPlaceWidget.setPlace({ href: place.href });
          }
        }
      ]
    })
  
    var mapSb = new nokia.places.widgets.SearchBox({
      targetNode: "mapSearchbox",
      map: map,
      resultList: mapResultList
    });
    
    var mapCs = new nokia.places.widgets.CategorySearch({
      targetNode: "mapCSearch",
      map: map,
      resultList: mapResultList
    });


    map.addListener('click', function (evt) {
  var coord = map.pixelToGeo(evt.displayX, evt.displayY);
  /* We create an infobubble using infoBubbles.openBubble.
   * 
   * openBubble(content, coordinate, onUserClose, hideCloseButton) takes for parameters 
   *    - content: to be shown in the info bubble;
   *      it can be an HTML string or an instance of nokia.maps.search.Location
   *    - coordinate: An object containing the geographic coordinates 
   *      of the location, where the bubble's anchor is to be placed
   *    - onUserClose: A callback method which is called when bubble is closed
   *    - hideCloseButton: Hides close button if set to true.
   */
  // infoBubbles.openBubble("Clicked at " + coord, coord);
  
  // // Clear the logger
  // positionLogger.clear();
  
  // We now print the latitude & longitude to the logger
  // positionLogger.log(
  //   "Clicked at position: <br />latitude: " + 
  //   coord.latitude + "<br /> longitude: " + coord.longitude);
    var standardMarker = new nokia.maps.map.StandardMarker(coord);
// Next we need to add it to the map's object collection so it will be rendered onto the map.
    map.objects.add(standardMarker);
    console.log(coord);

    $("#lat").val(coord.latitude);
    $("#long").val(coord.longitude);
});
  