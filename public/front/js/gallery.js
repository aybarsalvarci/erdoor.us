document.addEventListener('DOMContentLoaded', function () {

    if (typeof Fancybox !== "undefined") {
        Fancybox.bind('[data-fancybox="gallery"]', {});
    }

    const loadMoreBtn = document.getElementById('loadMoreBtn');
    const galleryGrid = document.getElementById('galleryGrid');

    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function () {
            const btn = this;
            const url = btn.getAttribute('data-next-page');
            const btnText = btn.querySelector('.btn-text');
            const btnIcon = btn.querySelector('.btn-icon');
            const originalText = btnText.innerText;

            if (!url) return;

            btnText.innerText = 'Yükleniyor...';
            btnIcon.classList.remove('fa-plus');
            btnIcon.classList.add('fa-spinner', 'fa-spin');
            btn.setAttribute('disabled', 'true');

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');

                    const newItems = doc.querySelectorAll('#galleryGrid .gallery-item');

                    newItems.forEach(item => {
                        galleryGrid.appendChild(item);
                    });

                    const newBtn = doc.getElementById('loadMoreBtn');
                    if (newBtn && newBtn.hasAttribute('data-next-page')) {
                        btn.setAttribute('data-next-page', newBtn.getAttribute('data-next-page'));
                        btnText.innerText = originalText;
                        btnIcon.classList.remove('fa-spinner', 'fa-spin');
                        btnIcon.classList.add('fa-plus');
                        btn.removeAttribute('disabled');
                    } else {
                        btn.remove();
                    }
                })
                .catch(error => {
                    console.error('Yükleme hatası:', error);
                    btnText.innerText = 'Tekrar Dene';
                    btnIcon.classList.remove('fa-spinner', 'fa-spin');
                    btnIcon.classList.add('fa-rotate-right');
                    btn.removeAttribute('disabled');
                });
        });
    }
});
