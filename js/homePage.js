const contactList = [
    {
        "userID": "2",
        "contactID": "4",
        "FirstName": "Real",
        "LastName": "Person",
        "Email": "anemail@gmail.com",
        "Phone": "123-456-7890",
        "Address": "Mars",
        "Status": "Human",
        "DateCreated": "2022-08-30 20:29:33"
      },
      {
        "userID": "2",
        "contactID": "6",
        "FirstName": "Bruce",
        "LastName": "Wayne",
        "Email": "Bruce_wayne@waynetech.com",
        "Phone": "148-782-3789",
        "Address": "Wayne Manor, Gotham",
        "Status": "Is Totally Batman",
        "DateCreated": "2022-09-07 22:13:25"
      },
      {
        "userID": "2",
        "contactID": "7",
        "FirstName": "Clark",
        "LastName": "Kent",
        "Email": "Clark_Kent@dailyplanet.com",
        "Phone": "893-836-9362",
        "Address": "Daily Planet Metropolis",
        "Status": "Not Superman",
        "DateCreated": "2022-09-07 22:16:29"
      },
      {
        "userID": "1",
        "contactID": "1",
        "FirstName": "Harry",
        "LastName": "Potter",
        "Email": "harrypotter@gmail.wiz",
        "Phone": "999-123-4567",
        "Address": "7 Magical Ave, London",
        "Status": "Friend",
        "DateCreated": "2022-08-30 20:29:27"
      },
      {
        "userID": "1",
        "contactID": "2",
        "FirstName": "Thomas",
        "LastName": "Riddle",
        "Email": "triddle@gmail.wiz",
        "Phone": "666-123-4567",
        "Address": "79 Evil Ave, London",
        "Status": "Enemy",
        "DateCreated": "2022-08-30 20:29:27"
      },
      {
        "userID": "1",
        "contactID": "3",
        "FirstName": "Margot",
        "LastName": "Robbie",
        "Email": "margotrobbie@barbie.com",
        "Phone": "332-445-6759",
        "Address": "42 Sherman Wallaby Way",
        "Status": "Friend",
        "DateCreated": "2022-08-30 20:29:28"
      }
]

const profilePic = "https://thumbs.dreamstime.com/z/extreme-close-up-red-green-tree-frog-right-profile-cr-extreme-close-up-red-green-tree-frog-right-profile-189835719.jpg";
const list = document.getElementById("contact-list");


function getContact(e){
    const id = e.lastElementChild.innerHTML;
    
    const contactData = contactList.filter(c => c.contactID == id)[0];

    const name = document.getElementById("name");
    name.innerHTML = contactData.FirstName;

    const lastName = document.getElementById("last");
    lastName.innerHTML = contactData.LastName;

    const status = document.getElementById("status");
    status.innerHTML = contactData.Status;

    const email = document.getElementById("email");
    email.innerHTML = contactData.Email;

    const phone = document.getElementById("phone");
    phone.innerHTML = contactData.Phone;

    const address = document.getElementById("address");
    address.innerHTML = contactData.Address;
}



const listItems = contactList.map( (element) => {

    //document.addEventListener('click', getContact){}

    return (
    `<div onclick="getContact(this)">
        <li class='flex cursor-pointer hover:bg-white'">
            <img
                class="w-10 h-10 rounded-[50%] my-5 mx-3"
                src=${profilePic}
            /> 
            <div class='my-5'>
                <div class='flex max-w-[50%]'>
                    <p class="pr-2">${element.FirstName}</p>
                    <p>${element.LastName}</p>
                </div>
                <p class="text-gray-600">
                    ${element.Status}
                </p>
            </div>
        </li>
        
        <hr class= 'bg-gray-300'>
        <p id='id' class='hidden'>${element.contactID}</p>
    </div>
    `
    )
});
list.innerHTML = listItems.join("");