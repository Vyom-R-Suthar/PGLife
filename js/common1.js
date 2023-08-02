window.addEventListener("load",function () {
   var login_form = document.getElementById("login_form");
   login_form.addEventListener("submit",function (event) {
      var xhr = new XMLHttpRequest();
      var form_data_1 = new FormData(login_form);

      // on success
      xhr.addEventListener("load",login_success);

      // on error
      xhr.addEventListener("error",login_error);

      // setting up equest
      xhr.open("POST","./api/login.php");

      //sending form data
      xhr.send(form_data_1);
      
      document.getElementById("loading").style.display = 'block';
      event.preventDefault();

   });
});
var login_success = function (event) {
   document.getElementById("loading").style.display = 'none';
   var response1 = JSON.parse(event.target.responseText);
   if(response1.success){
       alert(response1.message);
      // window.location.href = "./index.php";
      location.reload();
   }
   else
   {
       alert(response1.message);
   }
};
var login_error = function (event) {
   document.getElementById("loading").style.display = 'none';
    alert("Oops ! Something went wrong , try again later");
};