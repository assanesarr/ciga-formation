require('./bootstrap');

import nav_data from './nav_json'
const countryList = require('country-list');
window.country = countryList.getData();
window.nav_data = nav_data;
const sideBarNav = document.querySelector('.js-nav-data');
if(sideBarNav){
    nav_data.forEach(data => {
        const li = document.createElement('li');
        const a = document.createElement('a');
        a.href = `#${data.slug}`
        a.text = data.name;
        a.dataset.section = data.slug;
        a.id = data.slug;
        li.appendChild(a);
        sideBarNav.appendChild(li);
    });
}

$(document).on({
    ajaxStart(){
        $("body").addClass("loading");
    },
    ajaxStop(){
        $("body").removeClass("loading");
    }
});
// Import and add each page to the DOM
/*Array.prototype.forEach.call(links, (link) => {
    console.log(link.import);
    let template = link.import.querySelector('.task-template');
    let clone = document.importNode(template.content, true);
    if (link.href.match('about.html')) {
        document.querySelector('body').appendChild(clone)
    } else {
        document.querySelector('.content').appendChild(clone)
    }
})*/
$('#sidebarCollapse').on('click', function () {
    $('#sidebar').toggleClass('active');
});

document.body.addEventListener('click', (event) => {
    if (event.target.dataset.section) {
        handleSectionTrigger(event)
    } else if (event.target.dataset.modal) {
        handleModalTrigger(event)
    } else if (event.target.classList.contains('modal-hide')) {
        hideAllModals()
    }
});

/**
 *
 * @param event
 * @returns {Promise<void>}
 */
 async function handleSectionTrigger (event) {
   const view = event.target.dataset.section;
   document.querySelectorAll('.js-nav-data li a').forEach(element=>{
       element.classList.remove('current')
   });
    event.target.classList.add('current');
    localStorage.setItem('activeSectionButtonId', view);


     const response = await $.get(`/espace-etudiants/${view}`);
     let template = document.createElement('div');
     template.innerHTML = response;
     const script = template.getElementsByTagName("script")[0];
     template = template.querySelector('.task-template');
     const clone = document.importNode(template.content, true);
     if(script)  clone.appendChild(script);


     $(".js-content").hide().html(clone).fadeIn(1000);
     if( $('#sidebar').hasClass('active')){
         $('#sidebar').toggleClass('active');
     }
}

function activateDefaultSection () {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const p = urlParams.get('p');
    if(p !== null){
        document.querySelector(`a[data-section="${p}"]`).click()
    }else{
        document.getElementById('default').click()
    }
}



function handleModalTrigger (event) {
    hideAllModals()
    const modalId = `${event.target.dataset.modal}-modal`
    document.getElementById(modalId).classList.add('is-shown')
}

function hideAllModals () {
    const modals = document.querySelectorAll('.modal.is-shown')
    Array.prototype.forEach.call(modals, (modal) => {
        modal.classList.remove('is-shown')
    })
    showMainContent()
}



function displayAbout () {
    document.querySelector('#about-modal').classList.add('is-shown')
}


// Default to the view that was active the last time the app was open
const sectionId = localStorage.getItem('activeSectionButtonId');
if (sectionId) {
    const section = document.querySelector(`a[data-section="${sectionId}"]`)
    if (section) section.click()
} else {
    activateDefaultSection();
   // displayAbout()
}


/*$(window).on('hashchange', function() {
   const url = location.hash;
    if(url){
        document.querySelector(url).click();
    }
});

window.onhashchange = async function() {
    console.log('ddd')
}
*/




