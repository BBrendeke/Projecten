$(function(){
    $('[data-countdown]').each(function() {
        let $this = $(this), finalDate = $(this).data('countdown');
        let id = $this.attr('id');
        $this.countdown(finalDate, function(event) {
            let dateString = event.strftime('%D dagen en %H:%M:%S');
            if (dateString === "00 dagen en 00:00:00") {
                $.ajax({
                    type: 'POST',
                    url: 'test.php',
                    data: {
                        id: id,
                        action: 'endAuction'
                    },
                    success: function (response) {
                        console.log(response);
                    }
                });
            }
            $this.html(dateString);
        });
    });
});