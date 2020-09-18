<template>
  <div class="container">
    <doughnut-chart
      v-if="loaded"
      :chartdata="chartdata"
      :options="options"/>
  </div>
</template>

<script>
import DoughnutChart from './DoughnutChart.vue'

export default {
  name: 'DoughnutChartContainer',
  components: { DoughnutChart },
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
      axios.get('api/gender')
      .then(genderlist => {
      this.chartdata = genderlist.data;
      this.loaded = true
      });
    } catch (e) {
      console.error(e)
    }
  }
}
</script>