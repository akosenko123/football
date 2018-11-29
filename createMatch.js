$('#add').click(function () {
  var html = '<tr>';
  html += '<td contenteditable id="data1"></td>';
  html += '<td contenteditable id="data2"></td>';
  html += '<td contenteditable id="data3"></td>';
  html += '<td contenteditable id="data4"></td>';
  html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Save</button></td>';
  html += '</tr>';
  $('#user_data tbody').prepend(html);
});

$(document).on('click', '#insert', function () {
  var date = $('#data1').text();
  var name = $('#data2').text();
  var team_1 = $('#data3').text();
  var team_2 = $('#data4').text();

  if (date != '' && name != '' && team_1 != '' && team_2 != '') {
    $.ajax({
      url    : "db/createMatch.php",
      method : "POST",
      data   : {date: date, name: name, team_1: team_1, team_2: team_2},
      success: function (data) {
        $('#alert_message').html('<div class="alert alert-success">' + data + '</div>');
        $('#user_data').DataTable().destroy();
        loadData();
      }
    });
    setInterval(function () {
      $('#alert_message').html('');
    }, 5000);
  } else {
    alert("Fill in all the fields");
  }
});