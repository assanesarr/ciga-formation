(function () {
    let buttom = document.querySelector("#navbar-toggler");
    const body = document.body;
    buttom.addEventListener('click', e => {
        e.stopPropagation();
        body.classList.toggle('has-sidebar')
    })
    body.addEventListener('click', function(){
        if(this.classList.contains('has-sidebar')){
            this.classList.toggle('has-sidebar')
        }
    })

})();
