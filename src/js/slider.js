
// import Swiper JS
import Swiper,{ Navigation } from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation';

document.addEventListener('DOMContentLoaded',function () {
    if (document.querySelector('.slider')) {
        const opciones = {
            slidesPerView: 3,
            spaceBetween: 10,
            freeMode: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            breakpoints: {

                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 4,
                },
                1200: {
                    slidesPerView: 5,
                }
            }
        }
        Swiper.use([ Navigation ]);
        new Swiper('.slider',opciones)
    }
});
