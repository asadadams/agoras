
    var currentLocation = window.location;
    /*About validate box notification variable*/
    var box_id = $('#box_id').text();
    
   var hide = localStorage.getItem(box_id);
    if(hide=='true'){
       $('#'+box_id).css('display','none'); 
    }
    
    $('#close').click(function(){
        $('#'+box_id).fadeOut();
        localStorage.setItem(box_id, 'true');
    });
    
    
    
    /*Setting profile Pic*/
    $('input[type="file"]').change(function(){
        $('.btn-trans').css('display','block');
        readDATA(this);
        
    });
    
    $.fn.hasExtension = function(exts) {
        return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test($(this).val());
    }
    
     function readDATA(input) {
         if ($('input[type="file"]').hasExtension(['.jpg', '.png', '.gif'])) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#profile_pic')
                            .attr('src', e.target.result)
                           ;
                    };
                    reader.readAsDataURL(input.files[0]);
                }
         }
    }
    
    
    $('.edit-profile').change(function(){
        $('#save_profile').removeAttr('disabled')
    });

    
    /*Tab fuction*/
    $(document).ready(function(){
    $("ul#tabs li").click(function(e){
        if (!$(this).hasClass("active")) {
            var tabNum = $(this).index();
            var nthChild = tabNum+1;
            $("ul#tabs li.active").removeClass("active");
            $(this).addClass("active");
            $("ul#tab li.active").removeClass("active");
            $("ul#tab li:nth-child("+nthChild+")").addClass("active");
        }
    });
    });
    
    $('.themsg').mouseover(function(){
        $(this).find('.msg_options').css('display','block');
    }).mouseleave(function(){
        $(this).find('.msg_options').css('display','none');
    });
    
    
    /*AJAX FUNCTIONS*/
    /*ajax saving profile changes*/
    $('#save_profile').click(function(){
        var text = $("#txtbio").val();
        var displayname = $("#displayname").val();
        var twitter = $("#twitter").val();
        var facebook = $("#facebook").val();
        var website = $("#website").val();
        var location = $("#location").val();
        var mobile = $("#mobile").val();
        $.ajax({
            type:'POST',
            url:'libs/editProfile.php',
            data:'bio='+text+'&displayname='+displayname+'&location='+location+'&twitter='+twitter+'&facebook='+facebook+'&website='+website+'&mobile='+mobile,
            success: function(data){
                   if(data != null && data == "success"){ 
                        window.setTimeout(function () {
                             window.location.href = displayname;
                        }, 500);
                       
                        $('#save_profile').attr('value','Changes saved');
                   }else{
                        $('#result').html(data);   
                   }
            }
        });
    });

	/*Following a user*/
	$('.btn-follow').click(function(){
		var user1 = $(this).attr('user1');
		var user2 = $(this).attr('user2');
		var this_btn = $(this);
		 $.ajax({
                type:'POST',
                url:'libs/follow.php',
                data:'user1='+user1+'&user2='+user2,
                success: function(data){
                    this_btn.val(data);
                }
            });   
	});

	/*Following forum*/
	$('.btn-follow-forum').click(function(){
		var user = $(this).attr('user');
		var forum_id = $(this).attr('forum_id');
		var this_btn = $(this);
		 $.ajax({
                type:'POST',
                url:'libs/follow_forums.php',
                data:'user='+user+'&forum_id='+forum_id,
                success: function(data){
                    this_btn.val(data);
                }
            });   
	});
	
	//following custom forums
	$('.follow-custom-forum').click(function(){
		var user = $(this).attr('user');
		var forum_id = $(this).attr('forum_id');
		var this_btn = $(this);
		 $.ajax({
                type:'POST',
                url:'libs/follow_Customforums.php',
                data:'user='+user+'&forum_id='+forum_id,
                success: function(data){
                    this_btn.val(data);
                }
            });   
	});


    //adding interested
    var loaded1=false;
    $('#save_interested').click(function(){
        var interested_val = $('#interested').val();
        if(loaded1==false){
            $.ajax({
                type:'POST',
                url:'libs/addInterested.php',
                data:'interested='+interested_val,
                success: function(data){
                    $('.interested_box').html(data); 
                    $("#interested").val('');
                }
            });   
            loaded1=true;
        }
    });
	
    //Remove Interested
    $(".remove_element").on("click", function(e) {
        $(this).closest("div.outer_box").remove();
        var element =$(this).attr('element');
        $.ajax({
		type: "POST",
		url: "libs/removeInterested.php",
		data:'interested='+element,
		beforeSend: function(){
			$(".outer_box").css("background","url(img/LoaderIcon.gif) no-repeat 370px");
		},
		success: function(data){
			$(".outer_box").css("background","#f6f6f6");
		}
		});
        e.preventDefault();
    });

    var loaded = false;
    /*ajax Sending messages*/
      $('#send').click(function(){
        var to = $("#to").val();
        var title = $("#title").val();
        var message = $("#message").val();
        if(loaded==false){
        $.ajax({
            type:'POST',
            url:'libs/sendMessage.php',
            data:'to='+to+'&title='+title+'&message='+message,
            success: function(data){
                 if(data != null){
                    $('#result').html(data);
                    $("#to").val(' ');
                    $("#title").val(' ');
                    $("#message").val(' ');  
                 }
            }
        });
        loaded=true;
        }
    });
	
	//Posting a comment
	 $('.post_comment').click(function(){
        var comment_text = $(this).prev('input').val();
		var post_id = $(this).prev('input').attr('post_id');
		var user_post = $(this).prev('input').attr('user_post')
		var this_btn = $(this);
   		 $.ajax({
            type:'POST',
            url:'libs/postComment.php',
            data:'comment_text='+comment_text+'&post_id='+post_id+'&user_post='+user_post,
            success: function(data){
				this_btn.prev('input').val('');
				this_btn.closest('div').find('.show_comment').html(data);
            }
        });
    });


     /*ajax Replying messages*/
    $('#replyMsg').click(function(){
        var to = $("#user_replyto").val();
        var title = $("#reply_title").val();
        var message = $("#reply_msg").val();
         $.ajax({
            type:'POST',
            url:'libs/sendMessage.php',
            data:'to='+to+'&title='+title+'&message='+message,
            success: function(data){
                 if(data != null){
                    $('#result').html(data);  
                 }
            }
        });
    });
    
    //Deleting message
    $('.delete_msg').click(function(){
        $(this).closest("div.themsg").remove();
        var message_id =$(this).attr('message_id');
        var user1 =$(this).attr('user1');
        var user2 =$(this).attr('user2'); 
         $.ajax({
            type:'POST',
            url:'libs/deleteMessage.php',
            data:'message_id='+message_id+'&user1='+user1+'&user2='+user2,
            success: function(data){
                 if(data != null){
                    $('#del').html(data);  
                 }
            }
        });
    });
	
	
   //Autosuggest to read users
	$("#to").keyup(function(){
		$.ajax({
		type: "POST",
		url: "libs/autocomp_readUsers.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#to").css("background","#FFF url(img/LoaderIcon.gif) no-repeat 650px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#to").css("background","#FFF");
		}
		});
	});
     $('.selected_user').click(function(){
      var user = $(this).text();
      $('#to').val(' ');
      $('#to').val(user);
      $("#suggesstion-box").hide();
    });
    

	  $('.selected_forum').click(function(){
      	var user = $(this).text();
      	$('#forum_to').val(' ');
      	$('#forum_to').val(user);  
	  });

    //Opening sigin and signup page toggle
    $('#have_account').click(function(){
        $('#signup_form').hide();
         $('#signup_top_txt').hide();
        $('#login_form').show();
        $('#login_txt').show();
        return false;
    });
    $('#create_account').click(function(){
        $('#signup_form').show();
        $('#login_form').hide ();
        $('#login_txt').hide();
        var url = $(this).attr('href');
        
		return false;
    });
	
	/*Changing password*/
	$('#change_password').click(function(){
		$(this).css('display','none');
		$('#changers').css('display','block');
	});
	
	$('#save_password').click(function(){
		var current_password = $('#current_password').val();
		var new_password = $('#new_password').val();
   		 $.ajax({
            type:'POST',
            url:'libs/savePassword.php',
            data:'current_password='+current_password+'&new_password='+new_password,
            success: function(data){
				$('#password_feedback').html(data);
				current_password.val('');
				new_password.val('');
            }
        });
	});

	/*changing email*/
	$('#change_email').click(function(){
		$(this).css('display','none');
		$('#changer_email').css('display','block');
	});
	$('#save_email').click(function(){
		var new_email = $('#new_email').val();
   		 $.ajax({
            type:'POST',
            url:'libs/saveEmail.php',
            data:'new_email='+new_email,
            success: function(data){
				$('#email_feedback').html(data);
				current_password.val('');
				new_password.val('');
            }
        });
	});
	
	function slideDown(){
		console.log('Working');
		$('.top_slider').slideDown().delay(4000);
	}

	$(document).ready(function () {
  //rotation speed and timer
  var speed = 5000;
  
  var run = setInterval(rotate, speed);
  var slides = $('.slide');
  var container = $('#slides ul');
  var elm = container.find(':first-child').prop("tagName");
  var item_width = container.width();
  var previous = 'prev'; //id of previous button
  var next = 'next'; //id of next button
  slides.width(item_width); //set the slides to the correct pixel width
  container.parent().width(item_width);
  container.width(slides.length * item_width); //set the slides container to the correct total width
  container.find(elm + ':first').before(container.find(elm + ':last'));
  resetSlides();
  
  //Reporting a bug
  $('#report').click(function(){
		var bug = $('#bug').val();
	  	var user = $('#bug').attr('user');
   		 $.ajax({
            type:'POST',
            url:'libs/report.php',
            data:'bug='+bug+'&user='+user,
            success: function(data){
				alert(data);
				$('#bug').val('');
            }
        });
});

  //if user clicked on prev button
  
  $('#buttons a').click(function (e) {
    //slide the item
    
    if (container.is(':animated')) {
      return false;
    }
    if (e.target.id == previous) {
      container.stop().animate({
        'left': 0
      }, 1500, function () {
        container.find(elm + ':first').before(container.find(elm + ':last'));
        resetSlides();
      });
    }
    
    if (e.target.id == next) {
      container.stop().animate({
        'left': item_width * -2
      }, 1500, function () {
        container.find(elm + ':last').after(container.find(elm + ':first'));
        resetSlides();
      });
    }
    
    //cancel the link behavior      
    return false;
    
  });
  
  //if mouse hover, pause the auto rotation, otherwise rotate it  
  container.parent().mouseenter(function () {
    clearInterval(run);
  }).mouseleave(function () {
    run = setInterval(rotate, speed);
  });
  
  
  function resetSlides() {
    //and adjust the container so current is in the frame
    container.css({
      'left': -1 * item_width
    });
  }
  
});
//a simple function to click next link
//a timer will call this function, and the rotation will begin

function rotate() {
  $('#next').click();
}
