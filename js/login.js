

const submit = document.getElementById("submit");
submit.addEventListener("click", (e) => {

    e.preventDefault();

    const emailAddress = document.getElementById("email-address").value;
    const password = document.getElementById("password").value;
    console.log(emailAddress, password)

    fetch("http://159.223.173.36/api/index.php/users", {

            method: 'GET',
            body: JSON.stringify({
                "Login": "sofBey123",
                "Password": "Password1"
            }),
            headers: new Headers({
              'Content-Type': 'application/json; charset=UTF-8'
            })
    })
    .then((response) => response.json())
    .then((data) => console.log(data));
    
})
