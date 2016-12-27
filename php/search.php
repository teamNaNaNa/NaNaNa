<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php 
    $url = "./search.php"; 
    ?>

    <title>避難経路検索</title>
    <!-- BootstrapのCSS読み込み -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="../js/bootstrap.min.js"></script>

    <script>
		var locmes;
		<?php if (isset($_GET['locset'])) { ?>
			locmes = "現在地の座標取得に成功しました！以下のフォームから災害の種類と、避難可能な距離を指定してください";
		<?php  } else { ?>
			locmes = "現在地の座標を取得しています。これには少し時間がかかります。";
    	navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
    	function successCallback(position) {    /* 成功時の処理 */
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        if(latitude){   /* 変数latitudeに値が入ってた時 */
            location.href = "<?php echo $url; ?>?locset=1&lati=" + latitude + "&long=" + longitude + "&map=https://maps.google.com/maps?q=" + latitude + "," + longitude;
        }
    	}
    	function errorCallback(error) { /* 失敗時の処理 */
        location.href = "<?php echo $url; ?>?alart=on";
    	}
		<?php } ?>
    </script>

		<script type="text/javascript">
				function check() {
						if ((document.forms.de.j1.checked) ||
								(document.forms.de.j2.checked) ||
								(document.forms.de.j3.checked) ||
								(document.forms.de.j4.checked) ||
								(document.forms.de.j5.checked)) {
								window.confirm('検索します。よろしいですか？');
								return true;
							} else {
								alert("検索条件を指定してください！");
								return false;
						}
				}
		</script>

  </head> 
  
    <body>
    <header style="background-color:white">
      <div class="jumbotron">
	<div class="container">
	  <center>
            <h1>避難経路検索</h1>
	  </center>
	</div>
      </div>
    </header>

    <?php
        session_start();
				if (isset($_GET['lati'])){
				$_SESSION['gpsx'] = $_GET['lati'];
				$_SESSION['gpsy'] = $_GET['long'];
				}
    ?> 

	  <center>
						<h4><script>document.write(locmes);</script></h4>
						<?php if (isset($_GET['lati'])) { ?>
						あなたの現在地 : 北緯<?php echo $_GET['lati']?> 東経<?php echo $_GET['long']?>
						<div><a href="search.php" type="button" class="btn btn-link btn-lg" role="button">現在地座標を再取得する</a></div>
						<?php } ?>
	  </center>
	<form action="map.php" id="de" method="get">
    <div class="container-fluid">
      <div class="row">
	<div class="col-sm-3" style="background-color:white;"></div>
	<div class="col-sm-3" style="background-color:white;">
	  <!-- Split button -->
	  <div class="btn-group">
	    <button class="btn btn-default btn-lg dropdown-toggle" type="button" data-toggle="dropdown">
	      <span id="visibleValue">避難所検索範囲 ▼</span></button>
	     <ul class="dropdown-menu" role="menu" hiddenTag="#hiddenValue" visibleTag="#visibleValue">
	      <li><a href="javascript:void(0)" value="1km ▼">1km</a></li>
	      <li><a href="javascript:void(0)" value="3km ▼">3km</a></li>
	      <li><a href="javascript:void(0)" value="5km ▼">5km</a></li>
	      <li><a href="javascript:void(0)" value="10km ▼">10km</a></li>
	    </ul>
	    <input type="hidden" id="hiddenValue" name = "rad" value="">
	  </div>
	  <script type="text/javascript">
	    $(function(){
	    $('.dropdown-menu a').click(function(){
	    //反映先の要素名を取得
	    var visibleTag = $(this).parents('ul').attr('visibleTag');
	    var hiddenTag = $(this).parents('ul').attr('hiddenTag');
	    //選択された内容でボタンの表示を変える
	    $(visibleTag).html($(this).attr('value'));
	    //選択された内容でhidden項目の値を変える
	    $(hiddenTag).val($(this).attr('value'));
	    })
	    })
	</script>
	</div>


	<div class="col-sm-4" style="background-color:white;">
	<div class="checkbox">
	  <label>　<input type="checkbox" id = "j1" name="zisin" value="1"> 地震災害　</label>
	  <br>
	  <label>　<input type="checkbox" id = "j2" name="suigai" value="1"> 水害 </label>
	  <br>
	  <label>　<input type="checkbox" id = "j3" name="bouhuu" value="1"> 暴風災害 </label>
	  <br>
	  <label>　<input type="checkbox" id = "j4" name="tsunami" value="1"> 津波災害　</label>
	  <br>
	  <label>　<input type="checkbox" id = "j5" name="etc" value="1"> その他 　</label>
	</div>

 	<div>
	  <input type="submit" class="btn btn-primary" value="検索" onClick='return check();'></button>
	</form>
	</div>

	</div>
	<div class="col-sm-2" style="background-color:white;"></div>
      </div>
    </div>
    <footer style="background-color:white"></footer>
  </body>
</html>
