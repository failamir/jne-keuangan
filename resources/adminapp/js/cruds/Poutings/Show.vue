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
              <strong>{{ $t('cruds.pouting.title_singular') }}</strong>
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
                          {{ $t('cruds.pouting.fields.id') }}
                        </td>
                        <td>
                          {{ entry.id }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.pouting.fields.user') }}
                        </td>
                        <td>
                          <datatable-single :row="entry" field="user.name">
                          </datatable-single>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.pouting.fields.jumlah') }}
                        </td>
                        <td>
                          {{ entry.jumlah }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.pouting.fields.jatuh_tempo') }}
                        </td>
                        <td>
                          {{ entry.jatuh_tempo }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.pouting.fields.nama_debitur') }}
                        </td>
                        <td>
                          {{ entry.nama_debitur }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.pouting.fields.nomor_telepon') }}
                        </td>
                        <td>
                          {{ entry.nomor_telepon }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.pouting.fields.alamat_debitur') }}
                        </td>
                        <td>
                          {{ entry.alamat_debitur }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.pouting.fields.status_piutang') }}
                        </td>
                        <td>
                          {{ entry.status_piutang }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.pouting.fields.catatan_piutang') }}
                        </td>
                        <td>
                          <ckeditor
                            :editor="editor"
                            :value="entry.catatan_piutang"
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
import DatatableSingle from '@components/Datatables/DatatableSingle'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'

export default {
  components: {
    DatatableSingle,
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
    ...mapGetters('PoutingsSingle', ['entry'])
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
    ...mapActions('PoutingsSingle', ['fetchShowData', 'resetState'])
  }
}
</script>
