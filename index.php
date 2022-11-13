<!-- 
    Title: SETU MAP
    By: Robert Binkowski
 -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>South East University Map</title>

  <!-- A* -->

  <script language="javascript" type="text/javascript" src="js/libraries/p5.js"></script>
  <script language="javascript" type="text/javascript" src="js/libraries/p5.dom.js"></script>
  <script language="javascript" type="text/javascript" src="js/sketch.js"></script>
  <script language="javascript" type="text/javascript" src="js/spot.js"></script>
  <script language="javascript" type="text/javascript" src="js/map/mapfactory.js"></script>
  <script language="javascript" type="text/javascript" src="js/map/searchmap.js"></script>
  <script language="javascript" type="text/javascript" src="js/astarpathfinder.js"></script>

  <!-- Bootstrap -->
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>

<body>
  <main id="app"></main>

  <button onclick="getLocation()">Check Location</button>

  <p id="location"></p>
  <script>
    var x = document.getElementById("location");

    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else {
        x.innerHTML = "Geolocation is not permitted or is not supported by this browser.";
      }
    }

    function showPosition(position) {
      x.innerHTML = "Latitude: " + position.coords.latitude +
        "<br>Longitude: " + position.coords.longitude;
    }
  </script>
</body>

</html>