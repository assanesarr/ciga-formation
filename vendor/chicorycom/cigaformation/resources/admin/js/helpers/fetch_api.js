const token = document.head.querySelector('meta[name="csrf-token"][content]');
export default class FetchApi{

    /**
     *
     * @param url:string
     * @param formData:object
     * @returns {Promise<any>}
     */
    static postForm(url, formData) {
        return FetchApi.fetchApi(url, 'POST', formData);
    }

    static get(url) {
        return FetchApi.fetchApi(url, 'GET');
    }


    /**
     *
     * @param url:string
     * @param method:string
     * @param data:object
     * @returns {Promise<any>}
     */
    static fetchApi(url, method, data={}) {
        let heade = {
            method: method,
            headers: this.header(),
            credentials: "same-origin",
        }
        if(method === 'POST')  heade = {...heade, body: data};

        return new Promise((resolve, reject)=> {
            fetch(url, heade).then(response => {
                if (!response.ok) { throw response }
                return response.json().then(res => resolve(res))
            }).catch(err=>{
                if (typeof err.text === 'function') {
                    const status = err.status;
                    err.json().then(errorMessage => {
                        errorMessage.status = status;
                        reject(errorMessage)
                    }).catch(err=>{
                        reject(err)
                    });
                } else {
                    reject(err)
                }
            })
        });
    }

    static header(){
        return new Headers({
            //"Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-Token": token ? token.content : ''
        });
    }
}
