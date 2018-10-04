(function($) {
    $(document).ready(function() {
        console.log('Ready to work');
        var typed_text = $('#typed_text'),
            output_text = $('#output_text');
        console.log(typed_text);
        $('#typed_text').change(function(event) {
            console.log('Changing input');
        })
    })
})(jQuery);