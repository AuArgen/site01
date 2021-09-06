if (document.querySelector("#kll").value == "mug-kl")update(document.querySelector("#sk").value);
document.querySelector("#status").onchange = ()  =>  {
    if(document.querySelector("#status").value == "mug-kl")
    update(document.querySelector("#sk").value)
    else  document.querySelector(".kl").innerHTML = "";
};
function update(x) {
  $.ajax({
      url:'../php/kl.php',
      type:'POST',
      cache:false,
      data:{x},
      dataType:'html',
      success: function (data) {
          document.querySelector(".kl").innerHTML = data;
      }
  });
}