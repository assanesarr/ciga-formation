import FetchApi from "../../../admin/js/helpers/fetch_api";

class login extends HTMLElement {
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
        this.submit.textContent = 'Login';
        this.form = document.createElement('form');

        this.form.setAttribute('class', 'register-form');
        this.form.setAttribute('method', 'POST');
        //body.setAttribute('action', 'form_area');
        this.form.innerHTML = `
                           
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="email" name="email" id="email" required autocomplete="email" autofocus />
                        </div>
                        <div class="form-group">
                            <label for="password"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="password" required autocomplete="current-password"/>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="remember" id="remember" class="agree-term" />
                            <label for="remember" class="label-agree-term"><span><span></span></span>Remember me</label>
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
        FetchApi.postForm('/login', formData)
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
            this.submit.innerHTML = `<span class="">Login</span>`
        });
    }
}

customElements.define('auth-login', login);
