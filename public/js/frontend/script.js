$(document).ready(function(){
	/*Menambahkan class change ketika burger-menu diklik*/
	
	
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
	$.ajaxPrefilter(function( options, original_Options, jqXHR ) {
	    options.async = true;
	});

	$(window).on('load',function(){
		$(".loader-container").fadeOut(100);
		//$(".loader-container").css("visibility","hidden");
	})
	
	var url = window.location.href;

	var link = $(".category-logo-job").first().data("alias");
	var linkhome = $(".home").attr("href");
	var firstCategoryVacancy = $(".category-logo-job").first().data("id");
	var page = 2;

	var inputEmailFlag = 0;
	var inputPhoneFlag = 0;
	var inputFileFlag = 0;
	

	$(".category-title").html($(".category-logo-job").first().data("name"));
	
	if(url.includes("career")){
		$(".category-job-link").attr("href",url+"/"+link);
		$.ajax({
			url: url+"/detailvacancy/"+firstCategoryVacancy,
			type: "get",
			success:function(response){

				if(!url.includes('career-search')){
		  			$(".detail-vacancy").html(response);
		  		}
		  	},
		   	error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
	       		/*console.log(JSON.stringify(jqXHR));
	       		console.log("AJAX error: " + textStatus + ' : ' + errorThrown);*/
	      	}
		})
	}
	if(url.includes("about-us")){
		var firstCategoryCompany = $(".category-logo-company").first().data("id");
		$.ajax({
			url: url+"/ourcompanies/"+firstCategoryCompany,
			type: "get",
			success:function(response){
		  		$(".company-posts").html(response);
		  	},
		   	error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
	       		/*console.log(JSON.stringify(jqXHR));
	       		console.log("AJAX error: " + textStatus + ' : ' + errorThrown);*/
	      	}
		})
	}


	if(linkhome == url.slice(0,url.length-1)){
		$(".category-job-link").attr("href",url+"career/"+link);
		$.ajax({
			url: url+"detailvacancy/"+firstCategoryVacancy,
			type: "get",
			success:function(response){
				//console.log(response);
				if(response != "kosong"){
		  			$(".detail-vacancy").html(response);
		  		}else{
		  			$(".detail-vacancy").html("<div class='col-xs-12 m-t-24'><em>There is not an available job</em></div>");
		  		}
		  		//$(".detail-vacancy").html(response);
		  	},
		   	error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
	       		/*console.log(JSON.stringify(jqXHR));
	       		console.log("AJAX error: " + textStatus + ' : ' + errorThrown);*/
	      	}
		})
	}

	
	$(document).on('click','.burger-menu',function(){
		$(this).toggleClass("change");
		if($(this).hasClass("change")){
			$(".nav ul").stop().slideDown(400);

		}else{
			$(".nav ul").stop().slideUp(400);
		}	
	})

	$(window).on('resize',function(){
		if($(document).width() <= 928){
			$('.burger-menu').removeClass("change");
			$(".nav ul").css('display','none');
		}
		if($(document).width() > 928){
			$(".nav ul").css('display','block');
		}
	})
		
	$('body,html').scrollTop(0);

	$.extend({
		cardHover:function(){
			$('.card').hover(function(){
			   	$(this).find('.curtain').stop().fadeIn();
        		$(this).find('.center-text-absolute').stop().slideDown();
		    },function(){
		        $(this).find('.curtain').stop().fadeOut();
		        $(this).find('.center-text-absolute').stop().slideUp();    	
		    })
		}
	});
	$.cardHover();

	$('#testimonial').owlCarousel({
		loop: true,
	    items: 1,
	    dots: true,
	    autoplay: true,
		autoplayTimeout: 10000,
		smartSpeed:1200
	})

	$('#category').owlCarousel({
	    loop: true,
	    margin: 10,
	    nav: true,
	    dots:false,
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
	})

	/*$(document).on("keydown",".input-search",function(){
		console.log($(this).val());
		$.ajax({
			url: url+"/detailvacancy/"+vacancyCategory,
			type: "get",
			success:function(response){
		  		$(".detail-vacancy").html(response);
		  		if(url.includes("career")){
		  			console.log("CLICK CAREER");
					$(".category-job-link").attr("href",url+"/"+alias);
				}else{
					$(".category-job-link").attr("href",url+"career/"+alias);
					console.log("CLICK HOME");
					console.log(url.includes("career"))
				}
		  	},
		   	error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
	       		console.log(JSON.stringify(jqXHR));
	       		console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
	      	}
		})
	});*/

	$(".category-logo-job").on("click",function(){
		$(".category-title").text($(this).data("name"));
		var vacancyCategory = $(this).data("id");
		var alias = $(this).data("alias");
		//console.log(url+"/detailvacancy/"+vacancyCategory);
		$.ajax({
			url: url+"/detailvacancy/"+vacancyCategory,
			type: "get",
			success:function(response){
				if(response != "kosong"){
		  			$(".detail-vacancy").html(response);
		  		}else{
		  			$(".detail-vacancy").html("<div class='col-xs-12 m-t-24'><em>No open positions at this time.</em></div>");
		  		}
		  		if(url.includes("career")){
					$(".category-job-link").attr("href",url+"/"+alias);
				}else{
					$(".category-job-link").attr("href",url+"career/"+alias);
				}
		  	},
		   	error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
	       		/*console.log(JSON.stringify(jqXHR));
	       		console.log("AJAX error: " + textStatus + ' : ' + errorThrown);*/
	      	}
		})

	})

	$(".category-logo-company").on("click",function(){
		var comCategory = $(this).data("id");
		$.ajax({
			url: url+"/ourcompanies/"+comCategory,
			type: "get",
			success:function(response){
		  		$(".company-posts").html(response);
		  	},
		   	error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
	       		/*console.log(JSON.stringify(jqXHR));
	       		console.log("AJAX error: " + textStatus + ' : ' + errorThrown);*/
	      	}
		})
	})


	$(document).on("change",".inputfile",function(e){
		
		var file = e.target.files[0];
		//console.log(file,$(this).length);
		var type = "";
		if(file.type != ""){
			type = file.type.split('/')[1];
		}
		//console.log(type);
		var button = $('#btn-submit');
		var fileName = $('.fileName');
		//console.log($(this));
		if(type.toLowerCase() != 'pdf' || file.size > 2000000){
			$('.message-applied').fadeIn(function() {
				$('.message-applied').removeClass('alert-success');
			    $('.message-applied').addClass('alert-danger');
			    $('.message-applied').html("<strong>Upload Failed !</strong> File must pdf & below 2 MB");
			    // setTimeout(function() {
			    //     $('.message-applied').fadeOut();
			    // }, 20000);
			});
			$(".input-file").css("border","3px solid #faa");
			$(this).val(null);
			fileName.text('Your file name : ');
			inputFileFlag = 0;

		}else{
			$(".input-file").css("border","3px solid #e0e0e0");
			$('.message-applied').fadeOut();
			$('.fileName').text('Your file name : '+file.name);
			inputFileFlag = 1;
		}
	});
	
	$(document).on("focusin","#firstname",function(){
		$(this).css("border-bottom","3px solid #faa");
	})
	$(document).on("focusout","#firstname",function(){
		if($(this).val() == "")$(this).css("border-bottom","3px solid #faa");
		else $(this).css("border-bottom","3px solid #e0e0e0");
	})

	$(document).on("change","#firstname",function(){
		if($(this).val() == ""){
			$(this).css("border-bottom","3px solid #faa");
		}else{
			$(this).css("border-bottom","3px solid #e0e0e0");
		}
	})
	
	$(document).on("focusin","#email",function(){
		$(this).css("border-bottom","3px solid #faa");
	})
	$(document).on("focusout","#email",function(){
		if(inputEmailFlag == 0)$(this).css("border-bottom","3px solid #faa");
		else $(this).css("border-bottom","3px solid #e0e0e0");
	})

	$(document).on("change","#email",function(){
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  		if(!emailReg.test($(this).val()) || $(this).val() == ""){
  			inputEmailFlag = 0;
  			$(this).css("border-bottom","3px solid #faa");
  			$(".email-validate").css("opacity","1");
  		}else{
  			inputEmailFlag = 1;
  			$(this).css("border-bottom","3px solid #e0e0e0");
  			$(".email-validate").css("opacity","0");
  		}
		
	})

	$(document).on("focusin","#phone",function(){
		$(this).css("border-bottom","3px solid #faa");
	})
	$(document).on("focusout","#phone",function(){
		if(inputPhoneFlag == 0)$(this).css("border-bottom","3px solid #faa");
		else $(this).css("border-bottom","3px solid #e0e0e0");
	})

	$(document).on("change","#phone",function(){
		var phoneReg = /^(?=.*\d).{7,}/;
		if(!phoneReg.test($(this).val()) || $(this).val() == ""){
			inputPhoneFlag = 0;
			$(this).css("border-bottom","3px solid #faa");
			$(".phone-validate").css("opacity","1");
		}else{
			inputPhoneFlag = 1;
			$(this).css("border-bottom","3px solid #e0e0e0");
			$(".phone-validate").css("opacity","0");
		}
	})

	//form disubmit maka kirim data
	$(document).on("submit","#applyForm",function(event){
		event.preventDefault();

		var firstname = $("#firstname");
		var email = $("#email");
		var phone = $("#phone");

		if(firstname.val() == ""){
			firstname.css("border-bottom","3px solid #faa");
			event.preventDefault();
		}
		if(email.val() == ""){
			email.css("border-bottom","3px solid #faa");
			event.preventDefault();
		}
		if(phone.val() == ""){
			phone.css("border-bottom","3px solid #faa");
			event.preventDefault();
		}

		if(inputFileFlag == 0){
			$(".input-file").css("border","3px solid #faa")
			event.preventDefault();
		}
		if(firstname.val() != "" && inputFileFlag != 0 && inputEmailFlag != 0 && inputPhoneFlag != 0){
			//event.preventDefault();
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
           		 	$(".input-text").val(null);
		            $("#file").val(null);
					$(".fileName").text('Your file name : ');

					inputFileFlag = 0; 
					inputEmailFlag = 0; 
					inputPhoneFlag = 0;

		            if(data == 'twice'){
		            	$("body").css("overflow","hidden");
		            	$(".modal-header h2").text("Fail");
		            	$(".modal-body p").text("Sorry, you can’t submit your application for the same job more than once. Please wait for the further information. We’ll inform you as soon as possible.");
		            	$(".modal-body p").css("color","#e53935");
		            	$(".modal-header").css("background-color","#e53935");
		            	$(".modal").css('display','block');
		            	}
		            if(data == 'success'){
		            	$("body").css("overflow","hidden");
		            	$(".modal-header h2").text("Success");
		            	$(".modal-body p").text("Thank you for applying! We will be assessing your application immediately and carefully selecting the applicants that we feel would best meet our company’s current needs. We’ll let you know our decision through email as soon as we can.");
		            	$(".modal-body p").css("color","#5cb85c");
		            	$(".modal-header").css("background-color","#5cb85c");
		            	$(".modal").css('display','block');
		            	
		            }
		            if(data == 'fail'){
		            	$("body").css("overflow","hidden");
		            	$(".modal-header h2").text("Fail");
		            	$(".modal-body p").text("Unable to upload data due to network connectivity issue. Please check your internet connection, then try again.");
		            	$(".modal-body p").css("color","#e53935");
		            	$(".modal-header").css("background-color","#e53935");
		            	$(".modal").css('display','block');
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

	//click window untuk close modal
	$(document).on("click",window,function(event){
		//jika target == class modal
		if(event.target.classList[0] == "modal"){
			$(".modal").css("display","none");
			$("body").css("overflow","scroll");
		}
		if (!event.target.matches('.dropbtn, .dropbtn > img, .dropbtn > span, .dropbtn > i')) {
			var dropdowns = $(".dropdown-content");
			var i;
			for (i = 0; i < dropdowns.length; i++) {
				var openDropdown = dropdowns[i];
				if (openDropdown.classList.contains('show')) {
					openDropdown.classList.remove('show');
					$(".dropbtn i").removeClass("fa-caret-up");
					$(".dropbtn i").addClass("fa-caret-down");
				}
			}
		}
		if (!event.target.matches('.news-dropbtn')) {
			var dropdowns = $(".news-dropdown-content");
			var i;
			for (i = 0; i < dropdowns.length; i++) {
				var openDropdown = dropdowns[i];
				if (openDropdown.classList.contains('show')) {
					openDropdown.classList.remove('show');
					$(".news-dropbtn i").removeClass("fa-caret-up");
					$(".news-dropbtn i").addClass("fa-caret-down");
				}
			}
		}
	})

	$(document).on("click",".dropbtn",function(){
		if(!$('#myDropdown').hasClass("show")){
			$("#myDropdown").addClass("show");
			$(".dropbtn i").removeClass("fa-caret-down");
			$(".dropbtn i").addClass("fa-caret-up");
		}else{
			$("#myDropdown").removeClass("show");
			$(".dropbtn i").removeClass("fa-caret-up");
			$(".dropbtn i").addClass("fa-caret-down");
		}
	})

	$(document).on("click",".news-dropdown",function(){
		if(!$('#newsDropdown').hasClass('show')){
			$('#newsDropdown').addClass('show');
			$('.news-dropbtn i').removeClass('fa-caret-down');
			$('.news-dropbtn i').addClass('fa-caret-up');
		}else{
			$('#newsDropdown').removeClass('show');
			$('.news-dropbtn i').removeClass('fa-caret-up');
			$('.news-dropbtn i').addClass('fa-caret-down');
		}
	})

	//click x untuk close modal 
	$(document).on("click",".close",function(){
		$(".modal").css("display","none");
		$("body").css("overflow","scroll");
	})

	//click untuk load gambar
	$(document).on("click",".btn-more",function(){
		$(this).attr('disabled','disabled');
		//console.log(url+"?page="+page);
		$.ajax({
			url: url+"?page="+page,

			type: "get",
			success:function(response){
				$(this).removeAttr("disabled");
				if(!response.disabled){
					$(".new-activities").append(response.content);
					// $('.center-text-absolute').stop().slideUp("fast");
					page++;
				}else{
					$(".new-activities").append(response.content);
					// $('.center-text-absolute').stop().slideUp("fast");
					$('.btn-more').css('display','none');
				}
			$.cardHover();
				
		  	},
		   	error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
	       		/*console.log(JSON.stringify(jqXHR));
	       		console.log("AJAX error: " + textStatus + ' : ' + errorThrown);*/
	      	}
		})
	});

});





