<template>
  <div class="container-fluid">
    <form @submit.prevent="submitForm">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">edit</i>
              </div>
              <h4 class="card-title">
                {{ $t('global.edit') }}
                <strong>{{ $t('cruds.setoran.title_singular') }}</strong>
              </h4>
            </div>
            <div class="card-body">
              <back-button></back-button>
            </div>
            <div class="card-body">
              <bootstrap-alert />
              <div class="row">
                <div class="col-md-12">
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.user_id !== null,
                      'is-focused': activeField == 'user'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.setoran.fields.user')
                    }}</label>
                    <v-select
                      name="user"
                      label="name"
                      :key="'user-field'"
                      :value="entry.user_id"
                      :options="lists.user"
                      :reduce="entry => entry.id"
                      @input="updateUser"
                      @search.focus="focusField('user')"
                      @search.blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.jumlah_setoran,
                      'is-focused': activeField == 'jumlah_setoran'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.setoran.fields.jumlah_setoran')
                    }}</label>
                    <input
                      class="form-control"
                      type="number"
                      step="0.01"
                      :value="entry.jumlah_setoran"
                      @input="updateJumlahSetoran"
                      @focus="focusField('jumlah_setoran')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.tanggal_setoran,
                      'is-focused': activeField == 'tanggal_setoran'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.setoran.fields.tanggal_setoran')
                    }}</label>
                    <datetime-picker
                      class="form-control"
                      type="text"
                      picker="date"
                      :value="entry.tanggal_setoran"
                      @input="updateTanggalSetoran"
                      @focus="focusField('tanggal_setoran')"
                      @blur="clearFocus"
                    >
                    </datetime-picker>
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.metode_setoran,
                      'is-focused': activeField == 'metode_setoran'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.setoran.fields.metode_setoran')
                    }}</label>
                    <v-select
                      name="metode_setoran"
                      :key="'metode_setoran-field'"
                      :value="entry.metode_setoran"
                      :options="lists.metode_setoran"
                      :reduce="entry => entry.value"
                      @input="updateMetodeSetoran"
                      @search.focus="focusField('metode_setoran')"
                      @search.blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.status_setoran,
                      'is-focused': activeField == 'status_setoran'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.setoran.fields.status_setoran')
                    }}</label>
                    <v-select
                      name="status_setoran"
                      :key="'status_setoran-field'"
                      :value="entry.status_setoran"
                      :options="lists.status_setoran"
                      :reduce="entry => entry.value"
                      @input="updateStatusSetoran"
                      @search.focus="focusField('status_setoran')"
                      @search.blur="clearFocus"
                    />
                  </div>
                  <div class="form-group">
                    <label>{{
                      $t('cruds.setoran.fields.catatan_setoran')
                    }}</label>
                    <ckeditor
                      :editor="editor"
                      :value="entry.catatan_setoran"
                      @input="updateCatatanSetoran"
                    >
                    </ckeditor>
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.piutang_id !== null,
                      'is-focused': activeField == 'piutang'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.setoran.fields.piutang')
                    }}</label>
                    <v-select
                      name="piutang"
                      label="nama_debitur"
                      :key="'piutang-field'"
                      :value="entry.piutang_id"
                      :options="lists.piutang"
                      :reduce="entry => entry.id"
                      @input="updatePiutang"
                      @search.focus="focusField('piutang')"
                      @search.blur="clearFocus"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <vue-button-spinner
                class="btn-primary"
                :status="status"
                :isLoading="loading"
                :disabled="loading"
              >
                {{ $t('global.save') }}
              </vue-button-spinner>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'

export default {
  components: {
    ClassicEditor
  },
  data() {
    return {
      status: '',
      activeField: '',
      editor: ClassicEditor
    }
  },
  computed: {
    ...mapGetters('SetoransSingle', ['entry', 'loading', 'lists'])
  },
  beforeDestroy() {
    this.resetState()
  },
  watch: {
    '$route.params.id': {
      immediate: true,
      handler() {
        this.resetState()
        this.fetchEditData(this.$route.params.id)
      }
    }
  },
  methods: {
    ...mapActions('SetoransSingle', [
      'fetchEditData',
      'updateData',
      'resetState',
      'setUser',
      'setJumlahSetoran',
      'setTanggalSetoran',
      'setMetodeSetoran',
      'setStatusSetoran',
      'setCatatanSetoran',
      'setPiutang'
    ]),
    updateUser(value) {
      this.setUser(value)
    },
    updateJumlahSetoran(e) {
      this.setJumlahSetoran(e.target.value)
    },
    updateTanggalSetoran(e) {
      this.setTanggalSetoran(e.target.value)
    },
    updateMetodeSetoran(value) {
      this.setMetodeSetoran(value)
    },
    updateStatusSetoran(value) {
      this.setStatusSetoran(value)
    },
    updateCatatanSetoran(value) {
      this.setCatatanSetoran(value)
    },
    updatePiutang(value) {
      this.setPiutang(value)
    },
    submitForm() {
      this.updateData()
        .then(() => {
          this.$router.push({ name: 'setorans.index' })
          this.$eventHub.$emit('update-success')
        })
        .catch(error => {
          this.status = 'failed'
          _.delay(() => {
            this.status = ''
          }, 3000)
        })
    },
    focusField(name) {
      this.activeField = name
    },
    clearFocus() {
      this.activeField = ''
    }
  }
}
</script>
