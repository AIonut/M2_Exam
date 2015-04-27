*//Do not delete this:
*// Amol this file shoud be a global one? or we can have 2 header files? one global and one specific for each module?

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<title>Cuprins Biologie</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Rancho' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Damion' rel='stylesheet' type='text/css'>
<!--css files-->
<link rel="stylesheet" type="text/css" href="<?php echo asset_url('css/style.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo asset_url('css/bootstrap.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo asset_url('css/font-awesome.css'); ?>">   
<link rel="stylesheet" type="text/css" href="<?php echo asset_url('css/animate.css'); ?>">
<!--css files end-->
<!-- tab-->
<script>
$('#myTab a').click(function (e) {
	e.preventDefault()
	$(this).tab('show')
})
</script>
<!--tab-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="<?php echo asset_url('js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo asset_url('js/app.js'); ?>"></script>
<script src="<?php echo asset_url('js/jquery-sortable.js'); ?>"></script>
<script>
$(document).ready(function(){
	var oldContainer;
	$(".sortable").sortable({
		group: 'nested',
		afterMove: function (placeholder, container) {
		if(oldContainer != container){
		  if(oldContainer)
			oldContainer.el.removeClass("active")
		  container.el.addClass("active")
		  
		  oldContainer = container
		}
		},
		onDrop: function (item, container, _super) {
		container.el.removeClass("active")
		_super(item)
		}
	});
	
    $(".hover_button .adding").click(function(){
		var parent 		= $(this).attr("data-id");
		var discipline  = $('.search_filter .discipline button.selected').attr('value');

        $("#add_lesson").toggle(200);
		$('#addLesson').find('#parent').val(parent);
		$('#addLesson').find('#discipline').val(discipline);
    });
	
	$("#add_parent").click(function(){
		var parent 		= 0;
		var discipline  = $('.search_filter .discipline button.selected').attr('value');

        $("#add_lesson").toggle(200);
		$('#addLesson').find('#parent').val(parent);
		$('#addLesson').find('#discipline').val(discipline);
    });
	
	$(".hover_button .edit").click(function(){
		var id	= $(this).attr("data-id");

        $("#edit_lesson").toggle(200);
		$('#editLesson').find('#row_id').val(id);
		
		$.post(
            '<?php echo base_url(); ?>index.php/m4_table_of_contents_lesson/get_lesson',
            {
				"id" : id
            },
            function( response ) {
                //do something with data/response returned by server
				$.each(response, function(id1, rec){ 
					//alert( id1 + '=' + rec);
					if(id1 == 'titlu') { $('#edit_lesson').find('#edittitle').val(rec); }
					if(id1 == 'style') {
						if(rec == 'active') { $('#editstyle').prop("checked", true); }
					}
					if(id1 == 'style2') {
						$('#edit_lesson').find('#editstyle2_name').val(rec);
					}
					if(id1 == 'profile') {
						var profile = rec.split(',');
						$('#editLesson').find(':checkbox[name^="editprofile"]').each(function () {
							$(this).prop("checked", ($.inArray($(this).val(), profile) != -1));
						})
					}
					if(id1 == 'official_level') {
						var official_level = rec.split(',');
						$('#editLesson').find(':checkbox[name^="editknowledgelevel"]').each(function () {
							$(this).prop("checked", ($.inArray($(this).val(), official_level) != -1));
						})
					}
				})
            },
            'json'
        );

    });
	
	$(".hover_button .delete").click(function(){
		var id	= $(this).attr("data-id");
		var ok = confirm('Esti sigur ca vrei sa stergi acest capitol/subcapitol ?');
		if(ok) {
			$.post('<?php echo base_url(); ?>index.php/m4_table_of_contents_lesson/delete_lesson', { id: id }, function() {
				window.location.reload();
			});
		}
	});		
	
	$(".close-setting").click(function(){
        $(".hover_setting").hide(200);
    });
	
	$('.search_filter .discipline button ').click(function(){
    	$('.search_filter .discipline button ').removeClass('selected');
    	$(this).addClass('selected');
	});
	$('.search_filter .profile button ').click(function(){
    	$('.search_filter .profile button ').removeClass('selected')
    	$(this).addClass('selected');
	});
	$('.search_filter .level-filter > button ').click(function(){
    	$('.search_filter .level-filter > button ').removeClass('selected')
    	$(this).addClass('selected');
	});
	
	$('.search_filter button').click(function(){
		var discipline  	= $('.search_filter .discipline button.selected').attr('value');
		var profile			= $('.search_filter .profile button.selected').attr('value');
		var knowledgelevel	= $('.search_filter .level-filter button.selected').attr('value');		

		$('#discipline').val(discipline);
		$('#profile').val(profile);
		$('#knowledgelevel').val(knowledgelevel);
		$('#search_filter').submit();
	});
	
	// font family change
	$('.font-family').on('change', function(){
    $('.hover_setting input[type="text"]').css('font-family', $(this).val()); // for textbox
});
});
$(document).on('submit', '#addLesson', function(e) {
		
		e.preventDefault();
		$("#adderror").empty();
        
 		var profile = new Array();
        $("input[name='profile[]']:checked").each(function() {
           profile.push($(this).val());
        });
 		var knowledgelevel = new Array();
        $("input[name='knowledgelevel[]']:checked").each(function() {
           knowledgelevel.push($(this).val());
        });
		
		var parent = $( this).find('#parent' ).val(); //get the id from the line
		var discipline = $( this ).find('#discipline').val();		
		
        $.post(
            $( this ).prop( 'action' ),
            {
                "title": $( this).find('#title' ).val(),
				"style": $( this).find('#style' ).val(),
				"style2": $( this).find('#style2_name' ).val(),					
				"profile": profile,
				"knowledgelevel": knowledgelevel,
				"discipline" : discipline,
				"parent" : parent
            },
            function( response ) {
                //do something with data/response returned by server
				$.each(response, function(idx, rec){									  
					//alert(idx);
					//alert(rec);
					if( idx == "message" ) { 
						$("#adderror").html( rec );
					}
				})

            },
            'json'
        );
 
        //.....
        //do anything else you might want to do
        //.....
        //prevent the form from actually submitting in browser
        return false;
});

$(document).on('submit', '#editLesson', function(e) {

		e.preventDefault();
		$("#editerror").empty();
        
 		var profile = new Array();
        $("input[name='editprofile[]']:checked").each(function() {
           profile.push($(this).val());
        });
 		var knowledgelevel = new Array();
        $("input[name='editknowledgelevel[]']:checked").each(function() {
           knowledgelevel.push($(this).val());
        });
		
		var editstyle = $( this).find('#editstyle' ).is(":checked") ? 'active' : 'inactive';
		
		var id = $( this).find('#row_id' ).val(); //get the id from the line
		
        $.post(
            $( this ).prop( 'action' ),
            {
                "edittitle": $( this).find('#edittitle').val(),
				"editstyle": editstyle,
                "editstyle2": $( this).find('#editstyle2_name').val(),				
				"editprofile": profile,
				"editknowledgelevel": knowledgelevel,
				"id": id
            },
            function( response ) {
                //do something with data/response returned by server
				$.each(response, function(idx, rec){									  
					$("#editerror").append('<li class="error">'+rec+'</li>').slideDown('slow');
				})

            },
            'json'
        );
 
        //.....
        //do anything else you might want to do
        //.....
        //prevent the form from actually submitting in browser

        return false;
});
</script>

<!--scroll-->

<script src="<?php echo asset_url('js/multiaccordion.jquery.min.js'); ?>"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$(".accordion").multiaccordion();
});
</script>
<!--Select box-->
<script type="text/javascript">
    $(document).ready(function(){
        $(".custom-select").each(function(){
            $(this).wrap("<span class='select-wrapper'></span>");
            $(this).after("<span class='holder'></span>");
        });
        $(".custom-select").change(function(){
            var selectedOption = $(this).find(":selected").text();
            $(this).next(".holder").text(selectedOption);
        }).trigger('change');
    })
</script>
</head>
<body>
<header>
    <div class="top">
    <div class="col-xs-3 top1"></div>
	<div class="col-xs-2 top2"></div>
	<div class="col-xs-2 top3"></div>
	<div class="col-xs-2 top2"></div>
	<div class="col-xs-3 top1"></div>
	<div class="clearfix"></div>
 </div>
<div class="head1">
<div class="row">
	<div class="col-sm-5 head1-lf">
		<ul class="top-listing">
			<li>Timp ramas: <span>2 zile</span></li>
			<li>Experienta: <span>2504</span></li>
			<li>atp: <span>154</span></li>
		</ul>
   </div>
<div class="col-sm-7 head1-rt">
	<div class="login">
	<?php if( $this->session->userdata('user_id') == "" ) {?>
		<form action="<?=site_url('M0_user/login')?>" method="post">
			<label>Log in</label>	 
			<input type="text" name="l_email" value="<?=set_value('l_email') ?>" placeholder="User name"/>
			<input type="password" name="l_pass" placeholder="Parola"/>	 
			<div class="gobutton">	  
				<input type="submit" class="go"  value="go"/>
				<input type="button" class="register" value="Inregistrare" onClick="window.location.href='<?=site_url('M0_user/register')?>'">	
			</div>
			<div class="clearfix"></div>
		</form>
	<?php } else { ?>
		<label><?php echo "Welcome ".$this->session->userdata('username');?></label>&nbsp;&nbsp;
		<a href="<?=site_url('M0_user/logout')?>" style="float: right;">logout</a>
	<?php }  ?>			
	</div> 
</div>
   <div class="clearfix"></div>
   </div>
 </div>
 <div class="head2">
 <div>
   <div class="col-md-2 col-sm-4 logodiv">
     <a href="<?=base_url()?>" class="logo">logo</a>
   </div>
   <div class="col-md-10 col-sm-8 menu">
         <!-- Static navbar -->
      <nav class="navbar navbar-default">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
           </div>
          <div id="navbar" class="navbar-collapse collapse menus">
            <ul class="nav navbar-nav">
              <li><a href="#">ACASA</a></li>
              <li class="parent"><a href="#">invata online</a>
			  <ul class="submenu">
			  <li> <a href="#">Lectii online</a> </li>
				<li> <a href="#">Manuale explicate</a> </li>				
				</ul>
			  </li>
              <li class="active parent"><a href="#">Notitele mele</a>
			   <ul class="submenu">
				<li> <a href="#">Sinteze mele</a> </li>
				<li> <a href="#">Manualele mele</a> </li>
				<li> <a href="#">Lectiile mele</a> </li>
				<li> <a href="#">Culegere mele</a> </li>
			</ul>
			  </li>
			  <li><a href="#">Sinteze</a></li>
			  <li><a href="#">grilele online</a> </li>
			  <li class="parent"><a href="#">simulare admitere</a>
			    <ul class="submenu">
				<li> <a href="#">Examen nou</a> </li>
				<li> <a href="#">Din anii trecuti</a> </li>
				<li> <a href="#">Simulare olimpiada</a> </li>
				
			</ul>
			  </li>
			  </ul>
            </div><!--/.nav-collapse -->
      
      </nav>
   </div>
   <div class="clearfix"></div>
   </div>
</div>
</header>