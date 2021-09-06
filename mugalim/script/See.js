document.querySelector("#kl").style.display = "none";
var a = 1;
function ch(x) {
  a = x;
  document.querySelector(".table").innerHTML="";
  document.querySelector("#k").value="0";
  document.querySelector("#kl").value="0";
  if (a == 1) document.querySelector("#kl").style.display = "none";
}
document.querySelector("#k").onchange = () => {
  document.querySelector("#kl").value="0";
  document.querySelector(".table").innerHTML="";
  if (a > 1) document.querySelector("#kl").style.display = "block";
  else {
    testSearch("1",document.querySelector("#k").value,"");
  }
}
document.querySelector("#kl").onchange = () => {
    testSearch("2",document.querySelector("#k").value,document.querySelector("#kl").value);
}
function testSearch(x,y,z) {
$.ajax({
    url:'../php/See.php',
    type:'POST',
    cache:false,
    data:{x,y,z},
    dataType:'html',
    success: function (data) {
      document.querySelector(".table").innerHTML = data;
    }
});
}