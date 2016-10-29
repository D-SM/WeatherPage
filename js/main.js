(function() {
    var latitude, longitude;
    getPosition();
    
    $.ajax({
            'url': 'http://localhost/phpjspoz1/apigeo',
            'type': 'POST',
            'context': this,
//            'headers': {
//            },
            'data': JSON.stringify({
                'latitude': latitude, 
                'longitude': longitude
            }),

            'success': function(data) {  
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
        
    function getPosition() {
        
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position){
                var coordinates = [];
                
                coordinates['latitude'] = position.coords.latitude;
                coordinates['longitude'] = position.coords.longitude;
                
                return coordinates;
            });
        }   else {
            console.log('geolocation is not supported');
        }

    };        
        
        
})();