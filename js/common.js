window.addEventListener("load", function () { // means ke page load thai jaay ena pachi function() ne execute karo
    var signup_form = document.getElementById("signup_form");
    signup_form.addEventListener("submit", function (event) {
        var XHR = new XMLHttpRequest();
        var form_data = new FormData(signup_form);

        // On success - means if the request(XMLHttpRequest) built/created successfully then use signup_success function and also go for XHR.open and XHR.send 
        XHR.addEventListener("load", signup_success);

        // On error - means if request(XMLHttpRequest) not created successfully , directly go to on_error function without moving to XHR.open and XHR.send.
        XHR.addEventListener("error", on_error);

        // Set up request and url of our php file
        XHR.open("POST", "./api/signup.php");

        // Form data is sent with request
        XHR.send(form_data);

        document.getElementById("loading").style.display = 'block';
        event.preventDefault();
    });

   //add code corresponding to login form as a part of your assignment
   /*var login_form = document.getElementById("login_form");
   login_form.addEventListener("submit",function(event){
         var XHR = new XMLHttpRequest();
         var form_data = new FormData(login_form);
         
         // on success
         XHR.addEventListener("load",login_success);

         //on error
         XHR.addEventListener("error",login_error);

         //setting request
         XHR.open("POST","./api/login.php");

         //sending data
         XHR.send(form_data);

         event.preventDefault();
   });*/
});

var signup_success = function (event) {
    document.getElementById("loading").style.display = 'none';

    var response = JSON.parse(event.target.responseText);
    if (response.success) {
        alert(response.message);
       // window.location.href = "./index.php";
    } else {
        alert(response.message);
        window.location.href = "./index.php";
    }
};


var on_error = function (event) {
    document.getElementById("loading").style.display = 'none';

    alert('Oops! Something went wrong.');
};
//window.location.href = "./index.php";
/*var login_success = function (event){
    var response = JSON.parse(event.target.responseText);
    if(response.success){
        alert(response.message);
        window.location.href = "./index.php";
    }
    else{
        alert(response.message);
    }
};
var login_error = function (event) {
    alert('Oops ! Something went wrong !');
};*/
