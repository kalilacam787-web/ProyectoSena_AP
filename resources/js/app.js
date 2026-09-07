import './bootstrap';

const convocatoriaAd = document.querySelector('#convocatoria-anuncio');
const convocatoriaClose = convocatoriaAd?.querySelector('.convocatoria-close');

if (convocatoriaAd && sessionStorage.getItem('convocatoria-ad-dismissed') === 'true') {
	convocatoriaAd.classList.add('is-dismissed');
}

convocatoriaClose?.addEventListener('click', () => {
	convocatoriaAd.classList.add('is-dismissed');
	sessionStorage.setItem('convocatoria-ad-dismissed', 'true');
});
