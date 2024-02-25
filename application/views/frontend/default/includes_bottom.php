<!-- Plugin JS File -->
<script src="<?=base_url()?>assets/frontend/js/vendor/jquery-3.6.0.min.js"></script>
<script src="<?=base_url()?>assets/frontend/js/vendor/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>assets/frontend/js/vendor/modernizr-3.11.2.min.js"></script>
<script src="<?=base_url()?>assets/frontend/js/isotope.pkgd.min.js"></script>
<script src="<?=base_url()?>assets/frontend/js/swiper.min.js"></script>
<!--<script src="<?=base_url()?>assets/frontend/js/swiper-bundle.min.js"></script>-->
<script src="<?=base_url()?>assets/frontend/js/wow.js"></script>
<script src="<?=base_url()?>assets/frontend/js/counterup.js"></script>
<script src="<?=base_url()?>assets/frontend/js/jquery.countdown.min.js"></script>
<script src="<?=base_url()?>assets/frontend/js/lightcase.js"></script>
<script src="<?=base_url()?>assets/frontend/js/waypoints.min.js"></script>
<script src="<?=base_url()?>assets/frontend/js/lobibox.js"></script>
<script src="<?=base_url()?>assets/frontend/js/notification.js"></script>
<script src="<?=base_url()?>assets/frontend/js/main.js"></script>
<script src="<?=base_url()?>assets/frontend/js/jquery-ui.js"></script>
<script src="<?=base_url('assets/backend/')?>libs/dropzone/min/dropzone.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js" integrity="sha512-0bEtK0USNd96MnO4XhH8jhv3nyRF0eK87pJke6pkYf3cM0uDIhNJy9ltuzqgypoIFXw3JSuiy04tVk4AjpZdZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!--light gallery js -->
<script src="<?=base_url()?>assets/frontend/js/jquery.fancybox.min.js"></script>

<script src="<?=base_url()?>assets/frontend/js/hammer.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/frontend/message/js/message/main.js"></script>


<!--toster js-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<?php echo alertify_render( '//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build', 'top-right' ); ?>

<script type="text/javascript">
	x_dropzone();
</script>

<script type="text/javascript">
	jQuery('#profile_pic_preview').click(function(){
		jQuery('#profile_pic').click();
	});
	
	jQuery('#profile_pic').change(function(){
		let file = this.files[0];
		if( file ){
			document.querySelector('#profile_pic_preview').src = URL.createObjectURL(file)
		}
	});
</script>

<script>
 function preview_modal(url, modal_selector, initiator = false, middleware = false)
    {
    	 $.ajax({
            type: "POST",
            url: url, 
            cache: false, 
            async: false,  
            success: function(data){ 
                jQuery(modal_selector).modal('show');
                jQuery('.modal-content').html(data)
                

            }
        });
    }    
</script>

<script>
 $( document ).ready(function() {	
     
    //  window.addEventListener("beforeunload", function (event) {
    //         window.setTimeout(function () {
    //             $.ajax({
    //                 type: "post",
    //                 url: <?php echo base_url('login/glogout'); ?>,
    //                 success: function (data) {
                        
    //                 },
                    
    //             });
    //         }, 500);
    //     });
        
	$(".image_remove").click(function(event) {
    event.preventDefault();
    var id=$(this).attr('id');
    $.ajax({
                type: "POST",
                url: "<?php echo base_url('home/guide_image_del'); ?>",
                data: "id="+ id,
                success: function(){
                     
                }
        });
    $(this).parents('.old_guide_image').remove();       
  
});
});    
</script>

<script>
 $( document ).ready(function() {	
	$(".image_remove").click(function(event) {
    event.preventDefault();
    var id=$(this).attr('id');
    $.ajax({
                type: "POST",
                url: "<?php echo base_url('home/friend_image_del'); ?>",
                data: "id="+ id,
                success: function(){
                     
                }
        });
    $(this).parents('.old_friend_image').remove();       
  
});
});    
</script>

<script>
  $(function() {
    var options = 
        {
            range: true,
            min: 0,
            max: 100,
            values: [ 20, 28 ],
            slide: function( event, ui ) {
                $( "#age" ).val( "" + ui.values[ 0 ] + " - " + ui.values[ 1 ] );
            }
        };
    
        $( "#age-range" ).slider(
            options
        );
        $( "#age" ).val( "" + $( "#age-range" ).slider( "values", 0 ) +
            " - " + $( "#age-range" ).slider( "values", 1 ) );
      
    $(".clear").click(function()
       {
           $("#age-range").slider("values", 0, options.values[0]);  
           $("#age-range").slider("values", 1, options.values[1] ); 
           $( "#age" ).val( "" + options.values[0] + " - " + options.values[1] );           
       });
    });

</script>
  
<script>
  $(function() {
    var options = 
        {
            range: true,
            min: 150,
            max: 50000,
            values: [ 150, 10000 ],
            slide: function( event, ui ) {
                $( "#rent" ).val( "" + ui.values[ 0 ] + " - " + ui.values[ 1 ] );
            }
        };
    
        $( "#rent-range" ).slider(
            options
        );
        $( "#rent" ).val( "" + $( "#rent-range" ).slider( "values", 0 ) +
            " - " + $( "#rent-range" ).slider( "values", 1 ) );
      
    $(".clear").click(function()
       {
           $("#rent-range").slider("values", 0, options.values[0]);  
           $("#rent-range").slider("values", 1, options.values[1] ); 
           $( "#rent" ).val( "" + options.values[0] + " - " + options.values[1] );           
       });
    });

</script> 

<script>
  $( function() {
    $( "#fage-range" ).slider({
      range: true,
      min: 0,
      max: 100,
      values: [ 20, 28 ],
      slide: function( event, ui ) {
        $( "#fage" ).val( "" + ui.values[ 0 ] + "-" + ui.values[ 1 ] );
      }
    });
    $( "#fage" ).val( "" + $( "#fage-range" ).slider( "values", 0 ) +
      "-" + $( "#fage-range" ).slider( "values", 1 ) );
  } );
</script>
<script>
  $( function() {
    $( "#frent-range" ).slider({
      range: true,
      min: 150,
      max: 50000,
      values: [ 150, 10000 ],
      slide: function( event, ui ) {
        $( "#frent" ).val( "" + ui.values[ 0 ] + "-" + ui.values[ 1 ] );
      }
    });
    $( "#frent" ).val( "" + $( "#frent-range" ).slider( "values", 0 ) +
      "-" + $( "#frent-range" ).slider( "values", 1 ) );
  } );
</script>


<script>
 $( document ).ready(function() {
  $(".clear").click(function(event) {
    event.preventDefault();
    $('#guide_filter')[0].reset();
    guidefilter();
    
  });
 }); 
</script>

<script>
 $( document ).ready(function() {
     guidefilter();
 $("#submitbtn").click(function(event) {
    event.preventDefault();
    guidefilter();
           
});
});    
</script>

<script>
 $( document ).ready(function() {
     guidefilter();
 $(".view_all_btn").click(function(event) {
    event.preventDefault();
    var callby = "view_all"; 
    guidefilter(callby);
    $(".view_all").hide();
           
});
});    
</script>

<script>
  function guidefilter(callby='') {
    
    var dataForm = $("#guide_filter").serialize();
    //alert(data);
    $.ajax({
            type: "POST",
            url: "<?php echo base_url('home/guide_info'); ?>",
            data: dataForm +"&variable="+callby,
            success: function(data){
               var viewdata = JSON.parse(data);
               if(viewdata.length < 4){
                $(".view_all").hide();   
               }
               //console.log(arr.length);
               if(data != 0){
                //   console.log(data); 
               var itemHtml = '';
               $.each(JSON.parse(data), function(i, item) {
                   
               itemHtml +='<div class="member__item">';
                itemHtml +='<a href="<?=base_url()?>guide-details/'+item.id+'">';  
						itemHtml +='<div class="member__inner">';
							itemHtml +='<div class="member__thumb">';
							itemHtml +='<img src="<?=base_url()?>'+item.photo+'" alt="member-img">';
							itemHtml +='</div>';
							itemHtml +='<div class="star_rate">';
							itemHtml +='<span>4.5</span>';
							itemHtml +='<span><img src="<?=base_url()?>assets/frontend/images/icon/star.png" alt="star.png"></span>';
							itemHtml +='</div>';
							itemHtml +='<div class="member__content">';
							itemHtml +='<h5>'+item.name+'</h5>';
							itemHtml +='<p>'+item.city+'</p>';
							itemHtml +='</div>';
						itemHtml +='</div>';
					  itemHtml +='</a>';	
					itemHtml +='</div>';
            });

            $("#guide_member_item").html(itemHtml);
            $("#guideFilter").modal("hide");
            
            }else{
              $(".member_single_area").html("<div class='text-center'>no data found!</div>"); 
              $("#guideFilter").modal("hide");
            }
            
            }
        });      
      
  }      
</script>

<script>
 $( document ).ready(function() {
  $(".clear").click(function(event) {
    event.preventDefault();
    $('#friend_filter')[0].reset();
    friendfilter();
    
  });
 }); 
</script>

<script>
 $( document ).ready(function() {
     friendfilter();
 $("#submitreq").click(function(event) {
    event.preventDefault();
    friendfilter();
           
});
});    
</script>

<script>
  function friendfilter() {
    
    var dataForm = $("#friend_filter").serialize();
    
    $.ajax({
            type: "POST",
            url: "<?php echo base_url('home/rent_friend_info'); ?>",
            data: dataForm,
            success: function(data){
               
               if(data != 0){
               
               var itemHtml = '';
               $.each(JSON.parse(data), function(i, item) {
               
               itemHtml +='<div class="tinder--card" data-id="'+item.id+'" data-image="<?=base_url()?>'+item.photo+'">';
               itemHtml +='<a href="<?=base_url()?>rent-as-a-friend-details/'+item.id+'">';   
               itemHtml +='<img src="<?=base_url()?>'+item.photo+'">';  
						itemHtml +='<div class="content">';
							itemHtml +='<h3>'+item.name+'</h3>';
								itemHtml +='<p>'+item.city+'</p>';
							itemHtml +='</div>';
							itemHtml +='<div class="add_friendfav" data-id="'+item.id+'"><i class="fa fa-heart"></i>';
							itemHtml +='</div>';
				itemHtml +='</a>';				
				itemHtml +='</div>';
				$("#sendmessge").data("id",item.id);
				$("#sendmessge").data("image",item.photo);
            });

            $(".tinder--cards").html(itemHtml);
            $("#rentfriendFilter").modal("hide");
            
            }else{
              $(".tinder--cards").html("<div class='text-center'>no data found!</div>"); 
              $("#rentfriendFilter").modal("hide");
            }
            
            }
        });      
      
  }      
</script>

<!--
<script>
  function guidefav(id) {
    
    //alert(data);
    $.ajax({
            type: "POST",
            url: "<?php echo base_url('home/guide_favorite'); ?>", 
            dataType : "JSON",
            data: "id="+ id,
            success: function(response){
                //console.log(response);
             if(response == 1){
                Lobibox.notify('error', {
                    size: 'mini',
                    position: 'top right',
                    rounded: true,
                    delayIndicator: false,
                    msg: 'Your details is already favourite'
                 }); 
             }else{    
             Lobibox.notify('success', {
                    size: 'mini',
                    position: 'top right',
                    rounded: true,
                    delayIndicator: false,
                    msg: 'successfully added to favourite'
                 });
             } 
             
            }
        });      
      
  }      
</script>
-->

<script>
    $('.add_guidefav').on('click',function(){
        event.preventDefault();
        var id=$(this).attr('data-id');

        $.ajax({
            type : "POST",
            url  : "<?php echo base_url()?>home/guide_favorite",
            dataType : "JSON",
            data : {id:id},
            success: function(data){
             if(data.status == 1){
               alertify.success(data.message); 
             }else if(data.status == 0){
               alertify.warning(data.message);  
             }
           }
        });
     
    });
</script>

<script>
    $('.guide_unfollow').on('click',function(){
        event.preventDefault();
        var id=$(this).attr('data-id');

        $.ajax({
            type : "POST",
            url  : "<?php echo base_url()?>home/guide_unfollow",
            dataType : "JSON",
            data : {id:id},
            success: function(data){
             if(data.status == 1){
               alertify.success(data.message); 
               $('.unfollowguide'+id).parents().remove('.fav_item');
             }
           }
        });
     
    });
</script>

<script>
    //Save product
        $('#btnsubmit').on('click',function(){
            event.preventDefault();
            $(this).prop('disabled', true);
            var dataForm = $("#rating_form").serialize();
            
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url()?>home/rating",
            //    dataType : "JSON",
                data : dataForm,
                success: function(data){
                 Lobibox.notify('success', {
                    size: 'mini',
                    position: 'top right',
                    rounded: true,
                    delayIndicator: false,
                    msg: 'Comment has been successfully added.'
                 }); 
                 $('#starrating').modal('hide');
                }
            });
          
            //return false;
        });
</script>

<script>
  function starrate(id) {
     $("#guide_id").val(id);
    $("#starrating").modal("show");   
      
  }      
</script>

<script>
   $(document).on('click', '.add_friendfav', function(){
        event.preventDefault();
        var id=$(this).attr('data-id');
        $.ajax({
            type : "POST",
            url  : "<?php echo base_url()?>home/friend_favorite",
            dataType : "JSON",
            data : {id:id},
            success: function(data){
             if(data.status == 1){
               alertify.success(data.message); 
             }else if(data.status == 0){
               alertify.warning(data.message);  
             }
           }
        });
     
    });
</script>

<script>
    $('.friend_unfollow').on('click',function(){
        event.preventDefault();
        var id=$(this).attr('data-id');

        $.ajax({
            type : "POST",
            url  : "<?php echo base_url()?>home/friend_unfollow",
            dataType : "JSON",
            data : {id:id},
            success: function(data){
             if(data.status == 1){
               alertify.success(data.message); 
               $('.unfollowfriend'+id).parents().remove('.fav_item');
             }
           }
        });
     
    });
</script>

<script>
    //Save product
        $('#btnsubmit').on('click',function(){
            event.preventDefault();
            $(this).prop('disabled', true);
            var dataForm = $("#rating_form").serialize();
            
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url()?>home/friendRating",
            //    dataType : "JSON",
                data : dataForm,
                success: function(data){
                 Lobibox.notify('success', {
                    size: 'mini',
                    position: 'top right',
                    rounded: true,
                    delayIndicator: false,
                    msg: 'Comment has been successfully added.'
                 }); 
                 $('#friendStarRating').modal('hide');
                }
            });
          
            //return false;
        });
</script>

<script>
  function friendStarRate(id) {
     $("#friend_id").val(id);
    $("#friendStarRating").modal("show");   
      
  }      
</script>

<script>
  // Fancybox Config
$('[data-fancybox="gallery"]').fancybox({
  buttons: [
    "slideShow",
    "thumbs",
    "zoom",
    "fullScreen",
    "close"
  ],
  loop: false,
  protect: true
});    
</script>

<script>
$(document).ready(function(){
	var maxLength = 105;
	$(".show-read-more").each(function(){
		var myStr = $(this).text();
		if($.trim(myStr).length > maxLength){
			var newStr = myStr.substring(0, maxLength);
			var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
			$(this).empty().html(newStr);
			$(this).append(' <a href="javascript:void(0);" class="read-more" style="color:#E94057">Read more</a>');
			$(this).append('<span class="more-text">' + removedStr + '</span>');
		}
	});
	$(".read-more").click(function(){
		$(this).siblings(".more-text").contents().unwrap();
		$(this).remove();
	});
});
</script>

<script>
  $( function() {
    $( "#dob" ).datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0",
    });
  } );
  
  //====rent friend slider================
    
    var swiper = new Swiper('.rent_friend_slider', {
      effect: 'cards',
      grabCursor: true,
    });
  </script>
  
<!--<script>
'use strict';
var tinderContainer = document.querySelector('.tinder');
var allCards = document.querySelectorAll('.tinder--card');
var nope = document.getElementById('nope');
var love = document.getElementById('love');

function initCards(card, index) {
  var newCards = document.querySelectorAll('.tinder--card:not(.removed)');

  newCards.forEach(function (card, index) {
    card.style.zIndex = allCards.length - index;
    card.style.transform = 'scale(' + (20 - index) / 20 + ') translateY(-' + 30 * index + 'px)';
    card.style.opacity = (10 - index) / 10;
  });
  
  tinderContainer.classList.add('loaded');
}

initCards();

allCards.forEach(function (el) {
  var hammertime = new Hammer(el);

  hammertime.on('pan', function (event) {
    el.classList.add('moving');
  });

  hammertime.on('pan', function (event) {
    if (event.deltaX === 0) return;
    if (event.center.x === 0 && event.center.y === 0) return;

    tinderContainer.classList.toggle('tinder_love', event.deltaX > 0);
    tinderContainer.classList.toggle('tinder_nope', event.deltaX < 0);

    var xMulti = event.deltaX * 0.03;
    var yMulti = event.deltaY / 80;
    var rotate = xMulti * yMulti;

    event.target.style.transform = 'translate(' + event.deltaX + 'px, ' + event.deltaY + 'px) rotate(' + rotate + 'deg)';
  });

  hammertime.on('panend', function (event) {
    el.classList.remove('moving');
    tinderContainer.classList.remove('tinder_love');
    tinderContainer.classList.remove('tinder_nope');

    var moveOutWidth = document.body.clientWidth;
    var keep = Math.abs(event.deltaX) < 80 || Math.abs(event.velocityX) < 0.5;

    event.target.classList.toggle('removed', !keep);

    if (keep) {
      event.target.style.transform = '';
    } else {
      var endX = Math.max(Math.abs(event.velocityX) * moveOutWidth, moveOutWidth);
      var toX = event.deltaX > 0 ? endX : -endX;
      var endY = Math.abs(event.velocityY) * moveOutWidth;
      var toY = event.deltaY > 0 ? endY : -endY;
      var xMulti = event.deltaX * 0.03;
      var yMulti = event.deltaY / 80;
      var rotate = xMulti * yMulti;

      event.target.style.transform = 'translate(' + toX + 'px, ' + (toY + event.deltaY) + 'px) rotate(' + rotate + 'deg)';
      initCards();
    }
  });
});

function createButtonListener(love) {
  return function (event) {
    var cards = document.querySelectorAll('.tinder--card:not(.removed)');
    var moveOutWidth = document.body.clientWidth * 1.5;

    if (!cards.length) return false;

    var card = cards[0];

    card.classList.add('removed');

    if (love) {
      card.style.transform = 'translate(' + moveOutWidth + 'px, -100px) rotate(-30deg)';
    } else {
      card.style.transform = 'translate(-' + moveOutWidth + 'px, -100px) rotate(30deg)';
    }

    initCards();

    event.preventDefault();
  };
}

var nopeListener = createButtonListener(false);
var loveListener = createButtonListener(true);

nope.addEventListener('click', nopeListener);
love.addEventListener('click', loveListener);

</script>-->

<script>
  "use strict";

//Random Number generator
function randomNumber(min, max) {
	return Math.floor(Math.random() * (max - min + 1)) + min;
}

let tinderContainer = document.querySelector(".tinder");
let allCards = document.querySelectorAll(".tinder--card");
let currentCard;
const nope = document.getElementById("nope");
const love = document.getElementById("love");
let num = 5;

//create cards for page
function initCards(card, index) {
	//the cards that haven't been removed
	var newCards = document.querySelectorAll(".tinder--card:not(.removed)");

	newCards.forEach(function (card, index) {
		//put the card in front
		card.style.zIndex = allCards.length - index;
		//angle the card and make it smaller the further back it goes
		card.style.transform =
			"scale(" + (20 - index) / 20 + ") translateY(-" + 30 * index + "px)";
		//change how opaque it is depending where it is in the stack (index 0 is fully opaque). uses 5 so that anything loaded after 5 is fully transparent
		// card.style.opacity = (5 - index) / 5;
		
	});
tinderContainer.classList.add("loaded");
    var friend_id=$(".tinder--card:first").data("id");
    var image=$(".tinder--card:first").data("image");
    if(friend_id)
    {
        $("#sendmessge").data("id",friend_id);
        $("#sendmessge").data("image",image);
    }
	//give the ones that get initialized a "loaded" class
}

//run initialization
initCards();

function nodeToString(node) {
	var tmpNode = document.createElement("div");
	tmpNode.appendChild(node.cloneNode(true));
	var str = tmpNode.innerHTML;
	tmpNode = node = null; // prevent memory leaks in IE
	return str;
}

function cleanCurrentCard(thisCard) {
	let cleanedCard = nodeToString(thisCard)
		.replace(/(\r\n|\n|\r)/gm, "")
		.replace(" removed", "");
	return cleanedCard;
}

function removeRemoveClass() {
	var element = document.querySelector(".tinder--card");
	element.classList.remove("removed");
}

//my custom function
function addNewCard(thisCard) {
	console.log(thisCard);
	let cleanedCard = cleanCurrentCard(thisCard);

	//increment the number to be given to the card
	num++;

	//card area
	var allCardsArea = document.querySelector(".tinder--cards");

	//add a card to the end of the innerHTML
	setTimeout(function () {
		allCardsArea.innerHTML += cleanedCard;
		//remove the .removed ones
		const paras = document.getElementsByClassName("removed");
		while (paras[0]) {
			paras[0].parentNode.removeChild(paras[0]);
		}
		// removeRemoveClass();
	}, 300);

	//try to get newest card at back to fade in
	//ooor just add so many that the last one is completely transparent since the opacity changes by .10 each card

	//run these two after a delay that is slightly longer than the delay for adding the new card
	//this makes a new card at the back and then transitions it smoothly to the smaller size
	setTimeout(initCards, 301);
	setTimeout(addHammers, 301);
}

function addHammers() {
	//redefined to be able to reinitialize on new card add
	allCards = document.querySelectorAll(".tinder--card");

	allCards.forEach(function (el) {
		//initialize hammer on each card
		var hammertime = new Hammer(el);

		//add the moving class if the card is being panned
		hammertime.on("pan", function (event) {
			el.classList.add("moving");
		});

		//don't do anything if the movement hasn't changed
		hammertime.on("pan", function (event) {
			if (event.deltaX === 0) return;
			if (event.center.x === 0 && event.center.y === 0) return;

			//if it has been changed at all to the right, add the 'tinder-love' class
			tinderContainer.classList.toggle("tinder_love", event.deltaX > 0);
			//if it has been changed at all to the left, add the 'tinder-nope' class
			tinderContainer.classList.toggle("tinder_nope", event.deltaX < 0);

			//angle the further it goes right or left
			var xMulti = event.deltaX * 0.03;
			//angle the further it goes up or down
			var yMulti = event.deltaY / 80;

			//rotation is a combo of both
			var rotate = xMulti * yMulti;

			//apply the movement and rotation
			event.target.style.transform =
				"translate(" +
				event.deltaX +
				"px, " +
				event.deltaY +
				"px) rotate(" +
				rotate +
				"deg)";
		});

		//when you're done with the panning event
		hammertime.on("panend", function (event) {
			//remove the 'moving' class from the card
			el.classList.remove("moving");
			//remove the love and nope classes from the rest of the cards just in case something happened where they stayed
			tinderContainer.classList.remove("tinder_love");
			tinderContainer.classList.remove("tinder_nope");

			//set var for width of the body (including padding)
			var moveOutWidth = document.body.clientWidth;

			//determine if the card should be kept on screen. (Gotta be changed by a certain amount and be moving)
			var keep = Math.abs(event.deltaX) < 80 || Math.abs(event.velocityX) < 0.5;

			//toggle the removed class if the keep var has not evaluated to true
			event.target.classList.toggle("removed", !keep);

			//if the keep value evaluates true, set transform to nothing
			if (keep) {
				event.target.style.transform = "";
			} else {
				//if it's not being kept onscreen, move it on out
				//calculate all of the movements and whatnot
				var endX = Math.max(Math.abs(event.velocityX) * moveOutWidth, moveOutWidth);
				var toX = event.deltaX > 0 ? endX : -endX;
				var endY = Math.abs(event.velocityY) * moveOutWidth;
				var toY = event.deltaY > 0 ? endY : -endY;
				var xMulti = event.deltaX * 0.03;
				var yMulti = event.deltaY / 80;
				var rotate = xMulti * yMulti;

				event.target.style.transform =
					"translate(" +
					toX +
					"px, " +
					(toY + event.deltaY) +
					"px) rotate(" +
					rotate +
					"deg)";

				//add the card to the back
				addNewCard(event.target);
			}
		});
	});
}

//run the addHammers to allow card movement
addHammers();

//function for the love and hate buttons
function createButtonListener(love) {
	return function (event) {
		//if the card is not given the removed class
		var cards = document.querySelectorAll(".tinder--card:not(.removed)");

		//the body width (including padding) multiplied by 1.5
		var moveOutWidth = document.body.clientWidth * 1.5;

		//if there are no more cards, do nothing
		// if (!cards.length) return false;

		//only operate on the current card
		var card = cards[0];

		//add the removed class to the current card
		card.classList.add("removed");

		//if love (true) has been passed in,
		if (love) {
			//move the card right and rotate it
			card.style.transform =
				"translate(" + moveOutWidth + "px, -100px) rotate(-30deg)";
			//if nope (false) has been passed in,
		} else {
			//move the card left and rotate it
			card.style.transform =
				"translate(-" + moveOutWidth + "px, -100px) rotate(30deg)";
		}

		//intitialize cards again to determine the top card (and add a new one)
		addNewCard(card);

		//prevent the default action from happening for the button
		event.preventDefault();
	};
	
}

//create love and nope button listeners
var nopeListener = createButtonListener(false);
var loveListener = createButtonListener(false);

//add click events to love and nope buttons
nope.addEventListener("click", nopeListener);
love.addEventListener("click", loveListener);

document.querySelector(".closeMe").addEventListener("click", function () {
	toggleInfoClose(true);
});
document.querySelector(".covering").addEventListener("click", function () {
	toggleInfoClose(true);
});
document.querySelector("#info").addEventListener("click", function () {
	toggleInfoClose(false);
});

function toggleInfoClose(bool) {
	if (!bool) {
		document.querySelector(".tinder--card").style.top = "50%";
	} else {
		document.querySelector(".tinder--card").style.top = "200vh";
	}
}

//stuff to prompt the user to swipe
//Shows the animation if your mouse is still for 15 seconds/hides it when you move
let fadein = null;

const myFunction = (fadeOutTime, fadeInAfterTime) => {
	document.querySelector(".promptBox").style.transition = fadeOutTime + "ms";
	document.querySelector(".promptBox").style.opacity = "0";
	if (fadein != null) {
		clearTimeout(fadein);
	}
	fadein = setTimeout(showMe, fadeInAfterTime);
};

const showMe = () => {
	document.querySelector(".promptBox").style.opacity = "1";
};

document.querySelector("body").addEventListener("mousemove", function () {
	myFunction(300, 15000);
});
document.querySelector("body").addEventListener("click", function () {
	myFunction(300, 15000);
});
document.querySelector("body").addEventListener("touchstart", function () {
	myFunction(300, 15000);
});
document.querySelector("body").addEventListener("touchmove", function () {
	myFunction(300, 15000);
});
    
</script>



