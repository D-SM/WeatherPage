(function() {

    getPosition();
   
    function sendAjax(latitude, longitude) {
        $.ajax({
                'url': 'http://localhost/phpjspoz1/apigeo',
                'type': 'POST',
                'context': this,
                'data': { latitude: latitude.toString(), longitude: longitude.toString() },

                'success': function(data) {  
                    $('body').append(data);
                    console.log('success');   
                    console.log(data);        
                },

                'error': function (xhr, status, error) {
                    my_error = {
                        'response': xhr.responseJSON,
                        'status': xhr.status,
                        'statusText': xhr.statusText
                    };
                    console.log(my_error);
                },

                'complete': function () {
                    console.log('AJAX complete');                
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
        console.log(latitude);
        console.log(longitude);
        
        sendAjax(latitude, longitude);
        
    };
    
})();