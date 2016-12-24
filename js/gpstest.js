	function geoFindMe() {
  var output = document.getElementById("out");


  if (navigator.geolocation){

  function success(position) {
    var latitude  = position.coords.latitude;
    var longitude = position.coords.longitude;

    //output.innerHTML = '<p>Latitude is ' + latitude + '° <br>Longitude is ' + longitude + '°</p>';


    var opts = {
    zoom: 15,
    center: new google.maps.LatLng(latitude,longitude)
  	};

 	var map = new GMap2(document.getElementById("map"));
 	var latlang = new GLatLng(latitude,longitude);
	map.setCenter(latlang, 15);

	var markla = new GLatLng(latitude,longitude);
	var marker = new GMarker(markla);
  	map.addOverlay(marker);

	var slatlng = new GLatLng(latitude,longitude);
    var option = { latlng:slatlng };
    var scontainer = document.getElementById("street");
    var panorama = new GStreetviewPanorama(scontainer, option);
  };

  function error(error) {
    var errorInfo = [
				"原因不明のエラーが発生しました…。" ,
				"位置情報の取得が許可されませんでした…。" ,
				"電波状況などで位置情報が取得できませんでした…。" ,
				"位置情報の取得に時間がかかり過ぎてタイムアウトしました…。"
			] ;

			// エラー番号
			var errorNo = error.code ;

			// エラーメッセージ
			var errorMessage = "[エラー番号: " + errorNo + "]\n" + errorInfo[ errorNo ] ;

			// アラート表示
			alert( errorMessage ) ;

			// HTMLに書き出し
			document.getElementById("result").innerHTML = errorMessage;

  };

  //output.innerHTML = "<p>Locating…</p>";

  navigator.geolocation.getCurrentPosition(success, error);




}

	// 対応していない場合
	else
	{
		// エラーメッセージ
		var errorMessage = "お使いの端末は、GeoLacation APIに対応していません。" ;

		// アラート表示
		alert( errorMessage ) ;

		// HTMLに書き出し
		document.getElementById( 'result' ).innerHTML = errorMessage ;
	}
}
