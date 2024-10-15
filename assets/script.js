let lastScrollTop = 7;
    const header = document.querySelector('header');

    window.addEventListener('scroll', function() {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        if (scrollTop > lastScrollTop) {
            // Scroll down
            header.style.top = '-7rem';
        } else {
            // Scroll up
            header.style.top = '0';
        }
        lastScrollTop = scrollTop;
    });

    document.addEventListener('DOMContentLoaded', function() {
        const animateElements = document.querySelectorAll('.animate');

        function onScroll() {
            animateElements.forEach(element => {
                const rect = element.getBoundingClientRect();
                if (rect.top < window.innerHeight && rect.bottom > 0) {
                    element.classList.add('visible');
                } else {
                    element.classList.remove('visible');
                }
            });
        }

        window.addEventListener('scroll', onScroll);
        onScroll(); // Initial check on load
    });


    document.addEventListener('DOMContentLoaded', function() {
        const heroSection = document.querySelector('#hero');
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    heroSection.classList.add('in-view');
                }
            });
        });
        observer.observe(heroSection);
    });

    document.querySelectorAll('.jautajums-bez-atb').forEach(item => {
        item.addEventListener('click', function() {
            // Atrodam atbilstošo atbildi un ikonu
            const atbilde = this.nextElementSibling;
            const ikona = this.querySelector('i');
            
            // Pārslēdzam atbildes redzamību
            atbilde.classList.toggle('visible');
    
            // Pārslēdzam ikonu starp plusu un mīnusu ar rotāciju
            ikona.classList.toggle('rotate');
            
            // Pārslēdzam ikonu starp plusu un mīnusu
            if (ikona.classList.contains('fa-plus')) {
                ikona.classList.remove('fa-plus');
                ikona.classList.add('fa-minus');
            } else {
                ikona.classList.remove('fa-minus');
                ikona.classList.add('fa-plus');
            }
        });
    });

    const slider = document.querySelector('.atsauksmes');
    const leftArrow = document.querySelector('.arrow.left');
    const rightArrow = document.querySelector('.arrow.right');
    let scrollAmount = 0;
    const scrollStep = slider.offsetWidth / 3; // Scroll by the width of three testimonials at a time

    // Function to update arrow states (disable/enable based on scroll position)
    function updateArrows() {
        if (scrollAmount <= 0) {
            leftArrow.classList.add('disabled'); // Disable left arrow
        } else {
            leftArrow.classList.remove('disabled'); // Enable left arrow
        }

        if (scrollAmount >= slider.scrollWidth - slider.offsetWidth) {
            rightArrow.classList.add('disabled'); // Disable right arrow
        } else {
            rightArrow.classList.remove('disabled'); // Enable right arrow
        }
    }

    // Scroll right
    rightArrow.addEventListener('click', () => {
        if (scrollAmount < slider.scrollWidth - slider.offsetWidth) {
            scrollAmount += scrollStep;
            slider.scrollTo({
                top: 0,
                left: scrollAmount,
                behavior: 'smooth'
            });
            updateArrows(); // Update arrow states after scrolling
        }
    });

    // Scroll left
    leftArrow.addEventListener('click', () => {
        if (scrollAmount > 0) {
            scrollAmount -= scrollStep;
            slider.scrollTo({
                top: 0,
                left: scrollAmount,
                behavior: 'smooth'
            });
            updateArrows(); // Update arrow states after scrolling
        }
    });

    // Initial arrow state update
    updateArrows();



// Get all buttons that should open popups
const openBtns = document.querySelectorAll(".openPopupBtn");

// Attach click event to each button
openBtns.forEach(function(btn) {
    btn.addEventListener("click", function() {
        const popupId = btn.getAttribute("data-popup"); // Get the corresponding popup ID from the data attribute
        const popup = document.getElementById(popupId); // Get the popup element by its ID
        popup.style.display = "flex"; // Display the popup

        // Handle the image gallery for this specific popup
        const thumbnails = popup.querySelectorAll(".thumbnail"); // Get all thumbnails in this popup
        const mainImage = popup.querySelector(".large-image"); // Get the main image in this popup

        // Add click event to each thumbnail
        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener("click", function() {
                // Change main image source
                const largeImageSrc = thumbnail.getAttribute("data-large"); // Get the large image source from the data attribute
                mainImage.src = largeImageSrc; // Change the main image's source to the clicked thumbnail's large image
                
                // Remove 'active' class from all thumbnails in this popup
                thumbnails.forEach(thumb => thumb.classList.remove("active"));
                
                // Add 'active' class to the clicked thumbnail
                thumbnail.classList.add("active");
            });
        });
    });
});

// Get all close buttons and attach event listeners
const closeBtns = document.querySelectorAll(".closeBtn");

closeBtns.forEach(function(closeBtn) {
    closeBtn.addEventListener("click", function() {
        const popup = closeBtn.closest(".popup"); // Find the closest parent popup element
        popup.style.display = "none"; // Hide the popup
    });
});

// Close the popup if the user clicks outside of it
window.onclick = function(event) {
    if (event.target.classList.contains("popup")) {
        event.target.style.display = "none";
    }
};