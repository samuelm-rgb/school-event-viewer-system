document.addEventListener("DOMContentLoaded", function () {
    fetch("fetch_announcements.php")
        .then(response => response.json())
        .then(data => {
            let slider = document.getElementById("announcement-slider");

            data.forEach(announcement => {
                let slide = document.createElement("div");
                slide.classList.add("swiper-slide");
                slide.innerHTML = `
                    <div class="announcement-box">
                        <h3>${announcement.title}</h3>
                        <p>${announcement.description}</p>
                    </div>
                `;
                slider.appendChild(slide);
            });

            // Initialize Swiper after dynamically adding slides
            new Swiper(".swiper-container", {
                slidesPerView: 3,
                spaceBetween: 15,
                loop: true,
                autoplay: {
                    delay: 3000,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });
        })
        .catch(error => console.error("Error fetching announcements:", error));
});
