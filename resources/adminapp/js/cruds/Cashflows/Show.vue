<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">remove_red_eye</i>
            </div>
            <h4 class="card-title">
              {{ $t('global.view') }}
              <strong>{{ $t('cruds.cashflow.title_singular') }}</strong>
            </h4>
          </div>
          <div class="card-body">
            <back-button></back-button>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <div class="table">
                    <tbody>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.cashflow.fields.id') }}
                        </td>
                        <td>
                          {{ entry.id }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.cashflow.fields.kategori_cashflow') }}
                        </td>
                        <td>
                          <datatable-enum
                            :row="entry"
                            field="kategori_cashflow"
                          >
                          </datatable-enum>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.cashflow.fields.deskripsi') }}
                        </td>
                        <td>
                          <ckeditor
                            :editor="editor"
                            :value="entry.deskripsi"
                            disabled
                          >
                          </ckeditor>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.cashflow.fields.jumlah') }}
                        </td>
                        <td>
                          {{ entry.jumlah }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.cashflow.fields.tanggal') }}
                        </td>
                        <td>
                          {{ entry.tanggal }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.cashflow.fields.sumber') }}
                        </td>
                        <td>
                          <datatable-enum :row="entry" field="sumber">
                          </datatable-enum>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.cashflow.fields.status') }}
                        </td>
                        <td>
                          <datatable-enum :row="entry" field="status">
                          </datatable-enum>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.cashflow.fields.catatan') }}
                        </td>
                        <td>
                          <ckeditor
                            :editor="editor"
                            :value="entry.catatan"
                            disabled
                          >
                          </ckeditor>
                        </td>
                      </tr>
                    </tbody>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import DatatableEnum from '@components/Datatables/DatatableEnum'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'

export default {
  components: {
    DatatableEnum,
    ClassicEditor
  },
  data() {
    return {
      editor: ClassicEditor
    }
  },
  beforeDestroy() {
    this.resetState()
  },
  computed: {
    ...mapGetters('CashflowsSingle', ['entry'])
  },
  watch: {
    '$route.params.id': {
      immediate: true,
      handler() {
        this.resetState()
        this.fetchShowData(this.$route.params.id)
      }
    }
  },
  methods: {
    ...mapActions('CashflowsSingle', ['fetchShowData', 'resetState'])
  }
}
</script>
