import axios from 'axios'
// import * as types from '../mutation-types'
import ApiService from '~/common/api.service'

// state
export const state = {
    posts: []
}

// getters
export const getters = {
    posts: state => state.posts
}

// mutations
export const mutations = {
    ['POSTS_LIST'] (state, response_value) {
        state.posts = response_value
    }
}

// actions
export const actions = {

    createPost (context, payload) {
        return new Promise((resolve, reject) => {
            let baseUrl = ApiService.getBaseUrl();
            axios
            .post(baseUrl + 'post', payload)
            .then(response => {
                resolve(response)
            }).catch(err => {
                reject(err)
            })
        });

    },
    async pullAllPosts (context, payload) {
        let baseUrl = ApiService.getBaseUrl();
        axios
        .get(baseUrl + 'posts/'+ payload.id)
        .then(response => {
            context.commit('POSTS_LIST', response.data);
        })
    },
    likeAPost (context, payload) {
        return new Promise((resolve, reject) => {
            console.log(payload);
            let baseUrl = ApiService.getBaseUrl();
            axios
            .post(baseUrl + 'post/like/', payload)
            .then(response => {
                resolve(response)
            }).catch(err => {
                reject(err)
            })
        });

    },
}