
document.querySelector("#create-contact").addEventListener("click", (e) => {

    e.preventDefault();

    firstName = document.getElementById("first-name").value;
    lastName = document.getElementById("last-name").value;
    email = document.getElementById("email-address").value;
    phoneNumber = document.getElementById("phone-number").value;
    Status = document.getElementById("Status").value;
    address = document.getElementById("Address").value;

    let tmp = {FirstName:firstName, LastName:lastName, Email:email, Phone:phoneNumber, Address:address, Status:Status, };
    
    fetch(`http://159.223.173.36/api/index.php/contacts/${localStorage.getItem('userID')}`, {
        method: "POST",
        body: JSON.stringify(tmp)
    })
        .then(response => response.json())
        .then(data =>{
            if (data === "Contacts created successfully") {
                window.location.replace("http://contactsplus.xyz/homePage.html");
            }
            else{
                console.log(data)
            }
        })
        .catch(e => console.log(e));
})