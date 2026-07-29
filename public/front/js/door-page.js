document.addEventListener('DOMContentLoaded', () => {
    const productImage = document.getElementById('productImage');
    const finishTooltip = document.getElementById('finishTooltip');
    const swatches = Array.from(document.querySelectorAll('.finish-swatch'));
    const imageLightbox = document.getElementById('imageLightbox');
    const lightboxImage = document.getElementById('lightboxImage');
    const lightboxClose = document.getElementById('lightboxClose');
    const detailImages = Array.from(document.querySelectorAll('.detail-lightbox-trigger'));
    let currentImage = productImage ? productImage.getAttribute('src') : '';
    let swapTimer;

    if (!productImage) return;

    const activateSwatch = (swatch) => {
        const nextImage = swatch.dataset.doorImage;
        if (!nextImage || nextImage === currentImage) return;

        window.clearTimeout(swapTimer);
        currentImage = nextImage;
        productImage.classList.add('opacity-0');

        swatches.forEach((button) => {
            button.classList.remove('ring-2', 'ring-gray-950');
            button.classList.add('ring-1', 'ring-gray-200');
        });
        swatch.classList.remove('ring-1', 'ring-gray-200');
        swatch.classList.add('ring-2', 'ring-gray-950');

        swapTimer = window.setTimeout(() => {
            productImage.src = nextImage;
            productImage.classList.remove('opacity-0');
        }, 150);
    };

    const moveTooltip = (event, swatch) => {
        const offset = 14;
        finishTooltip.textContent = swatch.dataset.colorName || 'Finish';
        finishTooltip.classList.remove('invisible', 'opacity-0');
        finishTooltip.classList.add('opacity-100');

        const tooltipWidth = finishTooltip.offsetWidth;
        const tooltipHeight = finishTooltip.offsetHeight;
        const maxLeft = window.innerWidth - tooltipWidth - 8;
        const maxTop = window.innerHeight - tooltipHeight - 8;
        const left = Math.min(Math.max(event.clientX + offset, 8), maxLeft);
        const top = Math.min(Math.max(event.clientY + offset, 8), maxTop);

        finishTooltip.style.transform = `translate3d(${left}px, ${top}px, 0)`;
    };

    const hideTooltip = () => {
        finishTooltip.classList.add('invisible', 'opacity-0');
        finishTooltip.classList.remove('opacity-100');
    };

    swatches.forEach((swatch) => {
        swatch.addEventListener('mouseenter', () => activateSwatch(swatch));
        swatch.addEventListener('mousemove', (event) => {
            activateSwatch(swatch);
            moveTooltip(event, swatch);
        });
        swatch.addEventListener('mouseleave', hideTooltip);
        swatch.addEventListener('click', () => activateSwatch(swatch));
    });

    const closeLightbox = () => {
        imageLightbox.classList.add('hidden');
        imageLightbox.classList.remove('flex');
        lightboxImage.src = '';
        document.body.classList.remove('overflow-hidden');
    };

    detailImages.forEach((button) => {
        button.addEventListener('click', () => {
            const image = button.querySelector('img');
            lightboxImage.src = button.dataset.lightboxSrc || image.src;
            lightboxImage.alt = image.alt || 'Expanded product detail';
            imageLightbox.classList.remove('hidden');
            imageLightbox.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        });
    });

    if (lightboxClose) {
        lightboxClose.addEventListener('click', closeLightbox);
    }

    if (imageLightbox) {
        imageLightbox.addEventListener('click', (event) => {
            if (event.target === imageLightbox) closeLightbox();
        });
    }

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && imageLightbox && !imageLightbox.classList.contains('hidden')) {
            closeLightbox();
        }
    });
});
