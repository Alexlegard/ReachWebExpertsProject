window.addEventListener('load', function () {
	
	// Get the modal
	var shipping_modal = document.getElementById("shipping-address-modal");
	var billing_modal = document.getElementById("billing-address-modal");
	
	// Get the button that opens the modal
	var shipping_btn = document.getElementById("shipping-address-button");
	var billing_btn = document.getElementById("billing-address-button");

	// Get the <span> element that closes the modal
	var shipping_span = document.getElementsByClassName("close")[0];
	var billing_span = document.getElementsByClassName("close")[1];
	
	// When the user clicks on the button, open the modal
	shipping_btn.onclick = function() {
		shipping_modal.style.display = "block";
	}
	billing_btn.onclick = function() {
		billing_modal.style.display = "block";
	}

	// When the user clicks on <span> (x), close the modal
	shipping_span.onclick = function() {
	  shipping_modal.style.display = "none";
	}
	billing_span.onclick = function() {
	  billing_modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	  if (event.target == shipping_modal || event.target == billing_modal) {
		shipping_modal.style.display = "none";
		billing_modal.style.display = "none";
	  }
	}
});