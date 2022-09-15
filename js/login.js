

const submit = document.getElementById("submit");
submit.addEventListener("click", (e) => {

    e.preventDefault();

    const username = document.getElementById("user-login").value;
    const password = document.getElementById("password").value;
    console.log(username, password)

    fetch(`http://159.223.173.36/api/index.php/users?Login=${username}&Password${password}`)
      .then((response) => response.json())
      .then((data) => console.log(data));
    
})
