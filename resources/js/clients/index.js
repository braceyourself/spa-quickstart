import axios from 'axios';
import store from '../store';
import Logger from '../Logger';

const getClient = (baseUrl = null) => {

    let l = new Logger('axios');
    const options = {
        baseURL: baseUrl
    };

    if (store.getters['authenticated']) {
        options.headers = {
            Authorization: `Bearer ${store.getters.get('apiAccessToken')}`
        }
    }

    const client = axios.create(options);

    client.interceptors.request.use(
        requestConfig => requestConfig,
        requestError => {
            l.log(requestError);
            return Promise.reject(requestError);
        }
    );

    client.interceptors.response.use(
        response => response,
        error => {
            if (error.response.status <= 500) {
                l.log(error);
            }

            return Promise.reject(error);
        }
    );

    return client;
};

class ApiClient {
    constructor(baseUrl = null) {
        this.client = getClient(baseUrl);
    }

    get(url, conf = {}) {
        return this.client.get(url, conf)
            .then(response => Promise.resolve(response))
            .catch(error => Promise.reject(error));
    }

    delete(url, conf = {}) {
        return this.client.delete(url, conf)
            .then(response => Promise.resolve(response))
            .catch(error => Promise.reject(error));
    }

    head(url, conf = {}) {
        return this.client.head(url, conf)
            .then(response => Promise.resolve(response))
            .catch(error => Promise.reject(error));
    }

    options(url, conf = {}) {
        return this.client.options(url, conf)
            .then(response => Promise.resolve(response))
            .catch(error => Promise.reject(error));
    }

    post(url, data = {}, conf = {}) {
        return this.client.post(url, data, conf)
            .then(response => Promise.resolve(response))
            .catch(error => Promise.reject(error));
    }

    put(url, data = {}, conf = {}) {
        return this.client.put(url, data, conf)
            .then(response => Promise.resolve(response))
            .catch(error => Promise.reject(error));
    }

    patch(url, data = {}, conf = {}) {
        return this.client.patch(url, data, conf)
            .then(response => Promise.resolve(response))
            .catch(error => Promise.reject(error));
    }
}

export {
    ApiClient
}

export default new ApiClient('/api');