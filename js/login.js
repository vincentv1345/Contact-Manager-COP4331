
const submit = document.getElementById("submit");
submit.addEventListener("click", (e) => {

    e.preventDefault();

    const username = document.getElementById("user-login").value;
    const password = document.getElementById("password").value;

    fetch(`http://159.223.173.36/api/index.php/users?Login=${username}&Password=${password}`, {
    })
      .then((response) => response.json())
      .then((data) => {
        if(data.length > 0){
          user = data[0];
          window.location.replace("http://contactsplus.xyz/homePage.html");
        }
        else{
          console.log("WRONG CREDENTIALS")
        }
        
      })
      .catch(e => console.log(e));
      

})
