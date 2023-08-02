<div class="modal fade" id="Signup" tabindex="-1" aria-labelledby="SignupLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="SignupLabel">Signup with PGLife</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           <form id="signup_form" class="signup-form" method="POST" action="api/signup.php">
            <i style="margin-left: 0px;" class="fa-solid fa-user"></i><b style="color: red;">*</b> name   : <input type="text" name="name" placeholder=" eg:Aryan" required/><br/><br/>
            <i style="margin-left: -5px;" class="fa-solid fa-user"></i><b style="color: red;">*</b> E-Mail   : <input type="text" name="email" placeholder=" xyz@gmail.com" required/><br/><br/>
            <i style="margin-left: -27px;" class="fa-solid fa-key"></i><b style="color: red;">*</b> Password : <input type="password"  name="password" required/><br/><br/>
            <i style="margin-left: -27px;" class="fa-solid fa-phone"></i><b style="color: red;">*</b> Phone no : <input type="text" name="phone_no" placeholder=" 1234567890" required/><br/><br/>
            <i style="margin-left: -13px;" class="fa-solid fa-building-columns"></i><b style="color: red;">*</b> College : <input type="text" name="college" placeholder=" L D" required/>
            <br/><br/>
          </div>
          <div class="modal-footer">
            <button type="button" id="login-close" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input class="btn btn-success" type="submit" name="submit"  value="Signup"/>
         </form>
             
            <p id="Signup-foot">Already have an account?<a class="nav-link active" aria-current="page" data-bs-toggle="modal" href="" data-bs-target="#login">Signin</a></p><br/> 
        </div>
      </div>
    </div>
  </div>