import axios from 'axios'
import * as types from '../mutation-types'
import ApiService from '~/common/api.service'

// state
export const state = {
    friends: {

    }
}

// getters
export const getters = {
    friends: state => state.friends
}

// mutations
export const mutations = {
    [types.FRIEND_LIST] (state, response_value) {
        state.friends = response_value
    }
}

// actions
export const actions = {
    async fetchFriends (context, payload) {
        let baseUrl = ApiService.getBaseUrl();
        axios
        .get(baseUrl + 'get-users')
        .then(response => {
            context.commit('FRIEND_LIST', response.data);
        })
    }
}