//Ellenőrizzük, hogy a mezők ki-e vannak töltve, ha nem, pirosra vált a keret
  var mail=document.getElementById("email");
  var uname=document.getElementById("name");
  var address=document.getElementById("address");
  var city=document.getElementById("place");

  mail.addEventListener("keydown",function(e){
    val=e.currentTarget.value;
    if (val=='') {
      mail.style.borderColor="#F46E42";
    }else {
      mail.style.borderColor="#A9A9A9";
    }
  });
  uname.addEventListener("keyup",function(e){
    val=e.currentTarget.value;
    if (val=='') {
      uname.style.borderColor="#F46E42";
    }else {
      uname.style.borderColor="#A9A9A9";
    }
  });
  address.addEventListener("keyup",function(e){
    val=e.currentTarget.value;
    if (val=='') {
      address.style.borderColor="#F46E42";
    }else {
      address.style.borderColor="#A9A9A9";
    }
  });
  city.addEventListener("keyup",function(e){
    val=e.currentTarget.value;
    if (val=='') {
      city.style.borderColor="#F46E42";
    }else {
      city.style.borderColor="#A9A9A9";
    }
  });
