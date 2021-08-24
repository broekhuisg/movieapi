import axios from '../axios-api'

const MediaService = {
    getFeaturedMovies() {
        return new Promise((resolve, reject) => {
            axios.get('/movies/featured')
                .then(response => {
                    resolve(response)
                })
                .catch(function(error) {
                    reject(error.response)
                });
        });
    },

    getTheaterMovies() {
        return new Promise((resolve, reject) => {
            axios.get('/movies/in_theater')
                .then(response => {
                    resolve(response)
                })
                .catch(error => {
                    reject(error)
                })
        })
    }
}

export default MediaService