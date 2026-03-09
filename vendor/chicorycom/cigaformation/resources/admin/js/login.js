import FetchApi from "./helpers/fetch_api";
class ChicorycomLogin extends HTMLElement {
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

    /**
     *
     * @param name
     * @param oldValue
     * @param newValue
     */
    attributeChangedCallback(name, oldValue, newValue) {

    }
    disconnectedCallback() {

    }


    render(){

        const title = this.getAttribute('title') || 'Login';
        this.submit = document.createElement('button');
        this.submit.setAttribute('class','btn btn-primary btn-user btn-block');
        this.submit.setAttribute('type','submit');
        this.submit.textContent = 'Login';
        const body = document.createElement('div');

        body.setAttribute('class', 'card-body p-0 h');
        body.innerHTML = `<div class="row h-100">
                      <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                      <div class="col-lg-6 d-flex align-items-center">
                        
                        <div class="p-5 w-100" id="login-content">
                       
                          <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">${title}</h1>
                          </div>
                          <form class="user">
                            <div class="form-group">
                              <input type="email" class="form-control form-control-user" name="email" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                            </div>
                            <div class="form-group">
                              <input type="password" class="form-control form-control-user" name="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                              <div class="custom-control custom-checkbox small">
                                <input type="checkbox" class="custom-control-input" name="remember" id="customCheck">
                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>`;
        this.form = body.getElementsByTagName('form')[0];
        this.loginContent = body.getElementsByTagName('form')[0];
        this.form.appendChild(this.submit);
        this.form.addEventListener("submit", this.formSubmit.bind(this));
        this.shadow.appendChild(body)
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
         FetchApi.postForm('/administrator/login', formData)
             .then(response => {
                 this.alertElement.setAttribute('class', 'alert alert-success');
                 this.alertElement.textContent = 'Login success.!!!';
                 this.loginContent.prepend(this.alertElement);
                 if('redirect' in response){
                     window.location.href = response.redirect
                 }
             }).catch(e => {
                 const message = Object.values(e.errors).join(', ');
                this.alertElement.textContent = message;
                this.alertElement.setAttribute('class', 'alert alert-danger');
                this.loginContent.prepend(this.alertElement)
            }).finally(()=>{
                this.submit.innerHTML = `<span class="">Login</span>`
            });
    }
}

customElements.define('chicorycom-login', ChicorycomLogin);
