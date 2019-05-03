$(document).ready(function(){

    tinymce.init({
        selector: ".editor",theme: "modern",width: 680,height: 300,
        relative_urls: false,
        plugins: [
             "advlist autolink link image lists charmap print preview hr anchor pagebreak",
             "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
             "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
       ],
       toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
       toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
       image_advtab: true ,
       
       external_filemanager_path:"{{asset('plugins/tinymce/js/tinymce/plugins/responsivefilemanager/')}}/",
       filemanager_title:"Choose an Image" ,
       external_plugins: { "filemanager" : "{{asset('plugins/tinymce/js/tinymce/plugins/responsivefilemanager/plugin.min.js')}}"}
    });
      
    //tinymce readOnly
    tinymce.init({
      selector:'#mceNoEditor',
      readonly : 1
    });

    //alert
    $(".delete").on("submit", function(){
        return confirm("Do you want to delete this item?");
      });
    $(".update").on("submit", function(){
        return confirm("Do you want to update this item?");
    });
    $(".insert").on("submit", function(){
        return confirm("Are you sure?");
    });
    //sortable
    $(function() {
      $( "#sortable" ).sortable({
        placeholder: "ui-state-highlight"
      });
      $( "#sortable" ).disableSelection();
    });
    $(function(){
      $('#ip_address').ipAddress();
    });

    //PieChart
    var url = window.location.href;
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawPieChart);
    function drawPieChart() {

      var record={!! json_encode($applicant) !!};
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Status');
      data.addColumn('number', 'Total');
      for(var k in record){
        var v = record[k];
        data.addRow([k,v]);
      }
      var options = {
        title: 'Applicant Status',
        is3D: true,
      };
      var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
      chart.draw(data, options);
      $(document).on("change","#time",function(){
        var timeOption = $(this).val();
        $.ajax({
          url: url+"/status/"+timeOption,
          type: "get",
          success:function(response){
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Status');
            data.addColumn('number', 'Total');
            for(var k in response){
              var v = response[k];
              data.addRow([k,v]);
            }
            var options = {
              title: 'Applicant Status',
              is3D: true,
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
              }
        })
      })
    }

    //chart line
    google.charts.load("current", {'packages':["line"]});
    google.charts.setOnLoadCallback(drawLineChart);
    function drawLineChart() {
      var record={!! json_encode($bar) !!};
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Month Year');
      data.addColumn('number', 'Interview Process');
      data.addColumn('number', 'Rejected');
      data.addColumn('number', 'Unread');
      data.addColumn('number', 'Hiring');
      data.addColumn('number', 'Short Listed');
      data.addColumn('number', 'Failed Interview');
      data.addColumn('number', 'Offering');
      data.addColumn('number', 'Active File');
      data.addColumn('number', 'Refuse Offering');
      data.addColumn('number', 'Trash');
      data.addColumn('number', 'Cancel Join');
      data.addColumn('number', 'Not Show');
      for(var k in record){
        var v = record[k];
        data.addRow([k,v.Interview_Process,v.Rejected,v.Unread,v.Hiring,v.Short_Listed,v.Failed_Interview,v.Offering,v.Active_File,v.Refuse_Offering,v.Trash,v.Cancel_Join,v.Not_Show]);
      }
      var options = {
        chart:{
          title: 'Applied Applicant',
          subtitle: 'Applied Applicant / Month',
        }
      };
      var chart = new google.charts.Line(document.getElementById('columnchart_material'));
      chart.draw(data,  google.charts.Line.convertOptions(options));
    }

    // carousel
    $('.owl-carousel').owlCarousel({
      loop: true,
      margin: 10,
      nav: true,
      dots: false,
      navText: [
            "<i class='fa fa-chevron-left' aria-hidden='true'>",
            "<i class='fa fa-chevron-right' aria-hidden='true'>"
           ],
      responsive:{
          0:{
              items:1
          },
          600:{
              items:3
          },
          1000:{
              items:5
          }
      }
    });

    //template email
    $(document).on("change",".template",function(){
      var url = window.location.href.split('?')[0];
      var template = $(this).val();
      var queryString = window.location.search;
      console.log(queryString);
      console.log(url+"/template/"+template);
      $.ajax({
        url: url+"/template/"+template,
        type: "get",
        dataType: "HTML",
        success:function(response){
          $("#content").html(response);
          tinymce.get("content").getBody().innerHTML = response;
          console.log(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
         // What to do if we fail
        }
      });
    });

    //modal details
    // When the user clicks on <span> (x), close the modal
    $(document).on("click",".close-detail",function() {
       $("#myModal").css("display","none");
       tinymce.remove();
    })
    // When the user clicks anywhere outside of the modal, close it
    $(document).on("click",window,function(event) {
      if (event.target.classList[0] == "modal-detail") {
          $("#myModal").css("display","none");
      }
    });
    $(document).on("click",".open-detail", function() {
      var id = $(this).data('id');
      var status = $(this).data('status');
      var filter = $(this).data('filter');
      console.log('{{url("admin/preferences/applicants/detail/")}}'+filter+'/' + id+'-'+status);
      $.get('{{url("admin/preferences/applicants/detail/")}}'+filter+'/' + id+'-'+status, function( data ) {
        $(".modal-container").html(data);
        $("#myModal").css("display","block");
        tinymce.init({
            selector: "#content",
            width:      '100%',
            height:     270,
            plugins:    [ "anchor link" ],
            statusbar:  false,
            menubar:    false,
            toolbar:    "alignleft aligncenter alignright alignjustify",
            rel_list:   [ { title: 'Lightbox', value: 'lightbox' } ]
        });
      });
      return false;
    });

    // checkbox
    $('#select-all').click(function(event) {   
      if(this.checked) {
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
      }
      else{
        $(':checkbox').each(function() {
              this.checked = false;                        
          });
      }
    });
    $(document).on('change', '.cb', function(){
      if ($(this).not(':checked')) {
        $("#select-all").prop('checked', false);
      }
    });

    $('.timer').countTo();

    $(document).on("change","#to",function(){
      var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
      if(!emailReg.test($(this).val()) || $(this).val() == ""){
        inputEmailFlag = 0;
        $(this).css("border-bottom","3px solid #faa");
        $(".to").css("opacity","1");
      }
    });

    $(document).on("change","#cc",function(){
      var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
      if(!emailReg.test($(this).val()) || $(this).val() == ""){
        inputEmailFlag = 0;
        $(this).css("border-bottom","3px solid #faa");
        $(".cc").css("opacity","1");
      }
    });

    $(document).on("submit","#applyForm",function(event){
        event.preventDefault();

        var to = $("#to");
        var cc = $("#cc");
        var subject = $("#subject");
        var content = $("#content")

        if(to.val() == ""){
          to.css("border-bottom","3px solid #faa");
          event.preventDefault();
        }
        if(subject.val() == ""){
          subject.css("border-bottom","3px solid #faa");
          event.preventDefault();
        }
        if(content.val() == ""){
          content.css("border-bottom","3px solid #faa");
          event.preventDefault();
        }
        if(to.val() != "" && subject != 0 && content != 0){
          var formData = new FormData($('#applyForm')[0]);
          var formURL = $(this).attr("action");
          $.ajax({
            url:formURL,
            type:"POST",
            data: formData,
            contentType:false,
            cache:false,
            processData:false,
            success:function(data, textStatus, jqXHR) 
                {
                  console.log(data);
                    if(data == 'success'){
                      alert("Email Has Been Delivered! Please Change Applicant's Status If You Have Not Change It.");
                    }
                    if(data == 'fail'){
                      alert("Sorry, There is a Problem while Sending the Email");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                    //if fails      
                } 

          });
          return false;
        }
      });
  });