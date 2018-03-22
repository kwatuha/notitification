=$table_colm_idarrax[0].'_id';

$ajaxscript='<script language="javascript">
function lookup_'.$table_name.'_'.$table_colm_id.'('.$table_colm_id.') {
    if('.$table_colm_id.'.length == 0) {
        // Hide the suggestion box.'.
        '$('."'".'#suggestions'."'".').hide();
    } else {
        $.post("'.'../'.$foldername.'/rpc'.$table_name.'.php", {queryString: ""+'.$table_colm_id.'+""}, function(data){
            if(data.length >0) {
                $('."'".'#suggestions'."'".').show();
                $('."'".'#autoSuggestionsList'."'".').html(data);
            }
        });
    }
} // '. $table_name.'   lookup'.'




function fill_'.$table_colm_id.'(thisValue) {
	
    $('."'".'#'.$table_colm_id."'".').val(thisValue);
	
	
   $('."'".'#suggestions'."'".').hide();
}

function fill_hidden'.$table_colm_id.'(thisValue) {
	
    $('."'".'#'.$table_colm_id."hidden'".').val(thisValue);
	
	
   $('."'".'#suggestions'."'".').hide();
}

</script>';

return $ajaxscript;