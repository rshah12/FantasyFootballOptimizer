$(document).ready(function () {

            fillData = function () {

                $.ajax({
                    method: "GET",
                    url: "getPlayers.php",

                }).done(function (data) {

//                        var result = $.parseJSON(data);

                        var string = '<table><tr><th>#</th><th>Name</th><th>Email</th></tr>';

                        //from result create a string of data and append to the div
//                        $.each(data, function (key, value)
                                alert(data.length);
                               for (var i = 0; i < data.length; i++) {

                                    var value = data[i];
                                   alert(value);
                            string += "<tr>"
                            "<td>" + value['fname'] + "</td>"
                            "<td>" + value['lname'] + "</td>"
                            "<td>" + value['pos'] + "</td>"
                            "<td>" + value['team'] + "</td>"
                            "<td>" + value['opp'] + "</td>"
                            "<td>" + value['sal'] + "</td>"
                            "<td>" + value['cpp'] + "</td>"
                            "<td>" + value['projection']+"</td>"
                            "<td>" + value['uses']+"</td>"
                            "</tr>";

                        };

                        string += '</table>';

                        $("#records").html(string);



                    });

                }
});
