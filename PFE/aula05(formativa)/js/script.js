document.addEventListener('DOMContentLoaded', () => {
    const carousels = document.querySelectorAll('.post-carousel');

    carousels.forEach(carousel => {
        const track = carousel.querySelector('.carousel-track');
        const slides = Array.from(track.children);
        const nextButton = carousel.querySelector('.carousel-button--right');
        const prevButton = carousel.querySelector('.carousel-button--left');
        const dotsNav = carousel.querySelector('.carousel-nav');
        const dots = Array.from(dotsNav.children);

        let currentIndex = 0;
        const updateCarousel = (index) => {
            track.style.transform = `translateX(-${index * 100}%)`;
            dots.forEach(dot => dot.classList.remove('current-indicator'));
            if(dots[index]) dots[index].classList.add('current-indicator');
            if (index === 0) {
                prevButton.classList.add('is-hidden');
                nextButton.classList.remove('is-hidden');
            } else if (index === slides.length - 1) {
                prevButton.classList.remove('is-hidden');
                nextButton.classList.add('is-hidden');
            } else {
                prevButton.classList.remove('is-hidden');
                nextButton.classList.remove('is-hidden');
            }
        };

        // Verifica se há apenas um slide; se sim, esconde controles
        if (slides.length <= 1) {
            if(nextButton) nextButton.classList.add('is-hidden');
            if(prevButton) prevButton.classList.add('is-hidden');
            if(dotsNav) dotsNav.style.display = 'none';
        } else {
            updateCarousel(0); // Inicia com o setup correto
        }

        // Evento clique seta direita
        if(nextButton) {
            nextButton.addEventListener('click', () => {
                if (currentIndex < slides.length - 1) {
                    currentIndex++;
                    updateCarousel(currentIndex);
                }
            });
        }

        // Evento clique seta esquerda
        if(prevButton) {
            prevButton.addEventListener('click', () => {
                if (currentIndex > 0) {
                    currentIndex--;
                    updateCarousel(currentIndex);
                }
            });
        }

        // Evento clique nas bolinhas
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentIndex = index;
                updateCarousel(currentIndex);
            });
        });
    });
    const likeButtons = document.querySelectorAll('.actions-left .action-btn:nth-child(1)');

    likeButtons.forEach(button => {
        button.addEventListener('click', function() {
            this.classList.toggle('liked');
            
            const path = this.querySelector('path');
            if (this.classList.contains('liked')) {
                path.setAttribute('d', 'M3.465 14.502C1.465 12.502 1 10.502 1 8.502c0-3.314 2.686-6 6-6 2.12 0 4.053 1.159 5 2.923C12.947 3.661 14.88 2.502 17 2.502c3.314 0 6 2.686 6 6 0 2 0.465 4-1.535 6L12 21.502l-8.535-7z');
            } else {
                path.setAttribute('d', 'M16.792 3.904A4.989 4.989 0 0 1 21.5 9.122c0 3.072-2.652 4.959-5.197 7.222-2.512 2.243-3.865 3.469-4.303 3.752-.477-.309-2.143-1.823-4.303-3.752C5.141 14.072 2.5 12.167 2.5 9.122a4.989 4.989 0 0 1 4.708-5.218 4.21 4.21 0 0 1 3.675 1.941c.84 1.175.98 1.763 1.12 1.763s.278-.588 1.11-1.766a4.17 4.17 0 0 1 3.679-1.938m0-2a6.14 6.14 0 0 0-4.896 2.149 6.05 6.05 0 0 0-4.797-2.149C3.42 1.904 1 4.542 1 8.622c0 4.29 3.085 6.474 5.925 8.91 2.37 2.029 4.17 3.55 4.636 3.945.36.303.85.303 1.21 0 .466-.395 2.266-1.916 4.636-3.945C20.245 15.096 23.33 12.912 23.33 8.622c0-4.08-2.42-6.718-6.108-6.718Z');
            }
        });
    });

});



