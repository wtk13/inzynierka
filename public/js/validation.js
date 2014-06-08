$(document).ready(function(){
	if (!$('#name').val()) {
		$('#submit').addClass('disabled');
	};

	$('#name').blur(function(){
		if(!$('#name').val()) {   
			$('#alert1').show();		
		} else {
			$('#alert1').hide();					
		}	
		disabledButton();	
	});


	if (!$('#title').val()) {
		$('#submit1').addClass('disabled');
	};

	if (!$('#label').val()) {
		$('#submit2').addClass('disabled');
	};

	if (!$('#round').val() || !$('#content1').val()) {
		$('#submit3').addClass('disabled');
	};

	// Fixtures
	if (!$('#round').val()) {
		$('#submit_fix').addClass('disabled');
	};

	$('#round').blur(function(){
		if(!$(this).val()) {   
			$('#alert_fix').show();		
		} else {
			$('#alert_fix').hide();					
		}	

		if ($(this).val()) {
			$('#submit_fix').removeClass('disabled');		
		} else {		
			$('#submit_fix').addClass('disabled');
		}	
	});
});

function disabledButton(){
	if ($('#name').val()) {
		$('#submit').removeClass('disabled');
		//$('#submit').addClass('btn btn-success');
	} else {
	// 	$('#submit').removeClass();
		$('#submit').addClass('disabled');
	}
}

function disabledButton1(){
	if ($('#round').val() && $('#content1').val()) {
		$('#submit3').removeClass('disabled');
		//$('#submit').addClass('btn btn-success');
	} else {
	// 	$('#submit').removeClass();
		$('#submit3').addClass('disabled');
	}
}




$('#title').blur(function(){
	if(!$('#title').val()) {   
		$('#alert1').show();
		$('#submit1').addClass('disabled');		
	} else {
		$('#alert1').hide();
		$('#submit1').removeClass('disabled');					
	}	
});

$('#label').blur(function(){
	if(!$('#label').val()) {   
		$('#alert1').show();
		$('#submit2').addClass('disabled');		
	} else {
		$('#alert1').hide();
		$('#submit2').removeClass('disabled');					
	}		
});

$('#round').blur(function(){
	if(!$('#round').val()) {   
		$('#alert1').show();
		$('#submit3').addClass('disabled');		
	} else {
		$('#alert1').hide();
		$('#submit3').removeClass('disabled');					
	}	
	disabledButton1();
});

$('#content1').blur(function(){
	if(!$('#content1').val()) {   
		$('#alert1').show();
		$('#submit3').addClass('disabled');		
	} else {
		$('#alert1').hide();
		$('#submit3').removeClass('disabled');					
	}
	disabledButton1();		
});


