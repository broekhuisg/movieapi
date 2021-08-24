import axios from '../axios-api'
import TokenService from './TokenService'

const ApiService = {
    login(data) {
        return new Promise((resolve, reject) => {
            axios.post('/authentication_token', data)
                .then(response => {
                    let accessToken = response.data.token || null

                    if (accessToken) {
                        TokenService.setToken(accessToken)
                        resolve(response)
                    } else {
                        reject(new Error("No Access Token returned"))
                    }
                })
                .catch(function(error) {
                    reject(error.response)
                });
        });
    },

    logout() {
        return new Promise((resolve, reject) => {
            if (TokenService.hasToken()) {
                TokenService.removeToken();
            }
            if (TokenService.hasUserId()) {
                TokenService.removeUserId()
            }
            resolve();
        })
    },

    getMe() {
        return new Promise((resolve, reject) => {
            axios.get('/users/get_me')
                .then(response => {
                    resolve(response)
                })
                .catch(function(error) {
                    reject(error.response)
                });
        });
    },
}

export default ApiService