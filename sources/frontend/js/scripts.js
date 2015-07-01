$(document).ready(function(){

	// Get the form.
	var form = $('form.capture-me');

	// Set up an event listener for the contact form.
	$(form).submit(function(e) {
		// Stop the browser from submitting the form.
		

		// Serialize the form data.
		//var formData = $(this).serialize();
		
		var formData = {
			'selection': $('button[name=selection][clicked=true]').val(),
    };

		// Submit the form using AJAX.
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: $(form).attr('action'),
			data: formData,
			dataType:'json', 
			async: false
		})
		.done(function(response) {
			
			var submittedAnswer = $("button[type=submit][clicked=true]");
			
			var result = eval(response);
			
			var expression = "button[type=submit][value="+result[0]+"]";
			
			var trueAnswer = $(expression);
			//alert(result);
			
			if(result[1] == 'trueAnswer'){
				submittedAnswer.removeClass('wrongAnswer');
				submittedAnswer.addClass('trueAnswer');
				$(".answerButton").attr('disabled', true);
				$(".statTrue").text(result[2]);
				
			} else{
				submittedAnswer.removeClass('trueAnswer');
				submittedAnswer.addClass('wrongAnswer');
				trueAnswer.addClass('trueAnswer');
				$(".answerButton").attr('disabled', true);
				$(".statFalse").text(result[3]);
			}
			$(".nextQuestion").removeClass('hidden');
			$(".nextQuestion").addClass('visible');
			
		})
		.fail(function(data) {

			// Set the message text.
			if (data.responseText !== '') {
				$(formMessages).text(data.responseText);
			} else {
				$(formMessages).text('Oops! An error occured and your message could not be sent.');
			}
		});

	});
	
});

function setClicked(input){
	$(input).parents("form").removeAttr("clicked");
	$(input).attr("clicked", "true");
}