<?php
include($_SERVER['DOCUMENT_ROOT']."/includes/init.php");

$CheckBoxListBuilder = new checkBoxListBuilder($db);
//echo $Journal->getCheckBoxGroup();

?>

<!DOCTYPE html>
<html lang="en">
<header>
<?php include($_SERVER['DOCUMENT_ROOT']."/includes/headElements.php"); ?>

<script>
var checkBoxIndex = 0;
var KeyPressFunctions = [];
var mode = "add";
var flow = "start";
var saveStarted = false;
var parentID = null;
var currentAddSpot = null;
var oldContainer;
var hoveringOverListItem = [];
KeyPressFunctions[13] = function keyPressEnter(){
	if(flow == "build"){
		saveCheckBox();
	}else if(flow == "start"){
		addNewCheckBox();
	}
}

KeyPressFunctions[9] = function keyPressTab(){
	if(flow == "build"){
//		parentID = data;
//		currentAddSpot = "checkBoxFamily-"+checkBoxIndex;
//		addNewCheckBox(currentAddSpot);
	
	} 
} 
	KeyPressFunctions[27] = function keyPressTab(){
	if(flow == "build"){
		leaveEdit();
	}
}
$(function(){
	$(".checkBoxOptions").hide();
	$("#checkBoxEditMenu").hide();
	menuHeight = $("#checkBoxEditMenu").height();

//MENU Handle:
	$(document).on("mouseenter",".checkBoxListItem",function(){
		console.log('gogo');
		var this_ = $(this);
		var index = $(this).attr("data-checkBox");
		hoveringOverListItem[index] = true;
		setTimeout(
			function(){
				if(hoveringOverListItem[index]){
					var position = this_.position();
					$("#checkBoxEditMenu").fadeOut("fast",function(){
						$("#checkBoxEditMenu").css({'top':position.top+(28),'left':position.left+25});
						$("#checkBoxEditMenu").fadeIn("fast");
					});
				}
			},
			400
		);
	});
	$(document).on("mouseleave",".checkBoxListItem",function(){
		var index = $(this).attr("data-checkBox");
		hoveringOverListItem[index] = false;
		$(this).find(".checkBoxOptions").hide();
	});

	$(document).on("mouseleave","#checkBoxEditMenu",function(){
		lockMenuOpen = false;
		$(".checkBoxOptions").hide();
		$(this).fadeOut("fast");
	});
	
//Menu Handle End.
	$(document).on('keydown','body',handleInEditKeyPress);
	$(document).on("focusout",'.checkBoxKeyEdit',function(){
		if(!saveStarted){
			leaveEdit();
		}
	});
	var checkBoxGroup = $("ol.sortableList").sortable({
		group: 'mainPage',
		delay: 100,
		onDrop: function  ($item, container, _super) {
		   var $clonedItem = $('<li/>').css({height: 0});
		   $item.before($clonedItem);
         $clonedItem.animate({'height': $item.height()});

         $item.animate($clonedItem.position(), function  () {
				$clonedItem.detach();
				var data = checkBoxGroup.sortable("serialize").get();
				saveResort(data);
				_super($item, container);
			});
			container.el.removeClass("active");
		},
//	    set $item relative to cursor position
		onDragStart: function ($item, container, _super) {
			var offset = $item.offset(),
			pointer = container.rootGroup.pointer;
			adjustment = {
				left: pointer.left - offset.left,
				top: pointer.top - offset.top
			 };
			 _super($item, container);
		},
  	   onDrag: function ($item, position) {
         $item.css({
				left: position.left - adjustment.left,
				top: position.top - adjustment.top
			});
		},
		afterMove: function (placeholder, container) {
			if(oldContainer != container){
				if(oldContainer)
					oldContainer.el.removeClass("active");
				container.el.addClass("active");
				oldContainer = container;
			}
	   },
	});
});

function saveResort(data){
	console.log("gogo");
	$.ajax({
		type:"POST",
		url:"ajax/saveResort.php",
		data: {
			itemSort :data,
		},
		success: function(e){
			console.log(e);
			
		}
	})
}

function handleInEditKeyPress(event){
	var keyCode = event.keyCode || event.which;
	if(flow == "build" && keyCode == 9){
		event.preventDefault();
		event.stopPropagation();
	}
	if(KeyPressFunctions[keyCode]){
		KeyPressFunctions[keyCode].call();
	}
}

function leaveEdit(){
	flow = "start";
	parentID = null;
	currentAddSpot = null;
	$("#addNewCheckBox-btn").fadeIn();	
	$("#checkBox-li-"+checkBoxIndex).children().fadeOut("fast",function(){
		$("#checkBox-li-"+checkBoxIndex).slideUp("fast",function(){
			$("#checkBox-li-"+checkBoxIndex).remove();
		});
	});
}

function saveCheckBox(){
	saveStarted = true;
	var checkBoxName = $("#checkBox-input-"+checkBoxIndex).val();
	if(!checkBoxName){
		alert("please input text for this checkbox");
		return;
	}
	$.ajax({
			type:"POST",
			url: "ajax/saveCheckBox.php",
		data:{
			mode:mode,
			checkBoxName:checkBoxName,
			parentID: parentID,
		},
		success:function(data){
			console.log(data);
			if(data != "_failure"){
				$("#checkBox-lbl-"+checkBoxIndex).html('');
				$("#checkBox-lbl-"+checkBoxIndex).html(checkBoxName);
				$("#checkBox-"+checkBoxIndex).attr("data-checkBoxID",data);
				//TODO FIX THIS:
				flow = "start";
				addNewCheckBox(currentAddSpot);
				saveStarted = false;
			}
		}
	});  
}

function addNewCheckBox(addToArea){
	flow = "build";
	if(!addToArea){
		addToArea = "onTheTable";
	}
	if($("#noCheckBoxMessage").length){ ;
		$("#noCheckBoxMessage").remove();
	} 
	checkBoxIndex--;
	$.ajax({
		type:"POST",
		url: "ajax/getNewCheckBox.php",
		data:{
			curIndex:checkBoxIndex
		},
		success:function(data){
			var idName = "checkBox-li-"+checkBoxIndex;
			$('#'+addToArea).append("<li id='"+idName+"' class='checkBox-li-new'></li>");
			$("#"+idName).hide();
			$("#"+idName).slideDown("fast",function(){
				$("#"+idName).hide();
				$("#"+idName).html(data).promise().done(function(){
					idName = "#checkBox-input-"+checkBoxIndex;
					$(idName).focus();
				});
				$("#"+idName).fadeIn("fast");
			});
			$("#addNewCheckBox-btn").fadeOut("fast");
			$("#"+idName).removeClass("checkBox-li-new");
			$("#"+idName).addClass("checkBox-li");
		}
	});
}

function shiftEditRight(){
	
}

function shifEditLeft(){
	
}
</script>
</header>
<body>
<!--////////////////////////////BEGINCONTENT/////////////////////////////-->
<?php include($_SERVER['DOCUMENT_ROOT']."/includes/header.php"); ?>
<div id="checkBoxLeft" class="leftCol">
	<div class="col-content">
		
			<?php include($_SERVER['DOCUMENT_ROOT']."/home/r/leftCheckBoxes.php"); ?>
	</div>
</div>
<div id="checkBoxRight" class="rightCol">
	<div class="col-content">
		<div class="centerMe">
			<h1>In the Shoot</h1>
		</div>
		<div class="checkBoxArea">
			
		</div>
		<?php // include($_SERVER['DOCUMENT_ROOT']."/home/r/rightCheckBoxes.php"); ?>
	</div>
</div>
<form method="post" action="test.php">
	<input type="hidden" name="test" value="test2"/>
	<button type="submit" >GO</button>
</form>
<!--////////////////////////////ENDCONTENT/////////////////////////////-->
</body>
</html>