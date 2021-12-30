var script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.4.1.min.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);



const modal = document.querySelector(".modal");
const trigger = document.querySelector("#trigger");
const closeButton = document.querySelector(".close-button");

function togglemodal() 
{
    modal.classList.toggle("show-modal");
}

function windowOnClick(event) 
{
    if (event.target === modal) 
    {
        toggleModal();
    }
}

// trigger.addEventListener("click", togglemodal);
// closeButton.addEventListener("click", togglemodal);
// window.addEventListener("click", windowOnClick);

// Get the modal
var modal1 = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
// btn.onclick = function() {
//   modal1.style.display = "block";
// }

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal1.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal1) {
    modal1.style.display = "none";
  }
}
var modal2 = document.getElementById("myModal1");

// Get the button that opens the modal
var btn = document.getElementById("myBtn2");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close1")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal2.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal2.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal2) 
    {
    modal2.style.display = "none";
  }
}

document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.sidenav');
  var instances = M.Sidenav.init(elems, options);
});

// Initialize collapsible (uncomment the lines below if you use the dropdown variation)
// var collapsibleElem = document.querySelector('.collapsible');
// var collapsibleInstance = M.Collapsible.init(collapsibleElem, options);

// Or with jQuery

$(document).ready(function()
{
  $('.sidenav').sidenav();
});





function SignUp()
{
  var Firstname=$("#first_name").val();
	var Lastname=$("#last_name").val();
	var Email=$("#email").val();
	var Password=$("#password").val();
	console.log("Firstname: "+EMPID);
	console.log("Lastname: "+ENAME);
	console.log("Email: "+MAILID);
	console.log("Password: "+PNO);	
	 $.ajax({
		url: "common.php",
		type: 'POST',
		async: true,
			data: {'request':"adddata",'Firstname':Firstname,'Lastname':Lastname,'Email':Email,'Password':Password},
			dataType: 'json',
			success: function(data) {
				console.log("Success............");
				console.log(data);
				$(".input-container").hide();
				if(data["result"]==1)
				{
				   alert(data["msg"]);
				   getData();
				}
				else
				{
				    alert(data["msg"]);
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus);
				console.log(errorThrown);
				console.log(jqXHR);
			}
		});
	}

