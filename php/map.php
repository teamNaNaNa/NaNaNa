<?php 

define('DB_DATABASE', 'esoft');
define('DB_USERNAME', 'NaNaNa');
define('DB_PASSWORD', 'nananana');
define('PDO_DSN', 'mysql:dbhost=localhost;dbname=' . DB_DATABASE);

try{

    //connect
    $db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // select
    if (isset($_GET['zisin'])) {
        $zisin = 1;
        } else {
        $zisin = '_';
        }
    if (isset($_GET['bouhuu'])) {
        $bouhuu = 1;
        } else {
        $bouhuu = '_';
        }
    if (isset($_GET['suigai'])) {
        $suigai = 1;
        } else {
        $suigai = '_';
        }
    if (isset($_GET['etc'])) {
        $etc = 1;
        } else {
        $etc = '_';
        }
    if (isset($_GET['tsunami'])) {
        $tsunami = 1;
        } else {
        $tsunami = '_';
        }

    if (isset($_GET['rad'])) {
        if ($_GET['rad'] == "1km ▼") {
            $rad = 1;   
        } 
        elseif ($_GET['rad'] == "3km ▼") {
            $rad = 3;
        }        
        elseif ($_GET['rad'] == "5km ▼") {
            $rad = 5;
        }
        elseif ($_GET['rad'] == "10km ▼") {
            $rad = 10;
        }
        else {
            $rad = 10000;
        }
    } else {
        $rad = 10000;
    }
    

    session_start();
    $gpsx = $_SESSION['gpsx'];
    $gpsy = $_SESSION['gpsy'];

   // $gpslen = $_GET['elen']; 
    $e3 = $db->prepare("SELECT 名称, 住所, X(位置), Y(位置), ROUND(GLENGTH(GEOMFROMTEXT(CONCAT('LineString(', ?, ' ', ?, ', ', X(位置), ' ', Y(位置), ')'))) * 112.12 * 1000 ) AS '直線距離' FROM earea 
    WHERE 地震災害 LIKE ? AND 暴風災害 LIKE ? AND 水害 LIKE ? AND その他 LIKE ? AND 指定なし LIKE ? AND ROUND(GLENGTH(GEOMFROMTEXT(CONCAT('LineString(', ?, ' ', ?, ', ', X(位置), ' ', Y(位置), ')'))) * 112.12 * 1000  ) <= ?*1000 ORDER BY 直線距離 LIMIT 13;");

    $e3->bindValue(1, $gpsx);
    $e3->bindValue(2, $gpsy);
    $e3->bindValue(3, $zisin);
    $e3->bindValue(4, $bouhuu);
    $e3->bindValue(5, $suigai);
    $e3->bindValue(6, $etc);
    $e3->bindValue(7, $tsunami);
    $e3->bindValue(8, $gpsx);
    $e3->bindValue(9, $gpsy);
    $e3->bindValue(10, $rad, PDO::PARAM_INT);
 
    $e3->execute();
    
    $row = 0;
    while($result = $e3->fetch(PDO::FETCH_ASSOC)) {
        $ename[$row] = $result['名称'];
        $pointX[$row] = $result['X(位置)'];
        $pointY[$row] = $result['Y(位置)'];
        $row++;
    }
    
    $_SESSION['ename'] = $ename;
    $_SESSION['pointX'] = $pointX;
    $_SESSION['pointY'] = $pointY;
    $_SESSION['gpsx'] = $gpsx; 
    $_SESSION['gpsy'] = $gpsy; 

   // echo $e3->rowCount() . "records found!!";

   
/* 
    値が受け取れているかのテスト

    if (isset($_GET['zisin'])) {
           echo $_GET['zisin'];
    } else {
       echo 0;
   }
   if (isset($_GET['bouhuu'])) {
       echo $_GET['bouhuu'];
   } else {
       echo 0;
   }
   if (isset($_GET['suigai'])) {
       echo $_GET['suigai'];
   } else {
       echo 0;
   }
   if (isset($_GET['etc'])) {
       echo $_GET['etc'];
   } else {
       echo 0;
   }
   if (isset($_GET['tsunami'])) {
       echo $_GET['tsunami'];
   } else {
       echo 0;
   }

*/



/*
    全件抽出テストSQL

    $stmt = $db->query("select 避難所番号, X(位置), Y(位置), 名称, 住所 from earea");
    $area = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($area as $areas) {
        var_dump($areas);
    }
    echo $stmt->rowCount() . "records found!!";
*/


    //disconnect
    $db = null;

}   catch(PDOException $e) {
    echo $e->getMesseage();
    exit;
}

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

            var g1X = <?php echo json_encode($pointX[0]); ?>;
            var g1Y = <?php echo json_encode($pointY[0]); ?>;
            var g1Name = <?php echo json_encode($ename[0]); ?>;

            var g2X = <?php echo json_encode($pointX[1]); ?>;
            var g2Y = <?php echo json_encode($pointY[1]); ?>;
            var g2Name = <?php echo json_encode($ename[1]); ?>;

            var g3X = <?php echo json_encode($pointX[2]); ?>;
            var g3Y = <?php echo json_encode($pointY[2]); ?>;
            var g3Name = <?php echo json_encode($ename[2]); ?>;

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
	    map.drawRoute({
            origin: [lat, lng],//出発点の緯度経度
            destination: [g2X, g2Y],//目標地点の緯度経度
            travelMode: 'walking',//モード(walking,driving)
            strokeColor: '#2ecc40',//ルートの色
            strokeOpacity: 0.8,//ルートの透明度
            strokeWeight: 4//ルート線の太さ
        });
	map.addMarker({
                lat: g2X,
                lng: g2Y,
                title: g2Name,
                infoWindow: {
                    content: g2Name
        }
	});
	map.drawRoute({
            origin: [lat, lng],//出発点の緯度経度
            destination: [g3X, g3Y],//目標地点の緯度経度
            travelMode: 'walking',//モード(walking,driving)
            strokeColor: '#dc143c',//ルートの色
            strokeOpacity: 0.8,//ルートの透明度
            strokeWeight: 4//ルート線の太さ
        });
	map.addMarker({
                lat: g3X,
                lng: g3Y,
                title: g3Name,
                infoWindow: {
                    content: g3Name
        }
	});
        };
    </script>
      </div>
    </div>
    <!-- 避難所名表示 -->
      <div class="container">
        <div class="row">
<!-- 避難所情報1 -->
          <div class="col-xs-9 col-md-9 col-lg-9 center-block bg-info" style="text-align:center; font-size:30px;"><?php echo $ename[0]; ?></div>
          <div class="col-xs-3 col-md-3 col-lg-3">
          <div><a href="https://github.com/teamNaNaNa/NaNaNa" type="button" class="btn btn-link btn-lg" role="button">詳細</a></div>
          </div>
<!-- 避難所情報2 -->
          <div class="col-xs-9 col-md-9 col-lg-9 bg-success" style="text-align:center; font-size:30px;"><?php echo $ename[1]; ?></div>
          <div class="col-xs-3 col-md-3 col-lg-3">
          <div><a href="https://github.com/teamNaNaNa/NaNaNa" type="button" class="btn btn-link btn-lg" role="button">詳細</a></div>
          </div>
<!-- 避難所情報3 -->
          <div class="col-xs-9 col-md-9 col-lg-9 bg-danger" style="text-align:center; font-size:30px;"><?php echo $ename[2]; ?></div>
          <div class="col-xs-3 col-md-3 col-lg-3">
          <div><a href="https://github.com/teamNaNaNa/NaNaNa" type="button" class="btn btn-link btn-lg" role="button">詳細</a></div>
          </div>
        </div>
      </div>

<form action="addmore.php" method="get">
<input type="submit" value="さらに表示する(最大10件)"></button>
  </body>
</html>
