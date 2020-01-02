$(document).ready(function(){
    $(document).on('click', '#login-modal', function(e){
        e.preventDefault();
        $("#login-modal-form").modal('show');
    });

    $(document).on('click', '#reg_modal', function(e){
        e.preventDefault();
        $('#login-modal-form').modal('hide');
        $('#register-modal-form').modal('show');
    });

    $(document).on('click', '#login-back', function(e){
        e.preventDefault();
        $('#register-modal-form').modal('hide');
        $('#login-modal-form').modal('show');
    });

    $(document).on('click', '.forgot-password', function(e){
        e.preventDefault();
        $('#login-modal-form').modal('hide');
        $('#forgot-password-modal').modal('show');
    });

    $(document).on('click', '#back-to-login', function(e){
        e.preventDefault();
        $('#forgot-password-modal').modal('hide');
        $('#login-modal-form').modal('show');
    });


    // END OF REGISTRATION AND LOGIN MODAL FORMS|||||||||||||||||||||||||||||||||||||||||


        $("#go-kitchen-btn").hide("fast", function(){
            $("#go-kitchen-btn").show('slow');
        });

    // CHECKING EMAIL AVAILABILITY

    $(document).on('keyup', '#new_email', function(){
        let newEmail = $(this).val();
        $.ajax({
            url: 'account/process/register_process.php',
            type: 'POST',
            data: {email:newEmail},
            success:function(resps){
                $(".message").html(resps);
            }
        })
    });

    // REGISTERING THE USER

    $(document).on('click', '#register-user-btn', function(e){
        e.preventDefault();
        let newFirstName = $("#new_first_name").val();
        let newLastName = $("#new_last_name").val();
        let newEmail = $("#new_email").val();
        let newPhone = $("#new_phone").val();
        let newState = $("#new_state").val();
        let newAddress = $("#new_address").val();
        let newPassword = $("#new_password").val();

        if (newFirstName == '' || newLastName == '' || newEmail == '' || newPhone == '' || newPassword == '' || newState == '' || newAddress == '' ) {
            alert("Please Fill all fields")
        }
        else {
            $.ajax({
                url: 'account/process/register_process.php',
                type:'POST',
                data:{firstname:newFirstName, lastname:newLastName, email:newEmail, phone:newPhone, state:newState, address:newAddress, password:newPassword, action:"register"},
                success:function(response) {
                    if (response == 'ok') {
                        Swal.fire({
                            title: 'Registration Successful',
                            text: 'Login to continue',
                            position: 'top',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1000
                        });

                        $('#register-user-form')[0].reset();
                        $('#register-modal-form').modal('hide');
                        $('#login-modal-form').modal('show');
                    }

                }
            })
        }
    });

    // LOGIN IN THE USER

    $(document).on('submit', '#login_form', function(e){
        e.preventDefault();
        let email = $('#email').val()
        let password = $('#password').val()

        if (email == '' || password == '') {
            alert("All fields are required")
        }
        else {
            $.ajax({
                url: 'account/process/login_process.php',
                type: 'POST',
                data: {email:email, password:password, action:"login"},
                success:function(response){
                    if (response == 'ok') {
                        location.reload(true);
                    }
                    else {
                        $("#error_message").html(response);
                    }
                }
            });
        }
    });
})
