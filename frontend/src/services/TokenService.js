const TOKEN_KEY = 'accessToken'
const USER_ID_KEY = 'userId'

const TokenService = {
    getToken() {
        return localStorage.getItem('accessToken')
    },

    setToken(token) {
        return localStorage.setItem(TOKEN_KEY, token)
    },

    removeToken() {
        return localStorage.removeItem(TOKEN_KEY)
    },

    hasToken() {
        return !!this.getToken()
    },

    getUserId() {
        return localStorage.getItem(USER_ID_KEY)
    },

    setUserId(user_id) {
        return localStorage.setItem(USER_ID_KEY, user_id)
    },

    removeUserId() {
        return localStorage.removeItem(USER_ID_KEY)
    },

    hasUserId() {
        return !!this.getUserId()
    }
}

export default TokenService