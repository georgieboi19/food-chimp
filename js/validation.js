function validateEditAcc(){
  var message = "";
  var errorCount = 0;
  document.getElementById("msg1").innerHTML = msg1;
  document.getElementById("msg2").innerHTML = msg2;
  document.getElementById("msg3").innerHTML = msg3;
  var name = document.forms["editAcc"]["fName"].value;
  var email = document.forms["editAcc"]["userEmail"].value;
  var pass1 = document.forms["editAcc"]["userPass1"].value;
  if(name == ""){
    msg1= "Name field can't be empty";
    msg11 = "red";
    errorCount ++;
  } else {
    msg1 = "";
    msg11 = "black";
  }

  if(email ==""){
    msg2 = "Email field can't be empty";
    msg21 = "red";
    errorCount ++;
  } else {
    msg2 = "";
    msg21 = "black";
  }

  if(pass1 !=""){
    if(pass2 != pass3){
      msg3 = "Passwords do not match";
      msg31 = "red";
      errorCount ++;
    } else {
      msg3 = "";
      msg11 = "black";
    }
  }else {
    msg3 = "";
    msg11 = "black";
  }
document.getElementById("msg1").innerHTML = msg1;
document.getElementById("msg2").innerHTML = msg2;
document.getElementById("msg3").innerHTML = msg3;
  if (errorCount > 0){
    return false;
  }else{
    return true;
  }

}
