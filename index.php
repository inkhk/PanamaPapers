<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Panama Papers</title>
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />

</head>
<body>
<header>
<h1>Panama Papers</h1>
<hr class = "divider">
</header>
<div id = "overview">
  <hr>
  <h3>Overview</h3>
  <hr>
<div class = "col-lg-4  col-md-4 col-sm-12 intro">
<p>The Panama Papers is one of the biggest leaks and largest collaborative investigations in journalism history. It contains a set of 11.5 million leaked documents detailing attorney–client information for more than 214,000 offshore companies associated with the Panamanian law firm and corporate service provider, Mossack Fonseca.<br><br>
  While the use of offshore business entities is not illegal in the jurisdictions in which they are registered, and often not illegal at all, reporters found that some of the shell corporations seem to have been used for illegal purposes, including fraud, drug trafficking, and tax evasion.
</p></div>
<div class = "col-lg-3 col-md-3 col-sm-12 figure">
  <img src = "img/panama_figure.png">
</div>
<div class = "col-lg-5 col-md-5 col-sm-12 video">
  <div class = "embed-responsive embed-responsive-16by9">
<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/F6XnH_OnpO0" allowfullscreen></iframe></div>
</div>
</div>
<div id = "map-wrap">
<div id = "map"></div>
<p style = "padding-top:5px;">Tax havens used by Mossack Fonseca</p>
<p style = "color:#cecece;font-size:10px;margin-top:-10px;">Data sourced from the <a href = "https://panamapapers.icij.org/" target = "_blank">International Consortium of Investigative Journalists</a></p>
</div>
<div id = "news">
  <div id = "news_header">
    <hr>
    <h3>Latest News</h3>
    <hr>
    </div>
    <div id = "nytimes" class = "col-lg-4 col-md-4 col-sm-12">
    <div class= "news_sub"><p>New York Times</p></div>
    </div>
    <div id = "guardians"class = "col-lg-4 col-md-4 col-sm-12">
      <div class= "news_sub"><p>The Guardians</p></div>
      </div>
    <div id = "twitter" class = "col-lg-4 col-md-4 col-sm-12">
        <div class= "news_sub"><p>Twitter</p></div>
      <?php
      ini_set('display_errors', 1);
      require_once('TwitterAPIExchange.php');

      /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
      $settings = array(
        'oauth_access_token' => "2382443129-lM2xEVxCk90J9w55Rowinn9pNbAcjE3pl5mj8nd",
        'oauth_access_token_secret' => "7LLy1aa27KDCQHlEi7DTamzD5ytyTdaHTFPKM9dO3LPnq",
        'consumer_key' => "W6fho8Wj5UVKZRiC2X27eQAmT",
        'consumer_secret' => "gPWDptC2mzYDTeXP1bVWHjsp7V1CKIBBAlBbBTXrdmvvHYrpRy"
      );


      /** Perform a GET request and echo the response **/
      /** Note: Set the GET field BEFORE calling buildOauth(); **/
      $url = 'https://api.twitter.com/1.1/search/tweets.json';
      $getfield = '?q=%23panamapapers';
      $requestMethod = 'GET';
      $twitter = new TwitterAPIExchange($settings);
      // echo $twitter->setGetfield($getfield)
      //              ->buildOauth($url, $requestMethod)
      //              ->performRequest();

      $tweetData = json_decode($twitter->setGetfield($getfield)
      ->buildOauth($url,$requestMethod)
      ->performRequest(),$assoc = TRUE);

      foreach($tweetData['statuses'] as $items)
      {
        $entitiesArray = $items['entities'];
        $profileimg = $items['user']['profile_image_url'];
        echo "<div class = 'user'><img src = '" . $profileimg . "'><p>" . $items['user']['name'] . "</p></div>";
        echo "<div class = 'tweet'><p>". $items['text'] . "</p></div><hr>";
        //echo "<div class = 'tweettime'>When: " . $items['created_at'] . "</div>";
        //echo "<div class = 'tweetlocation'>Where: " . $items['location']. "</div></div>";

        // if(isset($entitiesArray['media'])){
        //   $mediaArray = $entitiesArray['media'];
        //   $tweetMedia = $mediaArray[0];
        //   echo "<a target = '_blank' href = '" . $tweetMedia['expanded_url'] . "'><img target = '_blank' src = '".$tweetMedia['media_url'] . "'></a>";
        // }
      }
      ?></div>

</div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <script src="js/tweetLinkIt.js"></script>
<script>

  $('.tweet').tweetLinkify();
function initMap() {
  var map;
  var elevator;
map = new google.maps.Map($('#map')[0],
{
zoom: 2,
center: new google.maps.LatLng(0, 0),

});

var customMapType = new google.maps.StyledMapType([{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#dde6e8"},{"visibility":"on"}]}], {
 name: 'Custom Style'
});
var customMapTypeId = 'custom_style';
      var addresses = ['British Virgin Islands', 'Belize', 'Cyprus','Isle of Man','Malta', 'New Zealand','Panama','Samoa','Singapore','Uruguay','Bahamas','British Anguilla', 'Costa Rica','Hong Kong','Jersey','Nevada','Niue','Ras Al Khaimah', 'Seychelles','United Kingdom','Wyoming'];
      var infowindow = new google.maps.InfoWindow({
        content: '<p>to be decided</p>'
      });
      var markers = [];
      for (var x = 0; x < addresses.length; x++) {
          var marker = markers[x];
          var i = 0;
          $.getJSON('http://maps.googleapis.com/maps/api/geocode/json?address='+addresses[x]+'&sensor=false', null, function (data) {
              var p = data.results[0].geometry.location
              var latlng = new google.maps.LatLng(p.lat, p.lng);
              marker = new google.maps.Marker({
                  position: latlng,
                  map: map,
                  html:'<p>'+addresses[i]+'</p>'
              });
              i++;
              google.maps.event.addListener(marker, 'click', function () {
                  infowindow.setContent(this.html);
                  infowindow.open(map, this);
                });
           });
      }
     map.mapTypes.set(customMapTypeId, customMapType);
     map.setMapTypeId(customMapTypeId);
   }

  function parseNYT(){
  var apiurl = "http://api.nytimes.com/svc/search/v2/articlesearch.json?q=panama+papers&sort=newest&api-key=366262e14ef430ab0ba7ac3854e83206:8:75046126";
  var access_token = location.hash.split('=')[2];
  var html = ""
    $.ajax({
      type: "GET",
      dataType: "json",
      cache: false,
      url: apiurl,
      success: parseData
    });

    function parseData(json){
      var arr = json.response.docs;
      //html += '<img src = "https://static01.nyt.com/' + arr[0].multimedia[1].url + '">';

      $.each(arr,function(i,data){
        if(typeof data.headline.print_headline !== 'undefined'){
        html += '<a href = "'+ data.web_url + '" target = "_blank"><h4>'+ data.headline.print_headline+'</h4></a>';
        html += '<p>'+data.lead_paragraph+'</p><hr>'
      }
      });
      $("#nytimes").append(html);
    }
}
parseNYT();
function parseGuardians(){
var apiurl = "http://content.guardianapis.com/search?order-by=newest&q=panama%20AND%20papers&api-key=919d73d1-f207-4207-9a90-0715b9aa0d51";
var access_token = location.hash.split('=')[2];
var html = ""
  $.ajax({
    type: "GET",
    dataType: "json",
    cache: false,
    url: apiurl,
    success: parseData
  });

  function parseData(json){
    //console.log(json);
    var arr = json.response.results;
    //console.log(arr);
    // html += '<img src = "https://static01.nyt.com/' + arr[0].multimedia[1].url + '">';
    //
    $.each(arr,function(i,data){
      //console.log(i);
      //console.log(data);
      html += '<a href = "'+ data.webUrl + '" target = "_blank"><h4>'+ data.webTitle+'</h4></a>';
      html += '<p>'+data.webPublicationDate+'</p><hr>'
    });
    $("#guardians").append(html);
  }
}
parseGuardians();

  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoLi-k6mPII8WvDORsAii01Wa0fDKSZRk&callback=initMap"
  async defer></script>


</body>
</html>
