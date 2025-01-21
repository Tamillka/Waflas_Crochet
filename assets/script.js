

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
        if (heroSection) { // Pārbaudām, vai #hero eksistē
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        heroSection.classList.add('in-view');
                    }
                });
            });
            observer.observe(heroSection);
        }
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
    if (slider) { // Pārbaudām, vai slider eksistē
        const leftArrow = document.querySelector('.arrow.left');
        const rightArrow = document.querySelector('.arrow.right');
        let scrollAmount = 0;
        const scrollStep = slider.offsetWidth / 3;
    
        function updateArrows() {
            if (scrollAmount <= 0) {
                leftArrow.classList.add('disabled');
            } else {
                leftArrow.classList.remove('disabled');
            }
    
            if (scrollAmount >= slider.scrollWidth - slider.offsetWidth) {
                rightArrow.classList.add('disabled');
            } else {
                rightArrow.classList.remove('disabled');
            }
        }
    
        rightArrow.addEventListener('click', () => {
            if (scrollAmount < slider.scrollWidth - slider.offsetWidth) {
                scrollAmount += scrollStep;
                slider.scrollTo({
                    top: 0,
                    left: scrollAmount,
                    behavior: 'smooth'
                });
                updateArrows();
            }
        });
    
        leftArrow.addEventListener('click', () => {
            if (scrollAmount > 0) {
                scrollAmount -= scrollStep;
                slider.scrollTo({
                    top: 0,
                    left: scrollAmount,
                    behavior: 'smooth'
                });
                updateArrows();
            }
        });
    
        updateArrows(); // Sākotnējā bultiņu pārbaude
    }
  

   
        // Atrodam visas pogas, kuras atver popupus
        const openBtns = document.querySelectorAll('[data-target]');
        const closeBtns = document.querySelectorAll('.closeBtn');
        // Pievienojam klikšķa notikumu katrai pogai
        openBtns.forEach(function(btn) {
            btn.addEventListener("click", function() {
                const popup = document.querySelector(btn.dataset.target);
                if (popup) {
                    popup.classList.add('popup-active');
    
                    // Apstrādājam attēlu galeriju, ja tā eksistē popup
                    const thumbnails = popup.querySelectorAll(".thumbnail");
                    const mainImage = popup.querySelector(".large-image");
    
                    if (thumbnails.length > 0 && mainImage) {
                        thumbnails.forEach(thumbnail => {
                            thumbnail.addEventListener("click", function() {
                                const largeImageSrc = thumbnail.getAttribute("data-large");
                                mainImage.src = largeImageSrc;
    
                                // Noņemam 'active' klasi visiem sīktēliem
                                thumbnails.forEach(thumb => thumb.classList.remove("active"));
    
                                // Pievienojam 'active' klasi noklikšķinātajam sīktēlam
                                thumbnail.classList.add("active");
                            });
                        });
                    }
                }
            });
       
    
        // Aizveram popup, kad klikšķinām uz aizvēršanas pogas
        closeBtns.forEach(function(btn) {
            btn.addEventListener("click", function() {
                const popup = document.querySelector(btn.dataset.target);
                if (popup) {
                    popup.classList.remove('popup-active');
                }
            });
        });
    });





    

    


 
