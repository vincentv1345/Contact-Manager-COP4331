
function signUp(){
    firstName = document.getElementById("first-name").value;
    lastName = document.getElementById("last-name").value;
    login = document.getElementById("user-login").value;
    password = document.getElementById("password").value;
    document.getElementById("signupResult").innerHTML = "";

    let tmp = {Login:login, Password:password, FirstName:firstName, LastName:lastName};
    

    fetch("http://159.223.173.36/api/index.php/users", {
        method: "POST",
        body:tmp
    })
        .then(response => response.json())
        .then(data =>{
            if (data === "Users created successfully") {
                window.location.replace("http://contactsplus.xyz/%22");
            }
        })
        .catch(e => console.log(e));
    }