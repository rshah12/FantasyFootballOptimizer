$(document).ready(function () {

            fillData = function () {

                $.ajax({
                    method: "GET",
                    url: "getPlayers.php",

                }).done(function (data) {

                        var result = JSON.parse(data);

                        var string = '<table><tr><th>First Name</th><th>Last Name</th><th>Position</th><th>Team</th><th>Opponent</th><th>Salary</th><th>CPP</th><th>Projected Points</th></tr>';

                       $.each(result, function (key, value){
                          string += "<tr>"+
                            "<td>" + value['fname'] + "</td>"+
                            "<td>" + value['lname'] + "</td>"+
                            "<td>" + value['pos'] + "</td>"+
                            "<td>" + value['team'] + "</td>"+
                            "<td>" + value['opp'] + "</td>"+
                            "<td>" + value['sal'] + "</td>"+
                            "<td>" + value['cpp'] + "</td>"+
                            "<td>" + value['projection']+ "</td>"+
                            "</tr>";
                        });
                        string += '</table>';
                        $("#records").html(string);
                    });
            }

          optimize = function() {
            $.ajax({
              method: "GET",
              url: "optimize.php",
            }).done(function(data) {
              var result = JSON.parse(data);
              var lineups = [];
              var string = "";

              $.each(result, function (key, value){
                string+= '<table><tr><th>First Name</th><th>Last Name</th><th>Position</th><th>Salary</th><th>Projected Points</th></tr>'+
                   "<tr>"+"<td>" + value['QBfname'] + "</td>"+"<td>" + value['QBlname'] + "</td>"+"<td>" + value['QBpos'] + "</td>"+"<td>" + value['QBsal'] + "</td>"+"<td>" + value['QBprojection']+ "</td>"+"</tr>"+
                   "<tr>"+"<td>" + value['RBfname'] + "</td>"+"<td>" + value['RBlname'] + "</td>"+"<td>" + value['RBpos'] + "</td>"+"<td>" + value['RBsal'] + "</td>"+"<td>" + value['RBprojection']+ "</td>"+"</tr>"+
                   "<tr>"+"<td>" + value['RB2fname'] + "</td>"+"<td>" + value['RB2lname'] + "</td>"+"<td>" + value['RB2pos'] + "</td>"+"<td>" + value['RB2sal'] + "</td>"+"<td>" + value['RB2projection']+ "</td>"+"</tr>"+
                   "<tr>"+"<td>" + value['WRfname'] + "</td>"+"<td>" + value['WRlname'] + "</td>"+"<td>" + value['WRpos'] + "</td>"+"<td>" + value['WRsal'] + "</td>"+"<td>" + value['WRprojection']+ "</td>"+"</tr>"+
                   "<tr>"+"<td>" + value['WR2fname'] + "</td>"+"<td>" + value['WR2lname'] + "</td>"+"<td>" + value['WR2pos'] + "</td>"+"<td>" + value['WR2sal'] + "</td>"+"<td>" + value['WR2projection']+ "</td>"+"</tr>"+
                   "<tr>"+"<td>" + value['WR3fname'] + "</td>"+"<td>" + value['WR3lname'] + "</td>"+"<td>" + value['WR3pos'] + "</td>"+"<td>" + value['WR3sal'] + "</td>"+"<td>" + value['WR3projection']+ "</td>"+"</tr>"+
                   "<tr>"+"<td>" + value['TEfname'] + "</td>"+"<td>" + value['TElname'] + "</td>"+"<td>" + value['TEpos'] + "</td>"+"<td>" + value['TEsal'] + "</td>"+"<td>" + value['TEprojection']+ "</td>"+"</tr>"+
                   "<tr>"+"<td>" + value['Kfname'] + "</td>"+"<td>" + value['Klname'] + "</td>"+"<td>" + value['Kpos'] + "</td>"+"<td>" + value['Ksal'] + "</td>"+"<td>" + value['Kprojection']+ "</td>"+"</tr>"+
                   "<tr>"+"<td>" + value['Dfname'] + "</td>"+"<td>" + value['Dlname'] + "</td>"+"<td>" + value['Dpos'] + "</td>"+"<td>" + value['Dsal'] + "</td>"+"<td>" + value['Dprojection']+ "</td>"+"</tr>"+
                   "<tr>"+"<td>" + "Total" + "</td>"+"<td>" + "For" + "</td>"+"<td>" + "Lineup:" + "</td>"+"<td>" + value['salary'] + "</td>"+"<td>" + value['projection']+ "</td>"+"</tr>"+
                   '</table>';
                lineups.push(string);
                string = "";
               });
               $("#Lineups").html(lineups[0]);
            });
          }
});
