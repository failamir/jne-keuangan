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
              <strong>{{ $t('cruds.setoran.title_singular') }}</strong>
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
                          {{ $t('cruds.setoran.fields.id') }}
                        </td>
                        <td>
                          {{ entry.id }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.setoran.fields.user') }}
                        </td>
                        <td>
                          <datatable-single :row="entry" field="user.name">
                          </datatable-single>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.setoran.fields.jumlah_setoran') }}
                        </td>
                        <td>
                          {{ entry.jumlah_setoran }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.setoran.fields.tanggal_setoran') }}
                        </td>
                        <td>
                          {{ entry.tanggal_setoran }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.setoran.fields.metode_setoran') }}
                        </td>
                        <td>
                          <datatable-enum :row="entry" field="metode_setoran">
                          </datatable-enum>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.setoran.fields.status_setoran') }}
                        </td>
                        <td>
                          <datatable-enum :row="entry" field="status_setoran">
                          </datatable-enum>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.setoran.fields.catatan_setoran') }}
                        </td>
                        <td>
                          <ckeditor
                            :editor="editor"
                            :value="entry.catatan_setoran"
                            disabled
                          >
                          </ckeditor>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.setoran.fields.piutang') }}
                        </td>
                        <td>
                          <datatable-single
                            :row="entry"
                            field="piutang.nama_debitur"
                          >
                          </datatable-single>
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
import DatatableSingle from '@components/Datatables/DatatableSingle'
import DatatableEnum from '@components/Datatables/DatatableEnum'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'

export default {
  components: {
    DatatableSingle,
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
    ...mapGetters('SetoransSingle', ['entry'])
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
    ...mapActions('SetoransSingle', ['fetchShowData', 'resetState'])
  }
}
</script>
