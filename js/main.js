(function() {
    
    function getPosition() {
        var latitude, longitude;
        
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

