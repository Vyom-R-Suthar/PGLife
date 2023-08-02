<div class="modal fade" id="login" tabindex="-1" aria-labelledby="loginLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginLabel">Login To PGLife</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           <form id="login_form" class="login-form" method="POST" action="api/login.php">
            <i style="margin-left: 26px;" class="fa-solid fa-user"></i><b style="color: red;">*</b>Email   :  <input type="text" name="email" placeholder=" eg : dhruv@gmail.com" required/><br/><br/>
            <i class="fa-solid fa-key"></i><b style="color: red;">*</b>Password : <input type="password" name="password" required/>
            
          </div>
          <div class="modal-footer">
          <input type="submit" name="submit" value="Signin" button type="button" class="btn btn-success"></button>
         </form>
            <button type="button" id="login-close" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            
            <p id="login-foot">Don't have an account?<a class="nav-link active" aria-current="page" data-bs-toggle="modal" href="" data-bs-target="#Signup">Create One</a></p><br/> 
        </div>
      </div>
    </div>
  </div>