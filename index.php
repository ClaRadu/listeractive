<!DOCTYPE html>
<html>
<head>
	<title>Listeractive - interactive list example by CRG</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
// show all elements in the list
function showlst(val, select) {
    if (val == 0) { 
		$('#lstshow').text('nothing to show');
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
//				console.log(this.response);
				var response = JSON.parse(this.responseText);
				// show list on screen
//					var $li;
				if (select) {
					var $lst = $('#lstsel').text(''); // clear old data
					$.each(response, function (id, elem) {
/*						$li = $('<li><li>');
						$li.append('<input type="checkbox" name="id#'+elem['id']+'" value="'+elem['active']+'"/> '+elem['name']);
						$li.appendTo($lst); */
						$lst.append('<li><input type="checkbox" id="id#'+elem['id']+'" value="'+elem['active']+'"/> '+elem['name']+'</li>');
						// check / uncheck controls according to data inside the users table
						if (elem['active'] == 1)
							document.getElementById('id#'+elem['id']).checked = true;
						else
							document.getElementById('id#'+elem['id']).checked = false;
					});
				} else {
					var $lst = $('#lstshow').text(''); // clear old data
					$.each(response, function (id, elem) {
/*						$li = $('<li><li>');
						$li.append(elem['name']);
						$li.appendTo($lst); */
						$lst.append('<li>'+elem['name']+'</li>');
					});
					console.log('add data');
				}
            }
        };
        xmlhttp.open("GET", "scripts/list.php?show="+val, true);
        xmlhttp.send();
    }
}

// update list
function updatelst(id, val) {
	var xhr = new XMLHttpRequest(), method = "GET", url = "scripts/list.php?insid="+id+'&inval='+val;

	xhr.open(method, url, true);
	xhr.onreadystatechange = function () {
		if(xhr.readyState === 4 && xhr.status === 200) {
			console.log(xhr.responseText);
//			document.getElementById('info').innerHTML  = this.responseText; // show response in html element
//			showlst(1, false); // show changes on screen
		}
	};
	xhr.send();
}	

$(document).ready( function() {
	// verify if checkbox has been clicked
//	$('input:checkbox').click( function () { console.log('checkbox clicked'); });
	$(document).on('click', 'input:checkbox', function() {
		console.log('checkbox clicked');
		var aid = (this.id).split('#');
		var val = 1;
		if (this.value == val) val = 0;
		// update data
		updatelst(aid[1], val);
		// refresh page
		location.reload();
	});

	// show all data when page loads
	var shw = 2; // 2 means show all
	showlst(shw, true);
	showlst(1, false); // show enabled
});
</script>
</head>
<body>

<div class='form-group'>
	<p>&nbsp; Add or remove elements to/from the list below:</p>
	<ul id='lstsel' style="list-style-type:none;"></ul>
</div>

<p><b>&nbsp; Selected elements are shown here:</b></p>
<div class='form-group' style='overflow-y:scroll; height: 100px;'>
	<ul id='lstshow'></ul>
	<p id='info'></p>
</div>

<small><a href='http://crgames.elementfx.com/extra'>CRG</a> @ 2019</small>

</body>
</html>
