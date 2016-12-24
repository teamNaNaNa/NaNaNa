<?php
    session_start();
    $ename = $_SESSION['ename'];
    $point = $_SESSION['point'];
    $pointX = $_SESSION['pointX'];
    $pointY = $_SESSION['pointY'];
    $hig = $_SESSION['hig'];
    $human = $_SESSION['human'];

    $gpsx = $_SESSION['gpsx'];
    $gpsy = $_SESSION['gpsy'];
?>


<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MAP PAGE</title>
    <!-- BootstrapのCSS読み込み -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/mainstyle.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maps.google.com/maps?file=api&v=2&key=AIzaSyBlWOyUyGRBg8qNpqARk6Phoq-G6jhH8yY&sensor=false"
              type="text/javascript" charset="utf-8"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Map表示 -->
    <style type="text/css">
        #map {
            width: 600px;
            height: 600px;
        }
    </style>
  </head>
  <body>
    <div class="row">
      <div class="col-xs-12 col-md-12 col-lg-12">
    <div id="map"></div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkch2DopMSDqYvFBR6soTAUDDxBwNNW6o"></script>
    <script src="http://raw.githubusercontent.com/HPNeo/gmaps/master/gmaps.js"></script>    
    <script>
        window.onload = function(){
            var lat = <?php echo json_encode($gpsx); ?>;//緯度 <-逆かな？
            var lng = <?php echo json_encode($gpsy); ?>;//経度

            var g1X = <?php echo json_encode($pointX[3]); ?>;
            var g1Y = <?php echo json_encode($pointY[3]); ?>;
            var g1Name = <?php echo json_encode($ename[3]); ?>;

            var g2X = <?php echo json_encode($pointX[4]); ?>;
            var g2Y = <?php echo json_encode($pointY[4]); ?>;
            var g2Name = <?php echo json_encode($ename[4]); ?>;

            var g3X = <?php echo json_encode($pointX[5]); ?>;
            var g3Y = <?php echo json_encode($pointY[5]); ?>;
            var g3Name = <?php echo json_encode($ename[5]); ?>;
            
            var g4X = <?php echo json_encode($pointX[6]); ?>;
            var g4Y = <?php echo json_encode($pointY[6]); ?>;
            var g4Name = <?php echo json_encode($ename[6]); ?>;

            var g5X = <?php echo json_encode($pointX[7]); ?>;
            var g5Y = <?php echo json_encode($pointY[7]); ?>;
            var g5Name = <?php echo json_encode($ename[7]); ?>;

            var g6X = <?php echo json_encode($pointX[8]); ?>;
            var g6Y = <?php echo json_encode($pointY[8]); ?>;
            var g6Name = <?php echo json_encode($ename[8]); ?>;

            var g7X = <?php echo json_encode($pointX[9]); ?>;
            var g7Y = <?php echo json_encode($pointY[9]); ?>;
            var g7Name = <?php echo json_encode($ename[9]); ?>;
            
            var g8X = <?php echo json_encode($pointX[10]); ?>;
            var g8Y = <?php echo json_encode($pointY[10]); ?>;
            var g8Name = <?php echo json_encode($ename[10]); ?>;

            var g9X = <?php echo json_encode($pointX[11]); ?>;
            var g9Y = <?php echo json_encode($pointY[11]); ?>;
            var g9Name = <?php echo json_encode($ename[11]); ?>;

            var g10X = <?php echo json_encode($pointX[12]); ?>;
            var g10Y = <?php echo json_encode($pointY[12]); ?>;
            var g10Name = <?php echo json_encode($ename[12]); ?>;

            var map = new GMaps({
                div: "#map",//id名
                lat: lat,
                lng: lng,
                zoom: 13//縮尺
            });

       　　　map.addMarker({
                lat: lat,
                lng: lng,
                title: "現在地",
                infoWindow: {
                    content: "<p>現在地</p>"
                }
            });
            map.addMarker({
                lat: g1X,
                lng: g1Y,
                title: g1Name,
                infoWindow: {
                    content: g1Name
                }
            });
            map.addMarker({
                lat: g2X,
                lng: g2Y,
                title: g2Name,
                infoWindow: {
                    content: g2Name
                }
            });
            map.addMarker({
                lat: g3X,
                lng: g3Y,
                title: g3Name,
                infoWindow: {
                    content: g3Name
                }
            });
            map.addMarker({
                lat: g4X,
                lng: g4Y,
                title: g4Name,
                infoWindow: {
                    content: g4Name
                }
            });
            map.addMarker({
                lat: g4X,
                lng: g4Y,
                title: g4Name,
                infoWindow: {
                    content: g4Name
                }
            });
            map.addMarker({
                lat: g5X,
                lng: g5Y,
                title: g5Name,
                infoWindow: {
                    content: g5Name
                }
            });
            map.addMarker({
                lat: g6X,
                lng: g6Y,
                title: g6Name,
                infoWindow: {
                    content: g6Name
                }
            });
            map.addMarker({
                lat: g7X,
                lng: g7Y,
                title: g7Name,
                infoWindow: {
                    content: g7Name
                }
            });
            map.addMarker({
                lat: g8X,
                lng: g8Y,
                title: g8Name,
                infoWindow: {
                    content: g8Name
                }
            });
            map.addMarker({
                lat: g9X,
                lng: g9Y,
                title: g9Name,
                infoWindow: {
                    content: g9Name
                }
            });
            map.addMarker({
                lat: g10X,
                lng: g10Y,
                title: g10Name,
                infoWindow: {
                    content: g10Name
                }
            });

	};
    </script>
      </div>
    </div>
      <div class="container">       
        <div class="row">

          <div class="col-xs-9 col-md-9 col-lg-9" style="text-align:center; font-size:30px;"><?php echo $ename[3]; ?></div>
          <div class="col-xs-3 col-md-3 col-lg-3">
          <div><a href="shousai.php?ename=<?php echo $ename[3]; ?>&point=<?php echo $point[3]; ?>&hig=<?php echo $hig[3]; ?>&human=<?php echo $human[3]; ?>" type="button" class="btn btn-link btn-lg" role="button">詳細</a></div>
          </div>

          <div class="col-xs-9 col-md-9 col-lg-9" style="text-align:center; font-size:30px;"><?php echo $ename[4]; ?></div>
          <div class="col-xs-3 col-md-3 col-lg-3">
          <div><a href="shousai.php?ename=<?php echo $ename[4]; ?>&point=<?php echo $point[4]; ?>&hig=<?php echo $hig[4]; ?>&human=<?php echo $human[4]; ?>" type="button" class="btn btn-link btn-lg" role="button">詳細</a></div>
          </div>

          <div class="col-xs-9 col-md-9 col-lg-9" style="text-align:center; font-size:30px;"><?php echo $ename[5]; ?></div>
          <div class="col-xs-3 col-md-3 col-lg-3">
          <div><a href="shousai.php?ename=<?php echo $ename[5]; ?>&point=<?php echo $point[5]; ?>&hig=<?php echo $hig[5]; ?>&human=<?php echo $human[5]; ?>" type="button" class="btn btn-link btn-lg" role="button">詳細</a></div>
          </div>

          <div class="col-xs-9 col-md-9 col-lg-9" style="text-align:center; font-size:30px;"><?php echo $ename[6]; ?></div>
          <div class="col-xs-3 col-md-3 col-lg-3">
          <div><a href="shousai.php?ename=<?php echo $ename[6]; ?>&point=<?php echo $point[6]; ?>&hig=<?php echo $hig[3]; ?>&human=<?php echo $human[6]; ?>" type="button" class="btn btn-link btn-lg" role="button">詳細</a></div>
          </div>

          <div class="col-xs-9 col-md-9 col-lg-9" style="text-align:center; font-size:30px;"><?php echo $ename[7]; ?></div>
          <div class="col-xs-3 col-md-3 col-lg-3">
          <div><a href="shousai.php?ename=<?php echo $ename[7]; ?>&point=<?php echo $point[7]; ?>&hig=<?php echo $hig[7]; ?>&human=<?php echo $human[7]; ?>" type="button" class="btn btn-link btn-lg" role="button">詳細</a></div>
          </div>

          <div class="col-xs-9 col-md-9 col-lg-9" style="text-align:center; font-size:30px;"><?php echo $ename[8]; ?></div>
          <div class="col-xs-3 col-md-3 col-lg-3">
          <div><a href="shousai.php?ename=<?php echo $ename[8]; ?>&point=<?php echo $point[8]; ?>&hig=<?php echo $hig[8]; ?>&human=<?php echo $human[8]; ?>" type="button" class="btn btn-link btn-lg" role="button">詳細</a></div>
          </div>

          <div class="col-xs-9 col-md-9 col-lg-9" style="text-align:center; font-size:30px;"><?php echo $ename[9]; ?></div>
          <div class="col-xs-3 col-md-3 col-lg-3">
          <div><a href="shousai.php?ename=<?php echo $ename[9]; ?>&point=<?php echo $point[9]; ?>&hig=<?php echo $hig[9]; ?>&human=<?php echo $human[9]; ?>" type="button" class="btn btn-link btn-lg" role="button">詳細</a></div>
          </div>

          <div class="col-xs-9 col-md-9 col-lg-9" style="text-align:center; font-size:30px;"><?php echo $ename[10]; ?></div>
          <div class="col-xs-3 col-md-3 col-lg-3">
          <div><a href="shousai.php?ename=<?php echo $ename[10]; ?>&point=<?php echo $point[10]; ?>&hig=<?php echo $hig[10]; ?>&human=<?php echo $human[10]; ?>" type="button" class="btn btn-link btn-lg" role="button">詳細</a></div>
          </div>

          <div class="col-xs-9 col-md-9 col-lg-9" style="text-align:center; font-size:30px;"><?php echo $ename[11]; ?></div>
          <div class="col-xs-3 col-md-3 col-lg-3">
          <div><a href="shousai.php?ename=<?php echo $ename[11]; ?>&point=<?php echo $point[11]; ?>&hig=<?php echo $hig[11]; ?>&human=<?php echo $human[11]; ?>" type="button" class="btn btn-link btn-lg" role="button">詳細</a></div>
          </div>

          <div class="col-xs-9 col-md-9 col-lg-9" style="text-align:center; font-size:30px;"><?php echo $ename[12]; ?></div>
          <div class="col-xs-3 col-md-3 col-lg-3">
          <div><a href="shousai.php?ename=<?php echo $ename[12]; ?>&point=<?php echo $point[12]; ?>&hig=<?php echo $hig[12]; ?>&human=<?php echo $human[12]; ?>" type="button" class="btn btn-link btn-lg" role="button">詳細</a></div>
          </div>

          
        </div>
      </div>
  </body>
</html>
