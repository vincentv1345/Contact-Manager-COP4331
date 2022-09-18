const submit = document.getElementById("submit");
submit.addEventListener("click", (e) => {

    e.preventDefault();

    const username = document.getElementById("user-login");
    const password = document.getElementById("password");
    const error = document.getElementById("error");

    if(username.value === "" || password.value === ""){
      console.log("WRONG CREDENTIALS")
      error.className = "text-sm text-center text-red-600 font-semibold" 
      error.textContent= "Please enter Username and Password";
      username.className = "relative block w-full appearance-none rounded-none rounded-t-md border-[0.1rem] border-solid border-red-600 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm";
      password.className = "relative block w-full appearance-none rounded-none rounded-b-md border-[0.1rem] border-solid border-red-600 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm";
      return;
    }
    
    fetch(`http://159.223.173.36/api/index.php/users?Login=${username.value}&Password=${password.value}`, {
    })
    .then((response) => response.json())
    .then((data) => {
      if(data.length > 0){
        user = data[0];
        window.location.replace("http://contactsplus.xyz/homePage.html");
      }
        else{
          console.log("WRONG CREDENTIALS")
          error.className = "text-sm text-center text-red-600 font-semibold" 
          error.textContent= "Incorrect Username or Password";
          username.className = "relative block w-full appearance-none rounded-none rounded-t-md border-[0.1rem] border-solid border-red-600 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm";
          password.className = "relative block w-full appearance-none rounded-none rounded-b-md border-[0.1rem] border-solid border-red-600 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm";
        }
        
      })
      .catch(e => console.log(e));
      

})
