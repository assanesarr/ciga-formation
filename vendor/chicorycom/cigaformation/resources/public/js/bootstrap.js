window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');
    require('owl.carousel');
    require('owl.carousel2.thumbs');
    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

//window.axios = require('axios');

//window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });

/* global CHICORYCOM_VERSION GIT_HASH */
console.log(
    `${'\n'} 
%c Copyright © ${new Date().getFullYear()} by Chicorycom `,
    'color: #fff; background: #030307; padding:5px 0; font-size: large; font-weight: bold;',
);

console.log(
    `%c Your System and Security Network Integrator  
${'\n'}${'\n'}`,
    'background: #e60000; padding:5px 0;'
)

console.log(
    `%c STOP  
${'\n'}${'\n'}`,
    'text-shadow: 2px 2px #FF0000; font-size: 111px; font-weight: bold;'
)

console.log(
    `%cIl s’agit d’une fonctionnalité de navigateur conçue pour les développeurs. Si quelqu’un vous a invité(e) à copier-coller quelque chose ici pour activer une fonctionnalité ou soit-disant pirater le compte d’un tiers, sachez que c’est une escroquerie permettant à cette personne d’accéder à votre compte.   
${'\n'}`,
    'font-size: large; font-weight: bold;'
)

console.log(
    `%c Voir https://www.chicorycom.net/selfxss pour plus d’informations.
    ${'\n'} Phone: +221 78 153 54 13   
${'\n'}${'\n'}`,
    'font-size: large; font-weight: bold;'
)
