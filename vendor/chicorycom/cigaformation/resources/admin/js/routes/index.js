import adminRoute from './adminRoute'
import NotFound from '~/errors/404.vue'
function page (path) {
    return () => import(`~/pages${path}.vue`).then(m => m.default || m).catch(() => import(`../pages/default.vue`).then(m => m.default || m))
}
const routes = [
    { path: '/login', name: 'login', component: page('/auth/login') },
    { path: '/register', name: 'register', component: page('/auth/register') },
    { path: '/password/reset', name: 'password.request', component: page('/auth/password/email') },
    { path: '/password/reset/:token', name: 'password.reset', component: page('/auth/password/reset') },
    { path: '/email/verify/:id', name: 'verification.verify', component: page('/auth/verification/verify') },
    { path: '/email/resend', name: 'verification.resend', component: page('/auth/verification/resend') },
    adminRoute,
    {
        path: '*',
        components: { NotFound }
    }
]



/**
 * Asynchronously load view (Webpack Lazy loading compatible)
 * The specified component must be inside the Views folder
 * @param  {string} name  the filename (basename) of the view to load.
function view(name) {
   var res= require('../components/Dashboard/Views/' + name + '.vue');
   return res;
};**/

export default routes
