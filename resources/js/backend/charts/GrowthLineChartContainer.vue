<template>
  <div class="container">
    <line-chart
      v-if="loaded"
      :chartdata="chartdata"
      :options="options"/>
  </div>
</template>

<script>
import LineChart from './LineChart.vue'

export default {
  name: 'GrowthLineChartContainer',
  components: { LineChart },
  data: () => ({
    loaded: false,
    chartdata: {
      datasets: [
        {
          label: "Profit Growth",
          data: [],
          borderColor: "#143a87",
          lineTension: 0,
          borderWidth: 3,
          fill: false,
          precision: 2
        }
      ],
      labels: []
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
    },
  }),
  async mounted () {
    this.loaded = false
    try {
      axios.get('locations/growth', {
        params: {
          growth: true
        }
      })
      .then(growth => {
      this.chartdata.datasets[0].data = growth.data.datasets[0].data;
      this.chartdata.labels = growth.data.labels;
      this.loaded = true
      });
    } catch (e) {
      console.error(e)
    }
  }
}
</script>