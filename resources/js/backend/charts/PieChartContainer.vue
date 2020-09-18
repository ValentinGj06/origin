<template>
  <div class="container">
    <pie-chart
      v-if="loaded"
      :chartdata="chartdata"
      :options="options"/>
  </div>
</template>

<script>
import PieChart from './PieChart.vue'

export default {
  name: 'PieChartContainer',
  components: { PieChart },
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
      axios.get('api/city')
      .then(citylist => {
      this.chartdata = citylist.data;
      this.loaded = true
      });
    } catch (e) {
      console.error(e)
    }
  }
}
</script>