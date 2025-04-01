document.addEventListener("DOMContentLoaded", function () {
    // Form Submission
    const form = document.getElementById("supportForm");
    const formResponse = document.getElementById("formResponse");

    if (form) {
        form.addEventListener("submit", function (event) {
            event.preventDefault();
            if (formResponse) {
                formResponse.textContent = "Your message has been sent!";
                formResponse.style.color = "green";
            }
            this.reset();
        });
    } else {
        console.error("Form not found!");
    }

    // FAQ Toggle
    document.querySelectorAll(".faq-question").forEach(button => {
        button.addEventListener("click", function () {
            const answer = this.nextElementSibling;
            const icon = this.querySelector(".toggle-icon");

            if (answer.style.display === "block") {
                answer.style.display = "none";
                if (icon) icon.textContent = "+";
            } else {
                answer.style.display = "block";
                if (icon) icon.textContent = "-";
            }
        });
    });
});
