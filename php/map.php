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
    $e3 = $db->prepare("SELECT 名称, 住所, X(位置), Y(位置), 海抜, 収容人数, ROUND(GLENGTH(GEOMFROMTEXT(CONCAT('LineString(', ?, ' ', ?, ', ', X(位置), ' ', Y(位置), ')'))) * 112.12 * 1000 ) AS '直線距離' FROM earea 
    WHERE 地震災害 LIKE ? AND 暴風災害 LIKE ? AND 水害 LIKE ? AND その他 LIKE ? AND 津波災害 LIKE ? AND ROUND(GLENGTH(GEOMFROMTEXT(CONCAT('LineString(', ?, ' ', ?, ', ', X(位置), ' ', Y(位置), ')'))) * 112.12 * 1000  ) <= ?*1000 ORDER BY 直線距離 LIMIT 13;");

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
    $dbCount = 0;
    while($result = $e3->fetch(PDO::FETCH_ASSOC)) {
        $ename[$row] = $result['名称'];
        $point[$row] = $result['住所'];
        $pointX[$row] = $result['X(位置)'];
        $pointY[$row] = $result['Y(位置)'];
        $hig[$row] = $result['海抜'];
        $human[$row] = $result['収容人数'];
        $dbCount++;
        $row++;
    }

    if($dbCount == 0){
        header( "Location: none.php" ) ;
        exit;
    } else {
    $_SESSION['ename'] = $ename;
    $_SESSION['point'] = $point;
    $_SESSION['pointX'] = $pointX;
    $_SESSION['pointY'] = $pointY;
    $_SESSION['hig'] = $hig; 
    $_SESSION['human'] = $human; 
    
    $_SESSION['gpsx'] = $gpsx; 
    $_SESSION['gpsy'] = $gpsy; 
    }

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
            width: 1200px;
            height: 600px;
        }
    </style>
  </head>
  <body>
  	<center>
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
            <?php $mc = 0; 
              $rcol = array("#0000ff", "#2ecc40", "#dc143c");
            ?>
            <?php while ($mc < 3 && isset($ename[$mc])) { ?>
                var njs = <?php echo json_encode($pointX[$mc]); ?>;
                var ejs = <?php echo json_encode($pointY[$mc]); ?>;
                var eename = <?php echo json_encode($ename[$mc]); ?>;
                var rcolor = <?php echo json_encode($rcol[$mc]); ?>;
            map.drawRoute({
              origin: [lat, lng],//出発点の緯度経度
              destination: [njs, ejs],//目標地点の緯度経度
              travelMode: 'walking',//モード(walking,driving)
              strokeColor: rcolor,//ルートの色
              strokeOpacity: 0.8,//ルートの透明度
              strokeWeight: 4//ルート線の太さ
            });
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
    </center>
    <!-- 避難所名表示 -->
      <div class="container">
        <div class="row">

        <?php $lc = 0; 
              $color = array("info", "success", "danger");
        ?>
        <?php while ($lc < 3 && isset($ename[$lc])) { ?>
            
        <!-- 避難所情報 -->
          <div class="col-xs-9 col-md-9 col-lg-9 center-block bg-<?php echo $color[$lc]; ?>" style="text-align:center; font-size:30px;"><?php echo $ename[$lc]; ?></div>
          <div class="col-xs-3 col-md-3 col-lg-3">
          <div><a href="shousai.php?gpsx=<?php echo $gpsx; ?>&gpsy=<?php echo $gpsy; ?>&ename=<?php echo $ename[$lc]; ?>&point=<?php echo $point[$lc]; ?>&pointX=<?php echo $pointX[$lc]; ?>&pointY=<?php echo $pointY[$lc]; ?>&hig=<?php echo $hig[$lc]; ?>&human=<?php echo $human[$lc]; ?>" type="button" class="btn btn-link btn-lg" role="button">詳細</a></div>
          </div>
        <?php $lc ++; ?>
        <?php } ?>
        </div>
      </div>

	  <center>
        <?php if($row > 3)  { ?>
        <form action="addmore.php" method="get">
        <input type="submit" value="さらに表示する(最大10件)"></button>
        <?php } ?>
        <p><a href="search.php" type="button" class="btn btn-link btn-lg" role="button">検索画面に戻る</a></p>
      </center>
        </body>
</html>
