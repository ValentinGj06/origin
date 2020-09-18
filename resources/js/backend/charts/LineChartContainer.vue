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
  name: 'LineChartContainer',
  components: { LineChart },
  data: () => ({
    loaded: false,
    chartdata: {
      labels: ['Begining', 'Now'],
      datasets: [
        {
          label: 'Loss',
          backgroundColor: '#f87979',
          data: [0, 4000000]
        },
        // { 
        //   label: 'Basketball Gamblers',
        //   backgroundColor: '#123979',
        //   data: [70, 60, 85, 90, 80, 80, 50]
        // },
        {
          label: 'Profit',
          backgroundColor: '#123979',
          data: [0, 8000000]
        },
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false
    },
  }),
  async mounted () {
    this.loaded = false
    try {
      axios.get('api/estimate')
      .then(estimatelist => {
      this.chartdata = estimatelist.data;
      this.loaded = true
      });
    } catch (e) {
      console.error(e)
    }
  }
}
</script>