<template>
  <div class="container-fluid">
    <form @submit.prevent="submitForm">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">add</i>
              </div>
              <h4 class="card-title">
                {{ $t('global.create') }}
                <strong>{{ $t('cruds.pouting.title_singular') }}</strong>
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
                      $t('cruds.pouting.fields.user')
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
                      'has-items': entry.jumlah,
                      'is-focused': activeField == 'jumlah'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.pouting.fields.jumlah')
                    }}</label>
                    <input
                      class="form-control"
                      type="number"
                      step="0.01"
                      :value="entry.jumlah"
                      @input="updateJumlah"
                      @focus="focusField('jumlah')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.jatuh_tempo,
                      'is-focused': activeField == 'jatuh_tempo'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.pouting.fields.jatuh_tempo')
                    }}</label>
                    <datetime-picker
                      class="form-control"
                      type="text"
                      picker="date"
                      :value="entry.jatuh_tempo"
                      @input="updateJatuhTempo"
                      @focus="focusField('jatuh_tempo')"
                      @blur="clearFocus"
                    >
                    </datetime-picker>
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.nama_debitur,
                      'is-focused': activeField == 'nama_debitur'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.pouting.fields.nama_debitur')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.nama_debitur"
                      @input="updateNamaDebitur"
                      @focus="focusField('nama_debitur')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.nomor_telepon,
                      'is-focused': activeField == 'nomor_telepon'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.pouting.fields.nomor_telepon')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.nomor_telepon"
                      @input="updateNomorTelepon"
                      @focus="focusField('nomor_telepon')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.alamat_debitur,
                      'is-focused': activeField == 'alamat_debitur'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.pouting.fields.alamat_debitur')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.alamat_debitur"
                      @input="updateAlamatDebitur"
                      @focus="focusField('alamat_debitur')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.status_piutang,
                      'is-focused': activeField == 'status_piutang'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.pouting.fields.status_piutang')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.status_piutang"
                      @input="updateStatusPiutang"
                      @focus="focusField('status_piutang')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div class="form-group">
                    <label>{{
                      $t('cruds.pouting.fields.catatan_piutang')
                    }}</label>
                    <ckeditor
                      :editor="editor"
                      :value="entry.catatan_piutang"
                      @input="updateCatatanPiutang"
                    >
                    </ckeditor>
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
    ...mapGetters('PoutingsSingle', ['entry', 'loading', 'lists'])
  },
  mounted() {
    this.fetchCreateData()
  },
  beforeDestroy() {
    this.resetState()
  },
  methods: {
    ...mapActions('PoutingsSingle', [
      'storeData',
      'resetState',
      'setUser',
      'setJumlah',
      'setJatuhTempo',
      'setNamaDebitur',
      'setNomorTelepon',
      'setAlamatDebitur',
      'setStatusPiutang',
      'setCatatanPiutang',
      'fetchCreateData'
    ]),
    updateUser(value) {
      this.setUser(value)
    },
    updateJumlah(e) {
      this.setJumlah(e.target.value)
    },
    updateJatuhTempo(e) {
      this.setJatuhTempo(e.target.value)
    },
    updateNamaDebitur(e) {
      this.setNamaDebitur(e.target.value)
    },
    updateNomorTelepon(e) {
      this.setNomorTelepon(e.target.value)
    },
    updateAlamatDebitur(e) {
      this.setAlamatDebitur(e.target.value)
    },
    updateStatusPiutang(e) {
      this.setStatusPiutang(e.target.value)
    },
    updateCatatanPiutang(value) {
      this.setCatatanPiutang(value)
    },
    submitForm() {
      this.storeData()
        .then(() => {
          this.$router.push({ name: 'poutings.index' })
          this.$eventHub.$emit('create-success')
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
