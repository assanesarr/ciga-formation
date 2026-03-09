import axios from 'axios'
import * as types from '../mutation-types'

// state
export const state = {
    adminMenus: null,
    publicMenus: null
}

// getters
export const getters = {
    adminMenus: state => state.adminMenus,
    publicMenus: state => state.publicMenus,
}

// mutations
export const mutations = {

    [types.FETCH_ADMIN_MENUS] (state, { menus }) {
        state.adminMenus = menus
    },

    [types.FETCH_PUBLIC_MENUS] (state, { menus }) {
        state.publicMenus = menus
    }
}

// actions
export const actions = {

    async fetchMenus ({ commit }) {
        const { data } = await axios.get(`/${config.base}/menus-admin`);
        commit(types.FETCH_ADMIN_MENUS, { menus: data });
        await this.dispatch('menus/fetchPublicMenus');

    },
    async fetchPublicMenus({ commit }){
        const { data } = await axios.get(`/${config.base}/menus-public`);
        commit(types.FETCH_PUBLIC_MENUS, { menus: data })
    },

    async deleteMenus({ commit, state }, menu){
        const { data } = await axios.delete(`/${config.base}/menus-delete/${menu.id}`);
        commit(`FETCH_${menu.type}_MENUS`, {menus: data})
    },

    async updateMenus({ commit, state }, menu){
        const { data } = await axios.post(`/${config.base}/menus-update/${menu.id}`, menu);
        commit(`FETCH_${menu.type}_MENUS`, {menus: data})
    }
}
