import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';
import './styles/mobile.css'
import './styles/login.css'
import './styles/register.css'



console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');


function burger_click() {
    const burgerMenu = document.querySelector('.burger-menu');
    burgerMenu.classList.toggle('show');
}