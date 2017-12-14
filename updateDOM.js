$(function () {

    $("#showdata").click(function () {
        alert('button clicked');

        $('#test').empty();
        $.each(QBs, function (index, value) {
            $('#test').append('<p>' + index + ":" + value + '</p>');
        });
    });



});
