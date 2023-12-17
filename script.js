// Function to create buttons
function createButton(text, id) {
    const button = document.createElement('button');
    button.textContent = text;
    button.id = id;
    return button;
}
                        //Function to check if there any empty values before submitting the form
function SubmitForm() {
                var password = document.getElementById("pass").value;
                var mail = document.getElementById("mail").value;
                var name = document.getElementById("name").value;

                if (name == "") {
                    alert("Name can't be empty");
                    return false;
                }

                if (mail == "") {
                    alert("Email can't be empty");
                    return false;
                }

                if (password == "") {
                    alert("Password can't be empty");
                    return false;
                }

                if (!validatePassword()) {
                    return false;
                }

                return true;
            }


// Create buttons
const homeButton = createButton('Home', 'homeBtn');
const registerButton = createButton('Register Car', 'registerBtn');
const reservationButton = createButton('Reservation', 'reservationBtn');
const reportsButton = createButton('Reports', 'reportsBtn');

// Append buttons to the navigation
const nav = document.querySelector('nav ul');
nav.appendChild(homeButton);
nav.appendChild(registerButton);
nav.appendChild(reservationButton);
nav.appendChild(reportsButton);
