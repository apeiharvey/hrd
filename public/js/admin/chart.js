$(document).ready(function(){
  var url = window.location.href;
  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {

    var record={!! json_encode($applicant) !!};
    console.log(record);
    // Create our data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Status');
    data.addColumn('number', 'Total');
    for(var k in record){
      var v = record[k];
      data.addRow([k,v]);
      console.log(v);
    }
    var options = {
      title: 'Applicant Status',
      is3D: true,
    };
    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
    chart.draw(data, options);
    $(document).on("change","#time",function(){
      var timeOption = $(this).val();
      console.log(url+"/status/"+timeOption);
      $.ajax({
        url: url+"/status/"+timeOption,
        type: "get",
        success:function(response){
          // Create our data table.
          var data = new google.visualization.DataTable();
          data.addColumn('string', 'Status');
          data.addColumn('number', 'Total');
          for(var k in response){
            var v = response[k];
            data.addRow([k,v]);
            console.log(v);
          }
          var options = {
            title: 'Applicant Status',
            is3D: true,
          };
          var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
          chart.draw(data, options);
          },
          error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
              console.log(JSON.stringify(jqXHR));
              console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            }
      })
    })
  }
})