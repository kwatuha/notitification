<script language="javascript">
function lookup_attachments_attachments(attachments_id) {
    if(attachments_id.length == 0) {
        // Hide the suggestion box.$('#suggestions').hide();
    } else {
        $.post("../attachments/rpcattachments_attachments.php", {queryString: ""+attachments_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // attachments_attachments   lookup




function fill_attachments_id(thisValue) {
	
    $('#attachments_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenattachments_id_hidden(thisValue) {
	
    $('#attachments_id_hidden).val(thisValue);
	
	
   $('#suggestions').hide();
}

</script><script language="javascript">
function lookup_bank_bank(bank_id) {
    if(bank_id.length == 0) {
        // Hide the suggestion box.$('#suggestions').hide();
    } else {
        $.post("../bank/rpcbank_bank.php", {queryString: ""+bank_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // bank_bank   lookup




function fill_bank_id(thisValue) {
	
    $('#bank_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenbank_id_hidden(thisValue) {
	
    $('#bank_id_hidden).val(thisValue);
	
	
   $('#suggestions').hide();
}

</script><script language="javascript">
function lookup_bank_branch(branch_id) {
    if(branch_id.length == 0) {
        // Hide the suggestion box.$('#suggestions').hide();
    } else {
        $.post("../bank/rpcbank_branch.php", {queryString: ""+branch_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // bank_branch   lookup




function fill_branch_id(thisValue) {
	
    $('#branch_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenbranch_id_hidden(thisValue) {
	
    $('#branch_id_hidden).val(thisValue);
	
	
   $('#suggestions').hide();
}

</script><script language="javascript">
function lookup_company_company(company_id) {
    if(company_id.length == 0) {
        // Hide the suggestion box.$('#suggestions').hide();
    } else {
        $.post("../company/rpccompany_company.php", {queryString: ""+company_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // company_company   lookup




function fill_company_id(thisValue) {
	
    $('#company_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddencompany_id_hidden(thisValue) {
	
    $('#company_id_hidden).val(thisValue);
	
	
   $('#suggestions').hide();
}

</script><script language="javascript">
function lookup_company_employee(employee_id) {
    if(employee_id.length == 0) {
        // Hide the suggestion box.$('#suggestions').hide();
    } else {
        $.post("../company/rpccompany_employee.php", {queryString: ""+employee_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // company_employee   lookup




function fill_employee_id(thisValue) {
	
    $('#employee_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenemployee_id_hidden(thisValue) {
	
    $('#employee_id_hidden).val(thisValue);
	
	
   $('#suggestions').hide();
}

</script><script language="javascript">
function lookup_events_event(event_id) {
    if(event_id.length == 0) {
        // Hide the suggestion box.$('#suggestions').hide();
    } else {
        $.post("../events/rpcevents_event.php", {queryString: ""+event_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // events_event   lookup




function fill_event_id(thisValue) {
	
    $('#event_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenevent_id_hidden(thisValue) {
	
    $('#event_id_hidden).val(thisValue);
	
	
   $('#suggestions').hide();
}

</script><script language="javascript">
function lookup_insurance_client(client_id) {
    if(client_id.length == 0) {
        // Hide the suggestion box.$('#suggestions').hide();
    } else {
        $.post("../insurance/rpcinsurance_client.php", {queryString: ""+client_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // insurance_client   lookup




function fill_client_id(thisValue) {
	
    $('#client_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenclient_id_hidden(thisValue) {
	
    $('#client_id_hidden).val(thisValue);
	
	
   $('#suggestions').hide();
}

</script><script language="javascript">
function lookup_insurance_insurer(insurer_id) {
    if(insurer_id.length == 0) {
        // Hide the suggestion box.$('#suggestions').hide();
    } else {
        $.post("../insurance/rpcinsurance_insurer.php", {queryString: ""+insurer_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // insurance_insurer   lookup




function fill_insurer_id(thisValue) {
	
    $('#insurer_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddeninsurer_id_hidden(thisValue) {
	
    $('#insurer_id_hidden).val(thisValue);
	
	
   $('#suggestions').hide();
}

</script><script language="javascript">
function lookup_insurance_policy(policy_id) {
    if(policy_id.length == 0) {
        // Hide the suggestion box.$('#suggestions').hide();
    } else {
        $.post("../insurance/rpcinsurance_policy.php", {queryString: ""+policy_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // insurance_policy   lookup




function fill_policy_id(thisValue) {
	
    $('#policy_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenpolicy_id_hidden(thisValue) {
	
    $('#policy_id_hidden).val(thisValue);
	
	
   $('#suggestions').hide();
}

</script><script language="javascript">
function lookup_insurance_policytype(policytype_id) {
    if(policytype_id.length == 0) {
        // Hide the suggestion box.$('#suggestions').hide();
    } else {
        $.post("../insurance/rpcinsurance_policytype.php", {queryString: ""+policytype_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // insurance_policytype   lookup




function fill_policytype_id(thisValue) {
	
    $('#policytype_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenpolicytype_id_hidden(thisValue) {
	
    $('#policytype_id_hidden).val(thisValue);
	
	
   $('#suggestions').hide();
}

</script><script language="javascript">
function lookup_insurance_product(product_id) {
    if(product_id.length == 0) {
        // Hide the suggestion box.$('#suggestions').hide();
    } else {
        $.post("../insurance/rpcinsurance_product.php", {queryString: ""+product_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // insurance_product   lookup




function fill_product_id(thisValue) {
	
    $('#product_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenproduct_id_hidden(thisValue) {
	
    $('#product_id_hidden).val(thisValue);
	
	
   $('#suggestions').hide();
}

</script><script language="javascript">
function lookup_insurance_risk(risk_id) {
    if(risk_id.length == 0) {
        // Hide the suggestion box.$('#suggestions').hide();
    } else {
        $.post("../insurance/rpcinsurance_risk.php", {queryString: ""+risk_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // insurance_risk   lookup




function fill_risk_id(thisValue) {
	
    $('#risk_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenrisk_id_hidden(thisValue) {
	
    $('#risk_id_hidden).val(thisValue);
	
	
   $('#suggestions').hide();
}

</script><script language="javascript">
function lookup_user(id_id) {
    if(id_id.length == 0) {
        // Hide the suggestion box.$('#suggestions').hide();
    } else {
        $.post("../user/rpcuser.php", {queryString: ""+id_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // user   lookup




function fill_id(thisValue) {
	
    $('#id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenid_hidden(thisValue) {
	
    $('#id_hidden).val(thisValue);
	
	
   $('#suggestions').hide();
}

</script>