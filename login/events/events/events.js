document.addEventListener("DOMContentLoaded", function () {
    const eventsWrapper = document.querySelector(".events-wrapper");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    const scrollLeftBtn = document.querySelector(".scroll-left");
    const scrollRightBtn = document.querySelector(".scroll-right");
    const moreDetailsBtns = document.querySelectorAll(".more-details");

    const scrollAmount = 300; // Adjust as needed

    // Scroll left
    if (prevBtn && eventsWrapper) {
        prevBtn.addEventListener("click", function () {
            eventsWrapper.scrollBy({ left: -scrollAmount, behavior: "smooth" });
        });
    }

    // Scroll right
    if (nextBtn && eventsWrapper) {
        nextBtn.addEventListener("click", function () {
            eventsWrapper.scrollBy({ left: scrollAmount, behavior: "smooth" });
        });
    }

    // Scroll buttons (if used elsewhere)
    if (scrollLeftBtn && scrollRightBtn && eventsWrapper) {
        scrollLeftBtn.addEventListener("click", () => {
            eventsWrapper.scrollBy({ left: -scrollAmount, behavior: "smooth" });
        });

        scrollRightBtn.addEventListener("click", () => {
            eventsWrapper.scrollBy({ left: scrollAmount, behavior: "smooth" });
        });
    }

    // Toggle event details
    moreDetailsBtns.forEach(button => {
        button.addEventListener("click", function () {
            const eventId = this.getAttribute("data-id"); // Get event ID from data attribute
            const details = document.getElementById(`details-${eventId}`);
            if (details) {
                details.style.display = details.style.display === "block" ? "none" : "block";
            }
        });
    });
});


document.addEventListener("DOMContentLoaded", function () {
    fetch("fetch_event_dates.php") // Get event dates and names from database
        .then(response => response.json())
        .then(data => {
            let container = document.getElementById("event-dates-container");
            container.innerHTML = ""; // Clear any existing content

            data.forEach(event => {
                let dateBox = document.createElement("div");
                dateBox.className = "event-date-box";
                dateBox.innerHTML = `<strong>${event.date}</strong><br>${event.name}`; // Display date and event name
                dateBox.onclick = () => showEventsForDate(event.date, event.name); // Pass both date and event name
                container.appendChild(dateBox);
            });
        })
        .catch(error => console.log("Error loading dates:", error));
});

// Function to show events for a selected date
function showEventsForDate(date, name) {
    alert(`Event on ${date}: ${name}`);
}
