import FetchApi from "../../admin/js/helpers/fetch_api";


class PreRegisterForm extends HTMLElement {
    constructor() {
        super();
        this.shadow = this;
    }

    connectedCallback() {
        this.render();
    }
    static get observedAttributes() {
        return [];
    }

    render(){


        this.submit = document.createElement('button');
        this.submit.setAttribute('class','primary-btn');
        this.submit.setAttribute('type','submit');
        this.submit.textContent = 'Envoyer';
        this.form = document.createElement('form');

        this.form.setAttribute('class', 'form_area');
        //body.setAttribute('action', 'form_area');
        this.form.innerHTML = ` <div class="row">
                                    <div class="col-lg-12 form_group">
                                        <input
                                            name="name"
                                            placeholder="votre nom"
                                            required
                                            type="text"
                                        />
                                        <input
                                            name="phone"
                                            placeholder="Votre numéro de téléphone"
                                            required
                                            type="tel"
                                        />
                                        <input
                                            name="email"
                                            placeholder="Votre adresse email"
                                            pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{1,63}$"
                                            required
                                            type="email"
                                        />
                                    </div>
                                </div>`;
       // this.form = body.getElementsByTagName('form')[0];
        //this.loginContent = body.getElementsByTagName('form')[0];
        this.form.appendChild(this.submit);
        this.form.addEventListener("submit", this.formSubmit.bind(this));
        this.shadow.appendChild(this.form)
    }

    formSubmit(e) {
        e.preventDefault();
        if(this.alertElement){
            this.alertElement.remove()
        }
        this.submit.innerHTML = `
            <div class="spinner-border text-light" role="status">
                 <span class="sr-only">Loading...</span>
            </div>
       `;
        this.alertElement = document.createElement('div');
        this.alertElement.setAttribute('class', 'alert alert-danger');
        const formData = new FormData(this.form);
        //formData.append('_token', )
        FetchApi.postForm('/pre-register', formData)
            .then(response => {
                this.alertElement.setAttribute('class', 'alert alert-success');
                this.alertElement.innerHTML = `Register success.!!! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>`;
                this.form.prepend(this.alertElement);
                if('redirect' in response){
                    window.location.href = response.redirect
                }
            }).catch(e => {
            const message = Object.values(e.errors).join(', ') + `<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>`;
            this.alertElement.innerHTML = message;
            this.alertElement.setAttribute('class', 'alert alert-danger');
            this.form.prepend(this.alertElement)
        }).finally(()=>{
            this.submit.innerHTML = `<span class="">Envoyer</span>`
        });
    }
}

customElements.define('pre-register-form', PreRegisterForm);
