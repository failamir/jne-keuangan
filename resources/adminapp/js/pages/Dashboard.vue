<template>
  <div class="container-fluid">
    <div class="row">
      <template v-for="(chart, key) in charts">
        <div :class="chart.column_class" :key="key">
          <stats-card
            v-if="chart.type === 'Stats'"
            :chart-data="chart"
          ></stats-card>
          <latest-card
            v-else-if="chart.type === 'Latest'"
            :chart-data="chart"
          ></latest-card>
          <div v-else class="card">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">{{ chart.icon }}</i>
              </div>
              <h4 class="card-title">
                {{ chart.title }}
              </h4>
            </div>
            <div class="card-body">
              <component
                v-bind:is="`${chart.type}Chart`"
                :chart-data="chart"
                :options="chart.options"
              ></component>
            </div>
          </div>
        </div>
      </template>
    </div>
  </div>
</template>

<script>
import BarChart from '@components/Charts/Bar'
import LineChart from '@components/Charts/Line'
import PieChart from '@components/Charts/Pie'
import StatsCard from '@components/Charts/Stats'
import LatestCard from '@components/Charts/Latest'

export default {
  components: {
    BarChart,
    LineChart,
    PieChart,
    StatsCard,
    LatestCard
  },
  data() {
    return {
      datacollection: null,
      charts: null
    }
  },
  created() {
    axios.get('dashboard').then(response => {
      this.charts = response.data
    })
  }
}
</script>
