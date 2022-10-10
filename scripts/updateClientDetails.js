/* Admin Dashboard (admin-dashboard.php) */

// 	 From https://getbootstrap.com/docs/5.0/components/modal/
	var update = document.getElementById('updateClientDetailsModal');
	update.addEventListener('show.bs.modal', function (event) {
		// Button that triggered the modal
		var button = event.relatedTarget;
		
		// Extract user info from data-bs-* attributes
		var clientID = button.getAttribute('data-bs-id');
		var fname = button.getAttribute('data-bs-fname');
		var lname = button.getAttribute('data-bs-lname');
		var email = button.getAttribute('data-bs-email');
		var phone = button.getAttribute('data-bs-phone');
		var address = button.getAttribute('data-bs-address');
		var level = button.getAttribute('data-bs-level');
		
	
		$('#client-fname').val(fname);
		$('#client-lname').val(lname);
		$('#client-email').val(email);
		$('#client-phone').val(phone);
		$('#client-address').val(address);
		$('#client-level').val(level);
		
		// Form hidden values
		$('#clientID').val(clientID);
	});