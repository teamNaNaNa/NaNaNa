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
            <?php $mc = 3; 
            ?>
            <?php while ($mc < 13 && isset($ename[$mc])) { ?>
                var njs = <?php echo json_encode($pointX[$mc]); ?>;
                var ejs = <?php echo json_encode($pointY[$mc]); ?>;
                var eename = <?php echo json_encode($ename[$mc]); ?>;

            map.addMarker({
                lat: njs,
                lng: ejs,
                title: eename,
                infoWindow: {
                    content: eename
                }
            });
            <?php $mc ++; ?>
            <?php } ?>
	};
    </script>
      </div>
    </div>
      <div class="container">       
        <div class="row">

        <?php $lc = 3; 
        ?>
        <?php while ($lc < 13 && isset($ename[$lc])) { ?>

          <div class="col-xs-9 col-md-9 col-lg-9" style="text-align:center; font-size:30px;"><?php echo $ename[$lc]; ?></div>
          <div class="col-xs-3 col-md-3 col-lg-3">
          <div><a href="shousai.php?gpsx=<?php echo $gpsx; ?>&gpsy=<?php echo $gpsy; ?>&ename=<?php echo $ename[$lc]; ?>&point=<?php echo $point[$lc]; ?>&pointX=<?php echo $pointX[$lc]; ?>&pointY=<?php echo $pointY[$lc]; ?>&hig=<?php echo $hig[$lc]; ?>&human=<?php echo $human[$lc]; ?>" type="button" class="btn btn-link btn-lg" role="button">詳細</a></div>
          </div>

        <?php $lc ++; ?>
        <?php } ?>
          
        </div>
      </div>
  </body>
</html>
