<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>避難所詳細情報</title>
    <!-- BootstrapのCSS読み込み -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maps.google.com/maps?file=api&v=2&key=AIzaSyBlWOyUyGRBg8qNpqARk6Phoq-G6jhH8yY&sensor=false"
              type="text/javascript" charset="utf-8"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Map表示 -->
    <style type="text/css">
        #map {
            width: 1200px;
            height: 600px;
        }
    </style>

  </head>
  <body>
    <?php
        $gpsx = $_GET["gpsx"];
        $gpsy = $_GET["gpsy"]; 
        $ename = $_GET["ename"];
        $point = $_GET["point"];
        $pointX = $_GET["pointX"];
        $pointY = $_GET["pointY"];
        $hig = $_GET["hig"];
        $human = $_GET["human"];
    ?>

    <header style="background-color:white">
      <div class="jumbotron">
	<div class="container">
	  <center>
            <h1><?php echo $ename; ?></h1>
	  </center>
	</div>
      </div>
    </header>
    <center>
    <div id="map"></div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkch2DopMSDqYvFBR6soTAUDDxBwNNW6o"></script>
    <script src="http://raw.githubusercontent.com/HPNeo/gmaps/master/gmaps.js"></script> 


    <input type="button" value="避難所までの経路を表示" onclick="dmap()"/>
    <input type="button" value="避難所周辺のストリートビューを表示" onclick="street()"/>
    
    <script>
        function dmap(){
            var lat = <?php echo json_encode($gpsx); ?>;//緯度 <-逆かな？
            var lng = <?php echo json_encode($gpsy); ?>;//経度

            var g1X = <?php echo json_encode($pointX); ?>;
            var g1Y = <?php echo json_encode($pointY); ?>;
            var g1Name = <?php echo json_encode($ename); ?>;

            var map = new GMaps({
                div: "#map",//id名
                lat: lat,
                lng: lng,
                zoom: 13//縮尺
            });

            map.drawRoute({
              origin: [lat, lng],//出発点の緯度経度
              destination: [g1X, g1Y],//目標地点の緯度経度
              travelMode: 'walking',//モード(walking,driving)
              strokeColor: '#0000ff',//ルートの色
              strokeOpacity: 0.8,//ルートの透明度
              strokeWeight: 4//ルート線の太さ
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

        };

        function street() {
            panorama = GMaps.createPanorama({
                el: '#map',
                lat : <?php echo json_encode($pointX); ?>,
                lng : <?php echo json_encode($pointY); ?>,
                zoom: 2,
                pov: {
                heading: 120,
                pitch: 8
                }      
            });   
        }

    </script>

    <script>dmap();</script>
    <center>
        <h3>住所 ： <?php echo $point; ?><h3>
        <h3>海抜 ： <?php echo $hig; ?>m<h3>
        <h3>収容人数 ： <?php echo $human; ?>人<h3>
    </center>
    <center>
        <input type="button" value="戻る" onClick="history.back()">
        <p><a href="search.php" type="button" class="btn btn-link btn-lg" role="button">検索画面に戻る</a></p>
    </center>
  </body>
