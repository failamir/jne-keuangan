function initialState() {
  return {
    entry: {
      id: null,
      user_id: null,
      jumlah_setoran: '0',
      tanggal_setoran: '',
      metode_setoran: 'CASH',
      status_setoran: 'Belum Dibayar',
      catatan_setoran: '',
      piutang_id: null,
      created_at: '',
      updated_at: '',
      deleted_at: ''
    },
    lists: {
      user: [],
      metode_setoran: [],
      status_setoran: [],
      piutang: []
    },
    loading: false
  }
}

const route = 'setorans'

const getters = {
  entry: state => state.entry,
  lists: state => state.lists,
  loading: state => state.loading
}

const actions = {
  storeData({ commit, state, dispatch }) {
    commit('setLoading', true)
    dispatch('Alert/resetState', null, { root: true })

    return new Promise((resolve, reject) => {
      let params = objectToFormData(state.entry, {
        indices: true,
        booleansAsIntegers: true
      })
      axios
        .post(route, params)
        .then(response => {
          resolve(response)
        })
        .catch(error => {
          let message = error.response.data.message || error.message
          let errors = error.response.data.errors

          dispatch(
            'Alert/setAlert',
            { message: message, errors: errors, color: 'danger' },
            { root: true }
          )

          reject(error)
        })
        .finally(() => {
          commit('setLoading', false)
        })
    })
  },
  updateData({ commit, state, dispatch }) {
    commit('setLoading', true)
    dispatch('Alert/resetState', null, { root: true })

    return new Promise((resolve, reject) => {
      let params = objectToFormData(state.entry, {
        indices: true,
        booleansAsIntegers: true
      })
      params.set('_method', 'PUT')
      axios
        .post(`${route}/${state.entry.id}`, params)
        .then(response => {
          resolve(response)
        })
        .catch(error => {
          let message = error.response.data.message || error.message
          let errors = error.response.data.errors

          dispatch(
            'Alert/setAlert',
            { message: message, errors: errors, color: 'danger' },
            { root: true }
          )

          reject(error)
        })
        .finally(() => {
          commit('setLoading', false)
        })
    })
  },
  setUser({ commit }, value) {
    commit('setUser', value)
  },
  setJumlahSetoran({ commit }, value) {
    commit('setJumlahSetoran', value)
  },
  setTanggalSetoran({ commit }, value) {
    commit('setTanggalSetoran', value)
  },
  setMetodeSetoran({ commit }, value) {
    commit('setMetodeSetoran', value)
  },
  setStatusSetoran({ commit }, value) {
    commit('setStatusSetoran', value)
  },
  setCatatanSetoran({ commit }, value) {
    commit('setCatatanSetoran', value)
  },
  setPiutang({ commit }, value) {
    commit('setPiutang', value)
  },
  setCreatedAt({ commit }, value) {
    commit('setCreatedAt', value)
  },
  setUpdatedAt({ commit }, value) {
    commit('setUpdatedAt', value)
  },
  setDeletedAt({ commit }, value) {
    commit('setDeletedAt', value)
  },
  fetchCreateData({ commit }) {
    axios.get(`${route}/create`).then(response => {
      commit('setLists', response.data.meta)
    })
  },
  fetchEditData({ commit, dispatch }, id) {
    axios.get(`${route}/${id}/edit`).then(response => {
      commit('setEntry', response.data.data)
      commit('setLists', response.data.meta)
    })
  },
  fetchShowData({ commit, dispatch }, id) {
    axios.get(`${route}/${id}`).then(response => {
      commit('setEntry', response.data.data)
    })
  },
  resetState({ commit }) {
    commit('resetState')
  }
}

const mutations = {
  setEntry(state, entry) {
    state.entry = entry
  },
  setUser(state, value) {
    state.entry.user_id = value
  },
  setJumlahSetoran(state, value) {
    state.entry.jumlah_setoran = value
  },
  setTanggalSetoran(state, value) {
    state.entry.tanggal_setoran = value
  },
  setMetodeSetoran(state, value) {
    state.entry.metode_setoran = value
  },
  setStatusSetoran(state, value) {
    state.entry.status_setoran = value
  },
  setCatatanSetoran(state, value) {
    state.entry.catatan_setoran = value
  },
  setPiutang(state, value) {
    state.entry.piutang_id = value
  },
  setCreatedAt(state, value) {
    state.entry.created_at = value
  },
  setUpdatedAt(state, value) {
    state.entry.updated_at = value
  },
  setDeletedAt(state, value) {
    state.entry.deleted_at = value
  },
  setLists(state, lists) {
    state.lists = lists
  },
  setLoading(state, loading) {
    state.loading = loading
  },
  resetState(state) {
    state = Object.assign(state, initialState())
  }
}

export default {
  namespaced: true,
  state: initialState,
  getters,
  actions,
  mutations
}
