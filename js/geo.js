avigator.geolocation.getCurrentPosition(successCallback, errorCallback);

function successCallback(position) {    /* 成功時の処理 */
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    if(latitude){   /* 変数latitudeに値が入ってた時 */
        location.href = "<?php echo $url; ?>?lati=" + latitude + "&long=" + longitude;
    }
}
 
function errorCallback(error) { /* 失敗時の処理 */
    location.href = "<?php echo $url; ?>?alart=on";
}
