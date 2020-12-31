function validateForm() {
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var phone = document.getElementById("phone").value;
    var pw = document.getElementById("pw").value;
    var repw= document.getElementById("re-pw").value;

    if (name == "" ) {
    alert("Name must be filled out");
    return false;
    }
    else if ( email == "") {
        alert("Email must be filled out");
        return false;
    }
    else if (  phone=="") {
        alert("Phone must be filled out");
        return false;
    }
    else if (  pw=="" ) {
        alert("Password must be filled out");
        return false;
    }
    else if ( repw=="") {
        alert("Password must be filled out");
        return false;
    }
}

    function myFunction() {
        document.getElementById("demo").innerHTML = "1.You must know the  Reference number to Signup as Admin.<br> 2.Contact Admin if you do not. <br>  3. Signup option is only for Admin and General readers. Do not Signup if you are not any. <br>    4.Publishers and auditors are only created by Admin.<br>  5. Admin has the full authority to delete any user or post.";

    }
