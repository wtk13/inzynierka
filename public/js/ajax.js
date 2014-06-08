var hiddenId = 0;
var hiddenCache = 0;

$(document).ready(function () {
  $(".delete-ajax-page").click(function () {   
    hiddenId =  $(this).attr("id");    
    hiddenCache = $(this);
  });
  $(".ok-delete-page").click(function () {   
    $("#popup img").show();   
    $.ajax({
      type: "POST",
      url: "/pages/delete",
      dataType : 'json',
      data : {
        id: hiddenId    
      },
      success: function(json)
      {
        if(json['wynik'] == "success") {
          $(hiddenCache).parent().parent().parent().hide();
          //alert(json['wynik']);
          $("#popup img").hide();
          //tutej
          $('#popup').modal('hide');
        }
      },
      error: function(data){
        alert("delete error"); 
      }
    });
  });

  $(".delete-ajax").click(function () {  
    hiddenId =  $(this).attr("id");
    hiddenCache = $(this);
  });
  $(".ok-delete").click(function () {
    $("#popup img").show();    
    $.ajax({
      type: "POST",
      url: "/posts/delete",
      dataType : 'json',
      data : {
        id: hiddenId    
      },
      success: function(json)
      {
        if(json['wynik'] == "success") {
          $(hiddenCache).parent().parent().parent().hide();          
          $("#popup img").hide();
          $('#popup').modal('hide');
        }
      },
      error: function(data){
        alert("fatal error"); 
      }
    });
  });

  $(".ajax-publish").click(function () {       
    $(this).before('<img src="/img/22.gif"/>');
    var publishId = $(this).attr("id");
    var cache = $(this);   
    $.ajax({
     type: "POST",
     url: "/posts/publish",
     dataType : 'json',
     data : {
      id: publishId      
     },
     success: function(json)
     {
      if(json['wynik'] == "success") {        
        var classImage = $(cache).attr('class');              
        if (classImage.indexOf('btn-success') !== -1) {
          $(cache).removeClass("btn-success").addClass("btn-danger");
        } else {
          $(cache).removeClass("btn-danger").addClass("btn-success");
        }
        ;

        var classSpan = $(cache).children().attr('class');
        if (classSpan.indexOf('glyphicon-eye-open') !== -1) {
          $(cache).children().removeClass("glyphicon-eye-open").addClass("glyphicon-eye-close");
        } else {
          $(cache).children().removeClass("glyphicon-eye-close").addClass("glyphicon-eye-open");
        }
        ;
        $(cache).prev().remove();
       //alert(json['wynik']);
      }
     },
     error: function(data){
                 alert("fatal error"); 
     }
    });
   });

  



  // $(".ok-delete-fix").click(function () {
  //   $("#popup img").show();
  //   //tutej
  //   // alert(x);
  //   $.ajax({
  //     type: "POST",
  //     url: "/fixtures/deleteall/",
  //     dataType : 'json',     
  //     success: function(json)
  //     {
  //       if(json['wynik'] == "succes") {
  //         $(hiddenCache).parent().parent().hide();
  //         //alert(json['wynik']);
  //         $("#popup img").hide();
  //         //tutej
  //         $('#popup').modal('hide');
  //       }
  //     },
  //     error: function(data){
  //       alert("fatal error"); 
  //     }
  //   });
  // });



  $(".delete-ajax-club").click(function () {    
    hiddenId =  $(this).attr("id");    
    hiddenCache = $(this);
  });
  $(".ok-delete-club").click(function () {
    $("#popup img").show();   
    $.ajax({
      type: "POST",
      url: "/clubs/delete",
      dataType : 'json',
      data : {
        id: hiddenId    
      },     
      success: function(json)
      {
        if(json['wynik'] == "success") {
          $(hiddenCache).parent().parent().parent().hide();          
          $("#popup img").hide();          
          $('#popup').modal('hide');
        }
      },
      error: function(data){
        alert("fatal error"); 
      }
    });
  });

  
});