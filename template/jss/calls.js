
<SCRIPT LANGUAGE="javascript">
	function lookup(caller) {
		if(caller.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("rpc.php", {queryString: ""+caller+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} // lookup
	
	function fill(thisValue) {
		$('#caller').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}
	function fill_company(thisValue) {
		$('#company').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}
	function fill_telephone(thisValue) {
		$('#telephone').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}
	function lookup_recipient(recipient) {
		if(recipient.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("rec_rpc.php", {queryString: ""+recipient+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} // lookup
	
	function fill_recipient(thisValue) {
		$('#recipient').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}
</SCRIPT>