/* In file: checkout.blade.php */

window.addEventListener('load', function () {
	// Create a Stripe client.
	var stripe = Stripe('pk_test_51GzYZgEwovnXVY3jkkOEU9D2LPBzKykl4RZaSARJp7cbkjSvbIYMZOU8eg1025kPkz1Z4Nm9QyfVkPBMGMrxLPR300hZWGEQsS');

	// Create an instance of Elements.
	var elements = stripe.elements();

	// Custom styling can be passed to options when creating an Element.
	// (Note that this demo uses a wider set of styles than the guide below.)
	var style = {
	  base: {
		color: '#32325d',
		fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
		fontSmoothing: 'antialiased',
		fontSize: '16px',
		'::placeholder': {
		  color: '#aab7c4'
		}
	  },
	  invalid: {
		color: '#fa755a',
		iconColor: '#fa755a'
	  }
	};

	// Create an instance of the card Element.
	var card = elements.create('card', {
		style: style,
		hidePostalCode: true
	});

	// Add an instance of the card Element into the `card-element` <div>.
	card.mount('#card-element');

	// Handle real-time validation errors from the card Element.
	card.on('change', function(event) {
	  var displayError = document.getElementById('card-errors');
	  if (event.error) {
		displayError.textContent = event.error.message;
	  } else {
		displayError.textContent = '';
	  }
	});

	// Handle form submission.
	var form = document.getElementById('payment-form');
	form.addEventListener('submit', function(event) {
	  //alert("Form submitted.");
	  event.preventDefault();
	  
	  // Disable the submit button to prevent repeated clicks
      document.getElementById('complete-order').disabled = true;
	  
	  // Billing address
	  var options = {
		  name: document.getElementById('card-name').value,
		  //address_line1: document.getElementById('address').value,
		  //address_city:document.getElementById('city').value,
		  //address_state:document.getElementById('province').value,
		  address_zip:document.getElementById('postal-code').value
	  }

	  stripe.createToken(card, options).then(function(result) {
		if (result.error) {
		  // Inform the user if there was an error.
		  var errorElement = document.getElementById('card-errors');
		  errorElement.textContent = result.error.message;
		  
		  // Enable the submit button
          document.getElementById('complete-order').disabled = false;
		} else {
		  // Payment has been processed!
		  // Send the token to your server.
		  stripeTokenHandler(result.token);
		}
	  });
	});

	// Submit the form with the token ID.
	function stripeTokenHandler(token) {
	  // Insert the token ID into the form so it gets submitted to the server
	  var form = document.getElementById('payment-form');
	  var hiddenInput = document.createElement('input');
	  hiddenInput.setAttribute('type', 'hidden');
	  hiddenInput.setAttribute('name', 'stripeToken');
	  hiddenInput.setAttribute('value', token.id);
	  
	  // ('payment-form').appendChild('input')
	  form.appendChild(hiddenInput);

	  // Submit the form
	  form.submit();
	}
});

