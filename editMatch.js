function update_data(date, name, team_1, team_2)
  {
   $.ajax({
    url:"db/editMatch.php",
    method:"POST",
    data:{date:date, name:name, team_1:team_1, team_2:team_2},
    success:function(data)
    {
     $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
     $('#user_data').DataTable().destroy();
     loadData();
    }
   });
   setInterval(function(){
    $('#alert_message').html('');
   }, 5000);
  }

  $(document).on('blur', '.update', function(){
   var date = $(this).text("date");
   var name = $(this).text("name");
   var team_1 = $(this).text("team_1");
   var team_2 = $(this).text("team_2");
   update_data(date, name, team_1, team_2);
  });