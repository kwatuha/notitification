<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>jQuery UI Draggable - Default functionality</title>
	<link rel="stylesheet" href="../template/ui/themes/custom-theme/jquery.ui.all.css">
	<script src="../template/js/jquery-1.6.2.min.js"></script>
	<script src="../template/ui/jquery.ui.core.js"></script>
	<script src="../template/ui/jquery.ui.widget.js"></script>
	<script src="../template/ui/jquery.ui.mouse.js"></script>
	<script src="../template/ui/jquery.ui.draggable.js"></script>
	<script src="../template/ui/jquery.ui.droppable.js"></script>
	<style>
	#draggable { width: 150px; height: 150px; padding: 0.5em; }
	</style>
	<script>
	$(function() {
		$( "#draggable" ).draggable();
		
	});
	
	
	$(function() {
		$( "#draggable2" ).draggable();
		
	});
	function insertAtCursor(myField, myValue) {
//IE support
			if (document.selection) {
			myField.focus();
			sel = document.selection.createRange();
			sel.text = myValue;
			}
			//MOZILLA/NETSCAPE support
			else if (myField.selectionStart || myField.selectionStart == '0') {
			var startPos = myField.selectionStart;
			var endPos = myField.selectionEnd;
			myField.value = myField.value.substring(0, startPos)+ myValue+ myField.value.substring(endPos, myField.value.length);
			} else {
			myField.value += myValue;
			}
}


   var obj=document.getElementById('testd');
  insertAtCursor(obj,100);
	</script>
	<script>
	$(function() {
		$( "#draggable3" ).draggable();
		$( "#testd" ).draggable();
		
		
		$(document).mousemove(function(e){
      $('#status').val(e.pageX +', '+ e.pageY);
   }); 
		$( "#droppable" ).droppable({
			drop: function( event, ui ) {
				$( this )
					.addClass( "ui-state-highlight" )
					.find( "p" )
						.html( "Dropped!" );
			}
		});
	});
	</script>
	<script type="text/javascript">
/*jQuery(document).ready(function(){
   $(document).mousemove(function(e){
      $('#status').html(e.pageX +', '+ e.pageY);
   }); 
})*/
</script>


</head>
<body>
<input type="text" id="status">
<div class="demo">

<div id="draggable" class="ui-widget-content">
	<p>Drag me around</p>
</div>
</div><!-- End demo -->
<div class="demo-description">
<p>Enable draggable functionality on any DOM element. Move the draggable object by clicking on it with the mouse and dragging it anywhere within the viewport.</p>
</div><!-- End demo-description -->
//////////////////////////////////////////////////
<div id="draggable2" class="ui-widget-content">
test<input type="text" id="testd" name="232232" />
</div>
<div class="demo">
	
<div id="draggable3" class="ui-widget-content">
	<p>Drag me to my target</p>
</div>

<div id="droppable" class="ui-widget-header">
	<p>Drop here</p>
</div>

</div><!-- End demo -->



<div class="demo-description">
<p>Enable any DOM element to be droppable, a target for draggable elements.</p>
</div><!-- End demo-description -->


</body>
</html>