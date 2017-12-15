$(document).ready(function () {

            fillData = function () {

                $.ajax({
                    method: "GET",
                    url: "getPlayers.php",

                }).done(function (data) {

                        var result = JSON.parse(data);

                        var string = '<table><tr><th>#</th><th>Name</th><th>Email</th></tr>';

                        //from result create a string of data and append to the div
                       $.each(result, function (key, value){
                                //alert(result.length);
                                //alert(result)
                                //alert(value);
                                //alert(key);
                          //foreach(var i = 0; i < result.length; i++) {

                                //var value = result[i].toString();
                                    //alert(value);
                                   // alert(data);
                          string += "<tr>";
                          //$.each(value, function(key, value){
                            string+=
                            "<td>" + value['fname'] + "</td>"+
                            "<td>" + value['lname'] + "</td>"+
                            "<td>" + value['pos'] + "</td>"+
                            "<td>" + value['team'] + "</td>"+
                            "<td>" + value['opp'] + "</td>"+
                            "<td>" + value['sal'] + "</td>"+
                            "<td>" + value['cpp'] + "</td>"+
                            "<td>" + value['projection']+ "</td>"+
                            "<td>" + value['uses']+ "</td>";
                          //});

                          string+= "</tr>";
                        });

                        string += '</table>';

                        $("#records").html(string);



                    });

                }
});
