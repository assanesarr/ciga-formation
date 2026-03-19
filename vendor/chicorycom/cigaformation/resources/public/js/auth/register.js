import FetchApi from "../../../admin/js/helpers/fetch_api";

class register extends HTMLElement {

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
        this.submit.setAttribute('class','btn btn-outline-primary btn-block');
        this.submit.setAttribute('type','submit');
        this.submit.textContent = 'S\'inscrire';
        this.form = document.createElement('form');

        this.form.setAttribute('class', 'register-form');
        this.form.setAttribute('method', 'POST');
        //body.setAttribute('action', 'form_area');
        this.form.innerHTML = `
                        <div class="form-group">
                            <label for="first_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="first_name" id="first_name" placeholder="Votre Prénom"/>
                        </div>
                        <div class="form-group">
                            <label for="last_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="last_name" id="last_name" placeholder="Votre Nom"/>
                        </div>
                        <div class="form-group">
                            <label for="code"><i class="zmdi zmdi-shield-security "></i></label>
                            <input type="text" name="code" id="code" placeholder="Matricule"/>
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email" placeholder="Your Email" required autocomplete="email"/>
                        </div>
                        <div class="form-group">
                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="pass" placeholder="Password" required autocomplete="new-password"/>
                        </div>
                        <div class="form-group">
                            <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" name="password_confirmation" id="re_pass" placeholder="Repeat your password"/>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>
                                J'accepte toutes les déclarations <a href="#" class="term-service">des conditions d'utilisation</a></label>
                        </div>
                    `;

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
        FetchApi.postForm('/register', formData)
            .then(() => {
                this.alertElement.setAttribute('class', 'alert alert-success');
                this.alertElement.innerHTML = `Register success.!!! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>`;
                this.form.prepend(this.alertElement);
                window.location.href = '/espace-etudiants'
            }).catch(e => {
            const message = Object.values(e.errors).join(', ') + `<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>`;
            this.alertElement.innerHTML = message;
            this.alertElement.setAttribute('class', 'alert alert-danger');
            this.form.prepend(this.alertElement)
        }).finally(()=>{
            this.submit.innerHTML = `<span class="">S'inscrire</span>`
        });
    }
}

customElements.define('auth-register', register);
