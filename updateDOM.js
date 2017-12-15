$(document).ready(function () {

            fillData = function () {

                $.ajax({
                    method: "GET",
                    url: "getPlayers.php",

                }).done(function (data) {

                        var result = JSON.parse(data);

                        var string = '<table><tr><th>First Name</th><th>Last Name</th><th>Position</th><th>Team</th><th>Opponent</th><th>Salary</th><th>CPP</th><th>Projected Points</th></tr>';

                       $.each(result, function (key, value){
                          string += "<tr>";
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
                          string+= "</tr>";
                        });
                        string += '</table>';
                        $("#records").html(string);
                    });
            }

          optimize = function() {

            $.ajax({
              method: "GET",
              url: "otimize.php",
            }).done(function(data) {
              var result = JSON.parse(data);

              var string = '<table><tr><th>First Name</th><th>Last Name</th><th>Position</th><th>Salary</th><th>Projected Points</th></tr>';
            });
          }
});
