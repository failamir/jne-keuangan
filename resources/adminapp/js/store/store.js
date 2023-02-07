import Vue from 'vue'
import Vuex from 'vuex'

import Alert from './modules/alert'
import I18NStore from './modules/i18n'

import PermissionsIndex from './cruds/Permissions'
import PermissionsSingle from './cruds/Permissions/single'
import RolesIndex from './cruds/Roles'
import RolesSingle from './cruds/Roles/single'
import UsersIndex from './cruds/Users'
import UsersSingle from './cruds/Users/single'
import PoutingsIndex from './cruds/Poutings'
import PoutingsSingle from './cruds/Poutings/single'
import SetoransIndex from './cruds/Setorans'
import SetoransSingle from './cruds/Setorans/single'
import CashflowsIndex from './cruds/Cashflows'
import CashflowsSingle from './cruds/Cashflows/single'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  modules: {
    Alert,
    I18NStore,
    PermissionsIndex,
    PermissionsSingle,
    RolesIndex,
    RolesSingle,
    UsersIndex,
    UsersSingle,
    PoutingsIndex,
    PoutingsSingle,
    SetoransIndex,
    SetoransSingle,
    CashflowsIndex,
    CashflowsSingle
  },
  strict: debug
})
