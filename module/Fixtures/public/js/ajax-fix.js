$(document).ready(function () {

  // dodawanie meczów	
	$('#submit_fix').click(function(){
    $('#loader_fix').show();
    round = $("#round").val();    
    var pattern = new RegExp(/^[0-9]+$/);
    if (!pattern.test(round)) {
      $('#alert_fix').show();
      return false;
    }
    content = $("#content1").val();   
    $.ajax({
      type: "POST",
      url: "/fixtures/ajaxAddMany",
      dataType : 'json',
      data : {
          round: round,
          content: content 
      },     
      success: function(json)
      {
        if(json['wynik'] == "success") { 
        	$('#alert_content').hide(); 
            window.location.replace("/fixtures")    
        } else if(json['wynik'] == "fail") { 
            $('#alert_content').show(); 
            $('#loader_fix').hide();   
        }
      },
      error: function(data){
        alert("fatal error"); 
      }
    });    
  });

  // wybór kolejki
  $('#roundChoose').change(function(){
    $('.fix-loader').show();
    value1 = $(this).val();    
    $.ajax({
      type: "POST",
      url: "/fixtures/updateTable",
      dataType : 'json',
      data : {
          value: value1
      },     
      success: function(json)
      {
        if(json['wynik'] == "success") {          
          $('.table-bordered tbody').html("");
          $('#alert_content').hide(); 
          obj = json['test'];
          console.log(json['test']);
          for (var i = 0; i < obj.length; i++) {
                  console.log(obj[i]);
                };      
        }           
      },
      error: function(data){
        alert("fatal error"); 
      }
    });
  });
});