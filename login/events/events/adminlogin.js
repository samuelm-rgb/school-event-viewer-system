function validateLogin(event) {
    event.preventDefault(); // Prevent default form submission

    let email = document.querySelector('input[type="text"]').value;
    let password = document.querySelector('input[type="password"]').value;

    if (email.toLowerCase() === "admin@gmail.com" && password === "1234567") {
        window.location.href = "admin.html"; // Redirect to admin page
    } else {
        window.location.href = "user-home.html"; // Redirect to user home page
    }
}
