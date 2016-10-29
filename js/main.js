(function() {

    getPosition();
   
    function sendAjax(latitude, longitude) {
        $.ajax({
                'url': 'http://localhost/phpjspoz1/apigeo',
                'type': 'POST',
                'context': this,
                'data': { latitude: latitude.toString(), longitude: longitude.toString() },

                'success': function(data) {  
                    $('.main-container').prepend(data);     
                }
        });        
    }
        
    function getPosition() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(getCoordinates);
        }   else {
            console.log('geolocation is not supported');
        }
    };   
    
    function getCoordinates(position){

        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        
        sendAjax(latitude, longitude);
        
    };
    
})();