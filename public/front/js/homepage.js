document.addEventListener('DOMContentLoaded', () => {
    const slides = document.querySelectorAll('.carousel-slide');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    let currentIndex = 0;
    const totalSlides = slides.length;
    let slideInterval;

    if (totalSlides === 0) return;

    const showSlide = (index) => {
        slides.forEach((slide, i) => {
            if (i === index) {
                slide.classList.remove('opacity-0', 'z-0');
                slide.classList.add('opacity-100', 'z-10');
            } else {
                slide.classList.remove('opacity-100', 'z-10');
                slide.classList.add('opacity-0', 'z-0');
            }
        });
    };

    const nextSlide = () => {
        currentIndex = (currentIndex + 1) % totalSlides;
        showSlide(currentIndex);
    };

    const prevSlide = () => {
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        showSlide(currentIndex);
    };

    nextBtn.addEventListener('click', () => {
        nextSlide();
        resetInterval();
    });

    prevBtn.addEventListener('click', () => {
        prevSlide();
        resetInterval();
    });

    const startInterval = () => {
        slideInterval = setInterval(nextSlide, 5000);
    };

    const resetInterval = () => {
        clearInterval(slideInterval);
        startInterval();
    };

    startInterval();
});
