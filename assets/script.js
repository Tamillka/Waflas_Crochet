

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



    document.addEventListener("DOMContentLoaded", function() {
        // Atrodam visas pogas, kuras atver popupus
        const openBtns = document.querySelectorAll(".openPopupBtn");
    
        // Pievienojam klikšķa notikumu katrai pogai
        openBtns.forEach(function(btn) {
            btn.addEventListener("click", function() {
                const popupId = btn.getAttribute("data-popup"); // Saņemam popup ID no 'data-popup'
                const popup = document.getElementById(popupId); // Atrodam popup elementu pēc tā ID
                if (popup) {
                    popup.style.display = "flex"; // Parādam popup
    
                    // Apstrādājam attēlu galeriju, ja tā eksistē popup
                    const thumbnails = popup.querySelectorAll(".thumbnail"); // Atrodam visas sīktēlus popup
                    const mainImage = popup.querySelector(".large-image"); // Atrodam galveno attēlu popup
    
                    if (thumbnails.length > 0 && mainImage) {
                        // Pievienojam klikšķa notikumu katram sīktēlam
                        thumbnails.forEach(thumbnail => {
                            thumbnail.addEventListener("click", function() {
                                // Nomainām galvenā attēla avotu
                                const largeImageSrc = thumbnail.getAttribute("data-large"); // Saņemam lielā attēla avotu no 'data-large'
                                mainImage.src = largeImageSrc; // Nomainām galvenā attēla avotu
    
                                // Noņemam 'active' klasi visiem sīktēliem
                                thumbnails.forEach(thumb => thumb.classList.remove("active"));
    
                                // Pievienojam 'active' klasi noklikšķinātajam sīktēlam
                                thumbnail.classList.add("active");
                            });
                        });
                    }
                }
            });
        });
    
        // Atrodam visas 'aizvērt' pogas
        const closeBtns = document.querySelectorAll(".closeBtn");
    
        // Pievienojam klikšķa notikumu katrai 'aizvērt' pogai
        closeBtns.forEach(function(closeBtn) {
            closeBtn.addEventListener("click", function() {
                const popup = closeBtn.closest(".popup"); // Atrodam popup elementu
                if (popup) {
                    popup.style.display = "none"; // Slēpjam popup
                }
            });
        });
    
        // Slēpjam popup, ja lietotājs klikšķina ārpus popup satura
        window.addEventListener("click", function(event) {
            if (event.target.classList.contains("popup")) {
                event.target.style.display = "none"; // Slēpjam popup
            }
        });
    });

