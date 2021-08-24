import axios from 'axios'
import TokenService from "./services/TokenService"

const instance = axios.create({
    baseURL: 'http://localhost/api',
    headers: {
        common: {
            'Content-Type': 'application/json'
        }
    }
});

instance.interceptors.request.use(function(config) {
    let accessToken = TokenService.getToken()

    if (accessToken) {
        config.headers['Authorization'] = `Bearer ${accessToken}`;
    }

    return config
}, function (error) {
    return Promise.reject(error)
});

export default instance;