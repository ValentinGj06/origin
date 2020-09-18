<template>
  <div class="container">
    <bar-chart
      v-if="loaded"
      :chartdata="chartdata"
      :options="options"/>
  </div>
</template>

<script>
import BarChart from './BarChart.vue'

export default {
  name: 'BarChartContainer',
  components: { BarChart },
  data: () => ({
    loaded: false,
    chartdata: {},
    options: {
      responsive: true,
      maintainAspectRatio: false
    },
  }),
  async mounted () {
    this.loaded = false
    try {
      axios.get('api/age')
      .then(agelist => {
      this.chartdata = agelist.data;
      this.loaded = true
      });
    } catch (e) {
      console.error(e)
    }
  }
}
</script>