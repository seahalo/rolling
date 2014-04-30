function quickQuery()
{
	function handleResponse(data){
		document.getElementById("packages").innerHTML=data;
	}

	var package_record = {
			deliver_time_start: $('input[name="start_date"]').val(),
			deliver_time_end: $('input[name="end_date"]').val()
	};
	jQuery.post("/rolling/service/RLPackageQuery.php", package_record, handleResponse);

}

function quickQueryWithPackageId()
{
	function handleResponse(data){
		document.getElementById("packages").innerHTML=data;
	}

	var package_record = {
			query_package_id: $('input[name="query_package_id"]').val(),
	};
	jQuery.post("/rolling/service/PackageQueryQWithPackageID.php", package_record, handleResponse);

}


function newPackage()
{
	function newPackageResponse(data){
		document.getElementById("packages").innerHTML=data;
	}

	var package_record = {
			package_id: $('input[name="package_id"]').val(),
			delivery_time: $('input[name="delivery_time"]').val(),
			package_type: $('input[name="package_type"]').val(),
			delivery_fee: $('input[name="delivery_fee"]').val(),
			courier_fee: $('input[name="courier_fee"]').val(),
			telephone: $('input[name="telephone"]').val(),
			package_from: $('select[name="package_from"] option:selected').text(),  


			package_to: $('select[name="package_to"] option:selected').text(),
			misc: $('textarea[name="misc"]').val()
	};
	jQuery.post("/rolling/service/RLAddPackage.php", package_record, newPackageResponse);
}

function displayPackageTraceResponse(data){
	eval("jsonReturn="+data);
	
	// Compose the table
	
	var tbl_body = "";
    $.each(jsonReturn['rows'], function() {
        var tbl_row = "";
        $.each(this, function(k , v) {
            tbl_row += "<td>"+v+"</td>";
        })
        tbl_body += "<tr>"+tbl_row+"</tr>";                 
    })
    
    	
    var tbl_col = "<tr>";
    $.each(jsonReturn['columns'], function(k, v) {
    	tbl_col += "<th>" + v + "</th>";
    });
    tbl_col += "</tr>";

    var tbl = "<table>";

    tbl += tbl_col;
    tbl += tbl_body;
    
    tbl += "</table>";
    
    $("#package_trace_table").html(tbl);

}

function newPackageTraceResponse(data){

	//converts the JSON string to a JavaScript object
	eval("jsonReturn="+data);

	// Update the trace table.
	jQuery.get("/rolling/service/RLDisplayPackageTrace.php", jsonReturn, displayPackageTraceResponse);
}


function newPackageTrace()
{

	var package_trace_record = {
			package_id: $('div#new_trace_div label[name="package_id"]').text(),
			package_from: $('div#new_trace_div select[name="package_from"] option:selected').text(),
			package_to: $('div#new_trace_div select[name="package_to"] option:selected').text(),
			delivery_time: $('div#new_trace_div input[name="delivery_time"]').val(),
			delivery_fee: $('div#new_trace_div input[name="delivery_fee"]').val(),
			courier_fee: $('div#new_trace_div input[name="courier_fee"]').val(),
	};
	jQuery.post("/rolling/service/RLAddPackageTrace.php", package_trace_record, newPackageTraceResponse);
}


function updatePackage()
{
	function newPackageResponse(data){
		document.getElementById("packages").innerHTML=data;
	}

	var package_record = {
			package_id: $('label[name="package_id"]').text(),
			receive_time: $('input[name="receive_time"]').val(),
			deliver_final_fee: $('input[name="deliver_final_fee"]').val(),
			courier_final_fee: $('input[name="courier_final_fee"]').val(),
			misc: $('textarea[name="misc"]').val()
	};
	jQuery.post("/rolling/service/RLUpdatePackage.php", package_record, newPackageResponse);
}


function printPackageList()
{
	var tableContent = $('#packages table').html();
	tableContent = "<div><table>"  + tableContent + "</table></div>";
	var printingContent = $(tableContent).find('.update').empty().closest('div').html();
	printingContent = "<html>" +
	"<head>" +
	"<title>Rolling/Package Delivery List</title>" +
	"<link href='style.css' type='text/css' rel='stylesheet'>" +
	"</head>" +
	"<body>" + 
	printingContent + 
	"</body>" +
	"</html>"
	w=window.open();
	w.document.write(printingContent);
}


function query_by_region()
{
	function handleResponse(data){
		document.getElementById("users").innerHTML=data;
	}

	var arguments = {
			user_region: $('input[name="user_region"]').val(),
	};
	jQuery.post("/rolling/service/RLQueryUserWithRegion.php", arguments, handleResponse);

}


function newUser()
{
	function handleResponse(data){
		document.getElementById("users").innerHTML=data;
	}

	var package_record = {
			user_name: $('input[name="user_name"]').val(),
			user_password: $('input[name="user_password"]').val(),
			user_region: $('input[name="user_region"]').val(),
			user_group: $('input[name="user_group"]').val(),
	};
	jQuery.post("/rolling/service/RLAddUser.php", package_record, handleResponse);
}


function updateUser()
{
	function newPackageResponse(data){
		document.getElementById("users").innerHTML=data;
	}

	var package_record = {
			user_name: $('label[name="user_name"]').text(),
			user_region: $('input[name="user_region"]').val(),
			user_group: $('input[name="user_group"]').val()
	};
	jQuery.post("/rolling/service/RLUpdateUser.php", package_record, newPackageResponse);
}
