(function() {
            
    function sendAjax(dayNumber) {
        $.ajax({
                'url': 'http://localhost/phpjspoz1/forecast',
                'type': 'POST',
                'context': this,
                'data': { dayNumber: dayNumber },

                'success': function(data) {  
                    $('.main-container').append(data);     
                }
        });        
    }
    
    sendAjax(3);
})();