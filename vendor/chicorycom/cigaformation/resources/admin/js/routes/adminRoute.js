import Layout from '../layouts/container'
import Vue from "vue";

function page (path) {
    return () => import(`../pages/${path}.vue`).then(m => m.default || m).catch(() => import(`../errors/404.vue`).then(m => m.default || m))
}
window.$menus = JSON.parse(document.body.dataset.page);
Vue.prototype.$datas = $menus;

const menus = function () {
    const menus = [];
    const returne = [];
    menus.push($menus.filter(menu => menu.children.length === 0 && menu.icon)[0]);
    $menus.filter(menu => menu.children.length > 0 )
        .map(re => re.children)
        .forEach(re => {
            re.forEach(tt => {
                menus.push(tt);
            })
        });
     menus.forEach(data => {
        returne.push({
            path: data.slug,
            name: data.name.toLowerCase(),
            component: page(`${data.slug}`)
        })
    });

    return  returne;     //let responseData = await response.json();
};

export default {
  path: '/',
  name: 'home',
  component: Layout,
  redirect: '/dashboard',
  children: [
      ...menus(),
      {
          path: '/formations/create',
          name: 'create',
          component: page('/formations/create')
      }
  ]
}


