document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.tooltipped');
    var instances = M.Tooltip.init(elems,Options);
  });

  // Or with jQuery


  $(document).ready(function(){
    $('.tooltipped').tooltip();
      getData();
  });

  $(document).on("click",".add",function()
    {
		$("input").val("");
		$("textarea").val("");
		$("#modal1").show();
    });
    $(document).on("click","#close",function()
	{
		$("#modal1").hide();
	});


// MODAL jQuery for Centering

  // $(function() {
  // var modal = $(".modal");
  // var body = $(window);
  // // Get modal size
  // var w = modal.width();
  // var h = modal.height();
  // // Get window size
  // var bw = body.width();
  // var bh = body.height();
  
  // Update the css and center the modal on screen
  // modal.css({
  //   "top": ((bh - h) / 7) + "px",
  //   "left": ((bw - w) / 7) + "px",
  // "-webkit-transition": "0.5s",
  // "overflow": "auto",
  // "transition": "all 0.3s linear"
  // })
  
// });

// <!--END OF EVENT HANDLING JS-->


// START OF FUNCTON

function Save()
{
  var Id=$("#id").val();
	var Name=$("#name").val();
	var Age=$("#age").val();
	var Gender=$("input:radio[name=group1]:checked").attr("id");
	var Email=$("#email").val();
  var PhoneNumber=$("#num").val();
  var Place=$("#place").val();
  var JoinDate=$("#jdate").val();
  var EndDate=$("#edate").val();
	console.log("Id: "+Id);
	console.log("Name: "+Name);
	console.log("Age: "+Age);
	console.log("Gender: "+Gender);
	console.log("Email: "+Email);
  console.log("PhoneNumber: "+PhoneNumber);
  console.log("Place: "+Place);1
  console.log("JoinDate: "+JoinDate);
  console.log("EndDate: "+EndDate);
     $.ajax({
            url: "common.php",
            type: 'POST',
            async: true,
                data: {'request':"addinfo",'Id':Id,'Name':Name,'Age':Age,'Gender':Gender,'Email':Email,'PhoneNumber' :PhoneNumber,'Place':Place,'JoinDate':JoinDate,'EndDate':EndDate},
                dataType: 'json',
                success: function(data) {
                    console.log("Success............");
                    console.log(data);
                    $(".modal").hide();
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
function getData()
        {
        $.ajax({
          url: "common.php",
          type: 'POST',
          async: true,
          data: {'request':"getinfo"},
          dataType: 'json',
          success: function(arr) 
          {
            console.log("get data Success............");
            console.log(arr);
            $("tbody").html(""); 
            var tbody="";
            jQuery.each(arr["data"], function(index, item)
            {
              tbody += "<tr><td>"+item.Id+"</td><td>"+item.Name+"</td><td>"+item.Age+"</td><td>"+item.Gender+"</td><td>"+item.Email+"</td><td>"+item.PhoneNumber+"</td><td>"+item.Place+"</td><td>"+item.JoinDate+"</td><td>"+item.EndDate+"</td><td><button type='button' class='Deleteitem' id="+item.Id+">Delete</button> <button type='button' class='Edititem' id="+item.Id+">Edit</button></td></tr>";
            });
            $("tbody").append(tbody); 
            },
            error: function(jqXHR, textStatus, errorThrown) 
            {
               console.log(textStatus);
               console.log(errorThrown);
               console.log(jqXHR);
            }
          });
        }


    
