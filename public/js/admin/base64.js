var delay = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();

$(document).ready(function(){
  //Config
  $( document ).ajaxStart(function() {
    $( ".loading-bar" ).slideDown();
  });
   $( document ).ajaxStop(function() {
    $( ".loading-bar" ).slideUp();
  });
  $.ajaxSetup({
    beforeSend: function( xhr ) {
      xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))
    }
  });

  //Function
  $.extend({
    root(){
        return $('meta[name="root_url"]').attr('content');
    },cur_url_whash(){
      return window.location.origin + window.location.pathname;
    },redirect(url){
      $(location).attr('href',url);
    },postformdata(url,formdata){
      data = $.ajax({
              url: url,
              type: "POST",
              data: formdata,
              contentType: false, 
              cache: false,
              processData:false,
          });
          return data;
    },postdata(url,formdata){
      data = $.ajax({
              url: url,
              type: "POST",
              data: formdata
          });
          return data;
    },getdata(url){
      data = $.ajax({
              url: url,
              type: "GET"
          });
          return data;
    },base64image(inputElement){
      var deferred = $.Deferred();
      var files = inputElement;
      if (files && files[0]) {
        var fr= new FileReader();
        fr.onload = function(e) {
          deferred.resolve(e.target.result);
        };
        fr.readAsDataURL( files[0] );
      } else {
        deferred.resolve(undefined);
      }
      return deferred.promise();
    },datepickers: function(){
      $('.datepicker').bootstrapMaterialDatePicker({
        format: 'DD-MM-YYYY',
        clearButton: false,
        weekStart: 1,
        time: false
      });
    },checkFileSize(files,size){
      var file_size    = files.size;
      if(file_size > size){
        return false;
      }else{
        return true;
      }
    },checkFileExt(files,ext){
      var file_ext         = files.name.split('.')[1].toLowerCase();
      if($.inArray(file_ext,ext) > -1){
        return true;
      }else{
        return false;
      }
    },notify_auto(){
      var notify_alert = $('.notify-alert');
      if(notify_alert.length > 0){
        $.notify({
          message: notify_alert.data('message')
        },{
          type: notify_alert.data('type'),
          newest_on_top: true,
          animate:{
            enter: 'animated zoomInRight',
            exit: 'animated zoomOutRight'
          }
        });
      }
    },notify_manual(message,type){
      $.notify({
        message: message
      },{
        type: type ? type : 'danger',
        newest_on_top: true,
        animate:{
          enter: 'animated zoomInRight',
          exit: 'animated zoomOutRight'
        }
      });
    },prompt_manual(callback){
      swal({
        title: "Are you sure?",
        text: "You will not be able to revert the change",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#4CAF50",
        confirmButtonText: "Yes, process this!",
        cancelButtonText: "No, cancel please!",
        closeOnConfirm: false,
        closeOnCancel: true
      }, function (isConfirm) {
        if (isConfirm) {
          swal({
            title: "Information",
            text: "submit Data",
            type: "success",
            timer: 2000,
            showConfirmButton: false
          });
          callback();
        }
      });
    },initTooltips(){
      $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
      });
    },datatablebuilder(editable){
      if(editable){
        var action  = ['copy', 'csv', 'excel', 'pdf', 'print'];
      }else{
        var action  = [];
      }
      $('.datatable-builder').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: action
      });
    },scrolltop(body){
      $(body).animate({ scrollTop: 0 }, 'slow');
    }, select2(){
      $(".select2").select2({
        placeholder: "--Select One--"
      });
    },format_money(value,decPlaces, thouSeparator, decSeparator){
      var n = value,
      decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
      decSeparator = decSeparator == undefined ? "." : decSeparator,
      thouSeparator = thouSeparator == undefined ? "," : thouSeparator,
      sign = n < 0 ? "-" : "",
      i = parseInt(n = Math.abs(+n || 0).toFixed(decPlaces)) + "",
      j = (j = i.length) > 3 ? j % 3 : 0;
      return sign + (j ? i.substr(0, j) + thouSeparator : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thouSeparator) + (decPlaces ? decSeparator + Math.abs(n - i).toFixed(decPlaces).slice(2) : "");
    }
  });
  $.notify_auto();
  $.initTooltips();

  $('form').submit(function(){
    var that    = this;
    var action  = $(that).data('action');
    if(action != undefined){
      if(action == 'prompt'){
        swal({
          title: "Are you sure?",
          text: "You will not be able to revert the change",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#4CAF50",
          confirmButtonText: "Yes, process this!",
          cancelButtonText: "No, cancel please!",
          closeOnConfirm: false,
          closeOnCancel: true
        }, function (isConfirm) {
          if (isConfirm) {
            swal({
              title: "Information",
              text: "submit Data",
              type: "success",
              timer: 2000,
              showConfirmButton: false
            });
            that.submit();
          }
        });
      }
      return false;
    }
  });

  $(document).on('click','button,a',function(){
    var that    = this;
    var action  = $(that).data('action');
    if(action != undefined){
      if(action == 'prompt'){
        swal({
          title: "Are you sure?",
          text: "You will not be able to revert the change",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#4CAF50",
          confirmButtonText: "Yes, process this!",
          cancelButtonText: "No, cancel please!",
          closeOnConfirm: false,
          closeOnCancel: true
        }, function (isConfirm) {
          if (isConfirm) {
            swal({
              title: "Information",
              text: "submit Data",
              type: "success",
              timer: 2000,
              showConfirmButton: false
            });
          }
        });
        return false;
      }
    }
  });

  //upload Single Image
  $(document).on('change','.upload-image',function(res){
    if(res){
      name_method = $(this).attr('name');
      size_method = $(this).data('size');
      files       = this.files;
      ext         = files[0].name.split('.')[1].toLowerCase();
      size        = files[0].size;
      allow_ext   = ['jpg','gif','png','jpeg'];
      if($.inArray(ext,allow_ext) > -1){
        if(size <= size_method){
          $.base64image(files).done(function(res){
            file = "<img src='"+res+"' class='img-responsive thumbnail image-thumbnail'>";
            $('input[name="remove-single-'+name_method+'"]').val('n');
            $('.single-'+name_method).html(file);
          });
        }else{
          $(this).val(null);
          $.notify_manual('File size is to large','danger');
        }
      }else{
        $(this).val(null);
        $.notify_manual('File must be image','danger');
      }
    }
  });

  //Remove Single Image
  $(document).on('click','.remove-single-image',function(){
    a = $(this).data('id');
    b = $(this).data('name');
    $('input[name="remove-'+a+'-'+b+'"]').val('y');
    $('.'+a+'-'+b+' > img').attr('src',$.root()+'components/both/images/web/none.png');
    $('input[name="'+b+'"]').val(null);
  });

  //Change Status display in index
  $(document).on('click','.ajax-update',function(e){
    a = $(this).attr('href');
    b = this;
    $.postdata(a,'').done(function(data){
      if(data != 'no_access'){
        $(b).replaceWith(data);
      }
    });
    e.preventDefault();
  });

  //Submit searching datagrid
  $(document).on('click','.submit-search',function(){
    a = '<input type="hidden" name="q" value="s">';
    $(".search-data,select[data-class=search-data]").each(function(i) {
      a += '<input type="hidden" name="'+$(this).attr('name')+'" value="'+$(this).val()+'">';
    });
    $('#builder_form').append(a).submit();
  });

  //Sorting data datagrid
  $(document).on('click','.sorting-data',function(){
    a = $(this).data('orderby');
    b = window.location.href.indexOf('?');
    c = '';
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++){
      hash = hashes[i].split('=');
      vars.push(hash[0]);
      vars[hash[0]] = hash[1];
    }
    var cek = jQuery.inArray( "orderdata", vars );
    if (b > -1){
      if (cek > -1){
        if (vars['orderby'] == a){
          if (vars['orderdata'] == 'asc'){
            vars['orderdata'] = 'desc';
          }else{
            vars['orderdata'] = 'asc';
          }
        }else{
          vars['orderby'] = a;
          vars['orderdata'] = 'asc';
        }
      }else{
        vars.push('orderby');
        vars['orderby'] = a;
        vars.push('orderdata');
        vars['orderdata'] = 'asc';
      }
      $.each(vars,function(i,v){
        if (i == 0){
          c += '?'+v+'='+vars[v];
        }else{
          c += '&'+v+'='+vars[v];
        }
      });
    }else{
      c = '?q=s&orderby='+a+'&orderdata=asc';
    }
    d = $.cur_url_whash()+c; 
    $.redirect(d);
    return false;
  });
});

