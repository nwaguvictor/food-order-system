

<!-- Login Modal -->
<div class="modal fade" id="login-modal-form">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Login to proceed...</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <span id="error_message"> </span>
                    <form action="" method="post" id="login_form">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-secondary" type="button"><i class="fa fa-fw fa-envelope"></i></button>
                            </div>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter E-mail">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-secondary" type="button"><i class="fa fa-fw fa-lock"></i></button>
                            </div>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
                        </div>

                        <div class="form-group">
                            <a class="forgot-password" href="">Forgot Password?</a>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="reset"><i class="fa fa-fw fa-times"></i>Cancel</button>
                            <button class="btn btn-success float-right" id="login-user-btn" type="submit"><i class="fa fa-fw fa-check"></i>Proceed</button>
                        </div>
                        <hr class="my-2">
                        <p class="text-center">New User?&nbsp;<a href="" id="reg_modal">Sign Up Now</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Registration modal -->
    <div class="modal fade" id="register-modal-form">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Register Here</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <span class="message"></span>
                    <form action="" method="post" id="register-user-form">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-secondary" type="button"><i class="fa fa-fw fa-user-o"></i></button>
                            </div>
                            <input type="text" name="new_first_name" id="new_first_name" class="form-control" placeholder="Enter First Name" required>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-secondary" type="button"><i class="fa fa-fw fa-user"></i></button>
                            </div>
                            <input type="text" name="new_last_name" id="new_last_name" class="form-control" placeholder="Enter Last Name" required>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-secondary" type="button"><i class="fa fa-fw fa-envelope"></i></button>
                            </div>
                            <input type="email" name="new_email" id="new_email" class="form-control" placeholder="Enter E-mail">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-secondary" type="button"><i class="fa fa-fw fa-phone"></i></button>
                            </div>
                            <input type="tel" name="new_phone" id="new_phone" class="form-control" placeholder="Enter Phone Number">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-secondary" type="button"><i class="fa fa-fw fa-location-arrow"></i></button>
                            </div>
                            <input type="text" name="new_state" id="new_state" class="form-control" placeholder="Enter State" required>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-secondary" type="button"><i class="fa fa-fw fa-home"></i></button>
                            </div>
                            <input type="text" class="form-control" name="new_address" id="new_address" placeholder="Enter Address" required>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-secondary" type="button"><i class="fa fa-fw fa-lock"></i></button>
                            </div>
                            <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Enter Password" required minLength="6">
                        </div>

                        <div class="form-group">
                            <input type="checkbox" name="terms"><a href="">&nbsp;Terms And Conditions</a>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="reset"><i class="fa fa-fw fa-times"></i>Cancel</button>
                            <button class="btn btn-success float-right" id="register-user-btn" type="submit"><i class="fa fa-fw fa-check"></i>Register</button>
                        </div>
                        <hr class="my-2">
                        <p class="text-center">Already a member?&nbsp;<a href="" id="login-back">Sign In Now</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Forgot Password-->
     <div class="modal fade" id="forgot-password-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Send the registered E-mail</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="forgot_form">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-secondary" type="button"><i class="fa fa-fw fa-envelope"></i></button>
                            </div>
                            <input type="email" name="forgot_email" id="forgot_email" class="form-control" placeholder="Enter E-mail Address">
                        </div>

                        <div class="form-group">
                            <button id="forgot-btn" class="btn btn-success form-control" type="submit"><i class="fa fa-fw fa-envelope"></i>Send Message</button>
                        </div>
                        <hr class="my-2">
                        <a href="" id="back-to-login" class="text-center">Back to login</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delivery Address -->
    <div class="modal fade" id="delivery_address_modal">
       <div class="modal-dialog modal-dialog-centered">
           <div class="modal-content">
               <div class="modal-header">
                   <h3 class="modal-title">Delivery Address</h3>
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <div class="modal-body">
                   <form class="delivery_address_form" >
                       <div class="form-group">
                           <input type="text" name="address" id="address" class="form-control form-control-sm" placeholder="Enter full delivery address" required>
                       </div>

                       <div class="form-group">
                           <input type="tel" name="phone_number" id="phone_number" class="form-control form-control-sm" placeholder="Enter address phone number" required>
                       </div>

                       <button type="submit" id="submit_address" class="btn btn-sm btn-danger" name="button">Submit Address</button>
                   </form>
               </div>
           </div>
       </div>
   </div>

</div>
