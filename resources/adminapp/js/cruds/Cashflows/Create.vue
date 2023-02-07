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
                <strong>{{ $t('cruds.cashflow.title_singular') }}</strong>
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
                      'has-items': entry.kategori_cashflow,
                      'is-focused': activeField == 'kategori_cashflow'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.cashflow.fields.kategori_cashflow')
                    }}</label>
                    <v-select
                      name="kategori_cashflow"
                      :key="'kategori_cashflow-field'"
                      :value="entry.kategori_cashflow"
                      :options="lists.kategori_cashflow"
                      :reduce="entry => entry.value"
                      @input="updateKategoriCashflow"
                      @search.focus="focusField('kategori_cashflow')"
                      @search.blur="clearFocus"
                    />
                  </div>
                  <div class="form-group">
                    <label>{{ $t('cruds.cashflow.fields.deskripsi') }}</label>
                    <ckeditor
                      :editor="editor"
                      :value="entry.deskripsi"
                      @input="updateDeskripsi"
                    >
                    </ckeditor>
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.jumlah,
                      'is-focused': activeField == 'jumlah'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.cashflow.fields.jumlah')
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
                      'has-items': entry.tanggal,
                      'is-focused': activeField == 'tanggal'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.cashflow.fields.tanggal')
                    }}</label>
                    <datetime-picker
                      class="form-control"
                      type="text"
                      picker="date"
                      :value="entry.tanggal"
                      @input="updateTanggal"
                      @focus="focusField('tanggal')"
                      @blur="clearFocus"
                    >
                    </datetime-picker>
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.sumber,
                      'is-focused': activeField == 'sumber'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.cashflow.fields.sumber')
                    }}</label>
                    <v-select
                      name="sumber"
                      :key="'sumber-field'"
                      :value="entry.sumber"
                      :options="lists.sumber"
                      :reduce="entry => entry.value"
                      @input="updateSumber"
                      @search.focus="focusField('sumber')"
                      @search.blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.status,
                      'is-focused': activeField == 'status'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.cashflow.fields.status')
                    }}</label>
                    <v-select
                      name="status"
                      :key="'status-field'"
                      :value="entry.status"
                      :options="lists.status"
                      :reduce="entry => entry.value"
                      @input="updateStatus"
                      @search.focus="focusField('status')"
                      @search.blur="clearFocus"
                    />
                  </div>
                  <div class="form-group">
                    <label>{{ $t('cruds.cashflow.fields.catatan') }}</label>
                    <ckeditor
                      :editor="editor"
                      :value="entry.catatan"
                      @input="updateCatatan"
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
    ...mapGetters('CashflowsSingle', ['entry', 'loading', 'lists'])
  },
  mounted() {
    this.fetchCreateData()
  },
  beforeDestroy() {
    this.resetState()
  },
  methods: {
    ...mapActions('CashflowsSingle', [
      'storeData',
      'resetState',
      'setKategoriCashflow',
      'setDeskripsi',
      'setJumlah',
      'setTanggal',
      'setSumber',
      'setStatus',
      'setCatatan',
      'fetchCreateData'
    ]),
    updateKategoriCashflow(value) {
      this.setKategoriCashflow(value)
    },
    updateDeskripsi(value) {
      this.setDeskripsi(value)
    },
    updateJumlah(e) {
      this.setJumlah(e.target.value)
    },
    updateTanggal(e) {
      this.setTanggal(e.target.value)
    },
    updateSumber(value) {
      this.setSumber(value)
    },
    updateStatus(value) {
      this.setStatus(value)
    },
    updateCatatan(value) {
      this.setCatatan(value)
    },
    submitForm() {
      this.storeData()
        .then(() => {
          this.$router.push({ name: 'cashflows.index' })
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
