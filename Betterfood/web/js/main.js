$(document).ready(function(){
    var myJSON = '{"text":"A place where we bring delicious food right to your door. Fast, delicious, reliable."}';
    var myObj = JSON.parse(myJSON);
    $("#json").html(myObj.text);
    //JQUERY-vel átdjuk a jsont-t a lábléc egy szöveg dobozának
});