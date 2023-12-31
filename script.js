// Function to simulate typewriter effect
function typeWriter(text, element, delay) {
    let index = 0;
    const interval = setInterval(() => {
        element.textContent += text[index];
        index++;
        if (index === text.length) {
            clearInterval(interval);
        }
    }, delay);
}

// Start the typewriter effect for the admin headings
window.onload = function () {
    const adminHeading = "Welcome admin";
    const adminSubHeading = "Now you can control  .... ";
    const carRentalHeading = "Welcome to Car Rental System";

    const adminHeadingElement = document.getElementById("adminHeading");
    const adminSubHeadingElement = document.getElementById("adminSubHeading");
    const carRentalHeadingElement = document.getElementById("carRentalHeading");

    // Delay in milliseconds between each character
    const delay = 100;

    // Start typing the admin headings
    setTimeout(() => {
        typeWriter(adminHeading, adminHeadingElement, delay);
        adminHeadingElement.style.opacity = 1; // Make the text visible after typing
    }, 500);

    setTimeout(() => {
        typeWriter(adminSubHeading, adminSubHeadingElement, delay);
        adminSubHeadingElement.style.opacity = 1; // Make the text visible after typing
    }, 2000);

    // Start typing the Car Rental System heading after a delay
    setTimeout(() => {
        typeWriter(carRentalHeading, carRentalHeadingElement, delay);
        carRentalHeadingElement.style.opacity = 1; // Make the text visible after typing
    }, 4000);

    // Start typing the customer welcome message
    const customerHeading = "Welcome, Customer!";
    const customerSubHeading = "We're glad to have you with us.";

    const customerHeadingElement = document.getElementById("customerHeading");
    const customerSubHeadingElement = document.getElementById("customerSubHeading");

    // Start typing the customer headings after a delay
    setTimeout(() => {
        typeWriter(customerHeading, customerHeadingElement, delay);
        customerHeadingElement.style.opacity = 1; // Make the text visible after typing
    }, 500);

    setTimeout(() => {
        typeWriter(customerSubHeading, customerSubHeadingElement, delay);
        customerSubHeadingElement.style.opacity = 1; // Make the text visible after typing
    }, 2000);
};
