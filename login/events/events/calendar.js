document.addEventListener("DOMContentLoaded", function() {
    const calendarContainer = document.getElementById("calendar");
    let currentYear = 2025;
    let currentMonth = 0; // January

    function generateCalendar(year, month) {
        const monthNames = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        
        let calendarHTML = `<div class="month-view">
            <h2>${monthNames[month]} ${year}</h2>
            <div class="calendar-grid">
                <div class="day">Sun</div>
                <div class="day">Mon</div>
                <div class="day">Tue</div>
                <div class="day">Wed</div>
                <div class="day">Thu</div>
                <div class="day">Fri</div>
                <div class="day">Sat</div>`;

        for (let i = 0; i < firstDay; i++) {
            calendarHTML += `<div class="day"></div>`; // Empty spaces for alignment
        }

        for (let day = 1; day <= daysInMonth; day++) {
            calendarHTML += `<div class="day">${day}</div>`;
        }

        calendarHTML += `</div></div>`;
        return calendarHTML;
    }

    function updateCalendar() {
        calendarContainer.innerHTML = generateCalendar(currentYear, currentMonth);
    }

    window.changeMonth = function(direction) {
        currentMonth += direction;

        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        } else if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }

        updateCalendar();
    };

    updateCalendar();
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
