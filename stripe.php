<?php
//New stripe flow  [Payment confirmation page]
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$error = false;
	try {
		if (!isset($_POST['stripeToken'])) throw new Exception("The Stripe Token was not generated correctly");
		$stripe_total = 0;
		$stripe_installment = 0;

		if( isset( $_SESSION['stripe_total']) && ($_SESSION['stripe_total'] != '') ) {
			$stripe_total = $_SESSION['stripe_total'];
		}else{
			header('Location: '.home_url('/').'enroll');
		}
		if(is_user_logged_in()){
			if( isset( $_SESSION['stripe_installment']) && ($_SESSION['stripe_installment'] != '') ) {
				//If Installment
			    $stripe_installment = $_SESSION['stripe_installment'];
			  	$customer = \Stripe\Customer::create(array(
				    'source'     	=> $_POST['stripeToken'],
				    'email'    		=> $user_email,
				    'description'	=> $_POST['card-holder-name'],
			    ));

			    $subscription = \Stripe\Subscription::create([
				    'customer' => $customer->id,
				    'items' => [['plan' => 'master_installment_inc_tax']],
				    'tax_percent' => 25.00,
				    'metadata'	=> ['description' => 'Master Course - Part payment'],
				]);
			}else{
			//If normal or full payment
				$customer = \Stripe\Customer::create(array(
					'source' => $_POST['stripeToken'],
					'email' => $user_email
				));
			  	$newamt = $stripe_total/1.25;
			  	\Stripe\InvoiceItem::create(array(
				    "customer" => $customer->id,
				    "amount" => intval($newamt * 100),
				    "currency" => "usd",
				    "description" => $course_name_str
				));
				$invoice = \Stripe\Invoice::create(array(
				    "customer" => $customer->id,
				    'tax_percent' => 25.00,
				    'billing' => 'charge_automatically'
				));
				$invoice->pay();
			}
			//Save the Stripe_customer_id in database
			/*$new_student = array(
				'post_type'		=> 'sbe_students',
				'post_title'    => 'Student-'.$customer->id,
				'post_status'   => 'publish',
			);*/
			/*$stud_id = wp_insert_post( $new_student );
			if($stud_id){
		  		add_post_meta( $stud_id, 'name', $_POST['card-holder-name']);
		  		add_post_meta( $stud_id, 'email', $user_email);
		  		add_post_meta( $stud_id, 'stripe_customer_id', $customer->id);
		  		add_post_meta( $stud_id, 'user_id', get_current_user_id());
			}*/
			//Save for email reference
			//$email_cust_id = $customer->id;


			if( is_user_logged_in() && ($stripe_total != 0) && (!$error)){
				/*********************************************
				******* Add enrolled courses in user meta ****
				*********************************************/
				$user_id = get_current_user_id();
				//Get previous courses user enrolled
				$courses = get_field('enrolled_courses', 'user_'.$user_id);
				$courses_arr = array();
				$courses_arr = explode(',', $courses);
				//Array of just purchased courses
				$c_ids = array_filter($c_ids);
				$new_ids = array();
				if(!empty($c_ids) && !empty($courses_arr)){
					$new_ids = array_filter(array_merge($courses_arr,$c_ids));
				}
				$new_ids_str = implode(',', array_unique($new_ids));
				update_field( 'enrolled_courses', $new_ids_str, 'user_'.$user_id);
			}
		}else{
			//Not logged-in
			header('Location: '.home_url('/').'enroll');
		}
	} catch (Exception $e) {
		$error = $e->getMessage();
	}
}

?>



//JS code [Enroll page]
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	var stripe = Stripe("<?php echo $stripe['publishable_key']; ?>");
    var elements = stripe.elements();

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
	    //color: '#fa755a',
	    color: '#eb1c26',
	    iconColor: '#fa755a'
	  }
	};
	// Create an instance of the card Element.
	var card = elements.create('card', {
		hidePostalCode: true,
		style: style
	});

	// Add an instance of the card Element into the `card-element` <div>.
	card.mount('#card-element');

	// Handle real-time validation errors from the card Element.
	card.addEventListener('change', function(event) {
	  var displayError = document.getElementById('card-errors');
	  if (event.error) {
	    displayError.textContent = event.error.message;
	  } else {
	    displayError.textContent = '';
	  }
	});
	// Handle form submission.
	var form = document.getElementById('sbe-payment-form');
	form.addEventListener('submit', function(event) {
		event.preventDefault();

		var $name = jQuery('#sbe-payment-form input[name="card-holder-name"]');

		// disable the submit button to prevent repeated clicks
		jQuery('.submit-button').attr("disabled", "disabled");
		stripe.createToken(card).then(function(result) {
			if (result.error) {
				// Inform the user if there was an error.
				var errorElement = document.getElementById('card-errors');
				errorElement.textContent = result.error.message;
				jQuery('body .loaderdiv').remove();
			} else {
				// Send the token to your server.
				stripeTokenHandler(result.token);
			}
		});
	});

	// Submit the form with the token ID.
	function stripeTokenHandler(token) {
	  // Insert the token ID into the form so it gets submitted to the server
	  var form = document.getElementById('sbe-payment-form');
	  var hiddenInput = document.createElement('input');
	  hiddenInput.setAttribute('type', 'hidden');
	  hiddenInput.setAttribute('name', 'stripeToken');
	  hiddenInput.setAttribute('value', token.id);
	  form.appendChild(hiddenInput);

	  // Submit the form
	  form.submit();
	}
});
</script>