/*price range*/

 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});

$(document).ready(function(){
	$("#selSize").change(function(){
		var idSize =$(this).val();
		if(idSize==""){
			return false;
		}
		$.ajax({
                type: 'get',
                url :'/get-product-price',
                data:{idSize:idSize},
                success:function(resp){

                	var arr =resp.split('#');
                	$("#getPrice").html("INR"+arr[0]);
                	$("#Price").val(arr[0]);
                	if(arr[1]==0){

                		$(".cart").hide();
                		$("#availablity").text("Out of stock");
                	}else{
                		$(".cart").show();
                		$("#availablity").text("In of stock")
                	}

                },error:function(){

                }

		});

		//alert(idSize);
	})

	$(".changeImage").click(function(){
       var image =$(this).attr('src');

       $(".mainImage").attr("src",image);

	});

});

$(document).ready(function(){

  $("#registerForm").validate({

         rules:{
                name:{
                	required:true,
                	minLength:2,
                	lettersonly:true
                },
                password:{
                	required:true,
                	minlength:4,
                	
                },
                email:{
                	required:true,
                	email:true,
                	remote:"/check-email"

                	
                }

         },
         messages:{
                  name:"Please Inter Name",

                  password:{
                          required:"Please Provide your password",
                          minlength:"Please must be atleast 6 cherecter"
                  },
                  email:{

                  	required:"PLease Inter  your email",
                  	email:"Please enter valid email",
                  	remote:"Email Already exists"
                  }

         }

  });


  $("#accountFrom").validate({

         rules:{
                name:{
                	required:true,
                	minLength:2,
                	lettersonly:true
                },
                address:{
                	required:true,
                	minlength:4,
                	
                },
                city:{
                	required:true,
                	minlength:4,

                	
                },
                state:{
                	required:true,
                	

                	 },
              country:{
                	required:true
                	

                	
                }  	 

         },
         messages:{
                  name:"Please Inter Name",

                  address:{
                          required:"Please Provide your Address",
                          minlength:"Please must be atleast 6 cherecter"
                  },
                  city:{

                  	required:"PLease Inter  your City Name",
                  	minlength:"Please must be atleast 4 cherecter"
                  	
                  },

                  state:{

                  	required:"PLease Inter  your state Name",
                  	
                  	
                  },
                   country:{

                  	required:"PLease Inter  your Country Name",
                  	
                  	
                  },


         }

  });


   $("#loginForm").validate({

         rules:{
                
                password:{
                	required:true,
                	
                	
                },
                email:{
                	required:true,
                	email:true,
                	

                	
                }

         },
         messages:{
                 

                  password:{
                          required:"Please Provide your password"
                          
                  },
                  email:{

                  	required:"PLease Inter  your email",
                  	email:"Please enter valid email"
                  	
                  }

         }

  });

   //check current password
   $("#current_pwd").keyup(function(){
      var current_pwd =$(this).val();
      //alert(current_pwd);

      $.ajax({
      	headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
      	  type:'post',
      	  url:'/check-user-pwd',
      	  data:{current_pwd:current_pwd},
      	  success:function(resp){
      	  	if(resp =="false"){
      	  		$("#chkPwd").html("<font color='red'>Current Password Incurrect</font>");
      	  	}else if(resp =="true"){
      	  		$("#chkPwd").html("<font color='green'>Current Password Currect</font>");
      	  	}
      	  },error:function(){
      	  	alert("Error");
      	  }

      })
   });

   //pasword form validation
   $("#passwordForm").validate({
		rules:{
			current_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			new_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			confirm_pwd:{
				required:true,
				minlength:6,
				maxlength:20,
				equalTo:"#new_pwd"
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

   $('#password').passtrength({
          minChars: 4,
          passwordToggle: true,
          tooltip: true
        });

   //copy  to bill to ship
   $("#CopyAddress").on('click',function(){
    if(this.checked){
      $("#shipping_name").val($("#billing_name").val());
      $("#shipping_address").val($("#billing_address").val());
      $("#shipping_city").val($("#billing_city").val());
      $("#shipping_state").val($("#billing_state").val());
      $("#shipping_country").val($("#billing_country").val());
      $("#shipping_pincode").val($("#billing_pincode").val());
      $("#shipping_mobile").val($("#billing_mobile").val());
      

     //alert('test');
    }else{
          $("#shipping_name").val();
      $("#shipping_address").val();
      $("#shipping_city").val();
      $("#shipping_state").val();
      $("#shipping_country").val();
      $("#shipping_pincode").val();
      $("#shipping_mobile").val();
      
    }

   });


});

//payment

function selectPaymentMethod(){
  if($('#Paypal').is(':checked') || $('#COD').is(':checked')){
    //alert('Checked');
  }else{
    alert('Please Select Payment Method');
    return false;
  }

  
  
}
