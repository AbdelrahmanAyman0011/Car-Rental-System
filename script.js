// Function to create buttons
function createButton(text, id) {
    const button = document.createElement('button');
    button.textContent = text;
    button.id = id;
    return button;
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
