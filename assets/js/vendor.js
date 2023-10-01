	// required document show function
	function joining_steps(){
		if ($('.check_points').is(':checked')==true) {
			$('.joining-steps').hide(1000);
			$('.first-step').show(1000);
		}else{
			swal({title: "Please read all points",icon: "error",});
		}
		
	}

	// basic user & company contact details function
	function next_step(){
		
		if ($('#company_name').val().trim()=='' || $('#company_mobile').val().trim()=='' || 
			$('#company_mail').val().trim()=='' || $('#ufname').val().trim()=='' || 
			$('#ulname').val().trim()=='' || $('#user_mobile').val().trim()=='' || 
			$('#user_mail').val().trim()=='' || $('#vendor_password').val().trim()=='') {

			all_fields_required();
		}

		else{

			// checking company & user data already exist or not exist
			$.ajax({
				url:'function/front-vendor-ins-check.php',
				type:'POST',
				data: {
					only_company: $('#company_name').val().trim(),
					company_mobile: $('#company_mobile').val().trim(),
					company_mail: $('#company_mail').val().trim(),
					user_mobile: $('#user_mobile').val().trim(),
					user_mail: $('#user_mail').val().trim(),

			},
			success:function(result){
				//console.log(result);
				var j_decode = JSON.parse(result);
				if (j_decode.status==true) {
					swal({title: j_decode.msg,icon: "error",});
				}else{
					// proced to the next step for kyc
					$('.first-step').hide(1000);
					$('.second-step').show(1000);
				}
			}

			});
			
		}
		
	}
	function last_back(){
		$('.first-step').show(1000);
		$('.second-step').hide(1000);
	}
	function first_back(){
		$('.joining-steps').show(1000);
		$('.first-step').hide(1000);
	}

	function all_fields_required(){
		swal({title: "Please fill all details",icon: "error",});
	}

// vendor fomr submit
$('#vendor_reg_form').on('submit',function(e){
	var form = $('#vendor_reg_form')[0];
	var formData = new FormData(form);

			$.ajax({
				url:'function/front-vendor-ins-check.php',
				type:'POST',
				data:formData,
				contentType: false,
		    	processData: false,
				success:function(return_data){
					console.log(return_data);
					var deocde_data = JSON.parse(return_data);
					if (deocde_data.status==true) {
						swal({
						  title: deocde_data.msg,
						  icon: deocde_data.icon,
						  /*buttons: true,
						  dangerMode: true,*/
						});
					}else{
						$('#vendor_reg_form')[0].reset();
						swal({
						  title: "Thank You",
						  text: "Please wait for your account activation.",
						  icon: "success",
						  /*buttons: true,
						  dangerMode: true,*/
						})
						.then(function(){
						  $('#signin-modal').modal().show();
						});


					}
					
				}
			});
			e.preventDefault();
		});