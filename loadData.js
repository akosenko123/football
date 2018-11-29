$(document).ready(function () {
        loadData();
    });
	var row_proto = '<tr><td class="match-date"></td><td class="match-name"><a href=""></a></td><td class="match-team-1"><a href=""></a></td><td class="match-team-2"><a href=""></a></td><td class="actions"></td></tr>';
	table = $("#user_data tbody");
	
	function display(data) {
		table.empty();
		data.forEach(function(row_data) {
			var row = $(row_proto);
			$('[class=match-date]', row).text(row_data.date);
			$('[class=match-name] a', row).text(row_data.name).attr('href', 'match.php?id=' + row_data.id);
			$('[class=match-team-1] a', row).text(row_data.teams[0]).attr('href', 'team.php?id=' + row_data.id);
			$('[class=match-team-2] a', row).text(row_data.teams[1]).attr('href', 'team.php?id=' + row_data.id);

			row.appendTo(table);
		})
	}

// #############################################
    function loadData() {
        $.ajax({
        type: "GET",
		dataType: 'json',
        url: "db/getAllMatches.php",
        success: display
    });
    }
    

    results += '<tr><td>' + data.id + '</td>\
					<td>' + data.name + '</td>\
					<td>' + data.shortDescription + '</td>\
					<td>\
					<input type="button" name="edit" class="btn btn-grey" value="Edit" onclick="editTraining('+ data.id +')">\
					<input type="button" name="delete" class="btn btn-grey" value="Delete" onclick="deleteTraining(' + data.id +')">'; 