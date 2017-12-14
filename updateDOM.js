$(function () {


    $("#showdata").click(function () {
        $.each(quarterbacks, function (index, value) {
            alert(index + ": " + value)
        });
    });
//        alert('button clicked');
//
//
//        $('#test').empty();
//        $.each(quarterbacks, function (index, value) {
//            $('#test').append('<p>' + index + ":" + value + '</p>');
//        });
//    });
//


});
