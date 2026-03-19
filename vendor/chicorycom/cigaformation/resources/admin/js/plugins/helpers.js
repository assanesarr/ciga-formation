import Vue from 'vue';
import objectToFormData from './objectToFormData';
import Swal from "sweetalert2"
const dateFormat = require('dateformat');

/**
 *
 * @param {string}title
 * @returns {string}
 */
function  sanitizeTitle(title) {
    let slug = "";
    // Change to lower case
    let titleLower = title.toLowerCase();
    // Letter "e"
    slug = titleLower.replace(/e|é|è|ẽ|ẻ|ẹ|ê|ế|ề|ễ|ể|ệ/gi, 'e');
    // Letter "a"
    slug = slug.replace(/a|á|à|ã|ả|ạ|ă|ắ|ằ|ẵ|ẳ|ặ|â|ấ|ầ|ẫ|ẩ|ậ/gi, 'a');
    // Letter "o"
    slug = slug.replace(/o|ó|ò|õ|ỏ|ọ|ô|ố|ồ|ỗ|ổ|ộ|ơ|ớ|ờ|ỡ|ở|ợ/gi, 'o');
    // Letter "u"
    slug = slug.replace(/u|ú|ù|ũ|ủ|ụ|ư|ứ|ừ|ữ|ử|ự/gi, 'u');
    // Letter "d"
    slug = slug.replace(/đ/gi, 'd');
    // Trim the last whitespace
    slug = slug.replace(/\s*$/g, '');
    // Change whitespace to "-"
    slug = slug.replace(/\s+/g, '-');

    return slug;
}


/**
 *
 * @param {Object}data
 * @param {function}callback
 */
function del(data, callback) {
    Swal.fire({
        title: 'Êtes-vous sûr?',
        text: `de vouloire Supprimer définitivement`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'red',
        confirmButtonText: 'Oui, supprimez-le!',
        cancelButtonText: 'Non, garde-le'
    }).then(async result => {
        if (result.value) {
           await callback(data);
        }
    });
}



const Chicorycom = {
    install(Vue, options) {
        Vue.prototype.gformData = objectToFormData,
        Vue.prototype.slugify = sanitizeTitle,
        Vue.prototype.$dateFormat = dateFormat,
        Vue.prototype.$delete = del
    },
}
Vue.use(Chicorycom);
