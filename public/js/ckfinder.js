$(document).ready(function(){
	CKEDITOR.replace('textarea',
	{
		filebrowserBrowseUrl :  '/js/ckfinder/ckfinder.html',
		filebrowserImageBrowseUrl : '/js/ckfinder/ckfinder.html?type=Images',
		filebrowserFlashBrowseUrl : '/js/ckfinder/ckfinder.html?type=Flash',
		filebrowserUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
		filebrowserImageUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
		filebrowserFlashUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'

	});
});