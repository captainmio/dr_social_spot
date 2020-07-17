import axios from 'axios'
// import * as types from '../mutation-types'
import ApiService from '~/common/api.service'

// state
export const state = {

}

// getters
export const getters = {
    // friends: state => state.friends
}

// mutations
export const mutations = {
    // [types.FRIEND_LIST] (state, response_value) {
    //     state.friends = response_value
    // }
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

    }

    // async createPost (context, payload) {
    //     console.log(payload);
    //     let baseUrl = ApiService.getBaseUrl();
    //     axios
    //     .post(baseUrl + 'post', payload)
    //     .then(response => {
    //         // context.commit('FRIEND_LIST', response.data);
    //         console.log(response);
    //     })
    // }
}