document.querySelector("#create-contact").addEventListener("click", (e) => {

    e.preventDefault();

    firstName = document.getElementById("first-name").value;
    lastName = document.getElementById("last-name").value;
    email = document.getElementById("email-address").value;
    phoneNumber = document.getElementById("phone-number").value;
    Status = document.getElementById("Status").value;
    address = document.getElementById("Address").value;
    document.getElementById("ContactResult").innerHTML = "";

    // add correct names from database
    let tmp = {:firstName, :lastName, :email, :phoneNumber, :Status, :address};
    
    // change endpoint to correct one once received
    fetch(/*"http://159.223.173.36/api/index.php/users*/", {
        method: "POST",
        body: JSON.stringify(tmp)
    })
        .then(response => response.json())
        .then(data =>{
            if (data === "Contact created successfully") {
                window.location.replace("http://contactsplus.xyz/homePage");
            }
        })
        .catch(e => console.log(e));
})