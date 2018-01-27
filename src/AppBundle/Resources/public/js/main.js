$(document).ready(function () {
    $('input[type=radio]').on('change', function() {
        var radio = $(this).val();
        $.ajax({
            type: "POST",
            url: $(this).data('url'),
            data: {"radio" : radio},
            dataType: 'json',
            success: function(data) {
                $('#specification').removeAttr('hidden');
                $('#buyNow').removeAttr('hidden');
                $('#vendoreCode').text(data.vendorCode);
                $('#color').text(data.color)
                $('#size').text(data.size)
            },
            error: function() {
                console.log('it broke');
            }
        });
    });
});