<template>
  <div class="row">   
    <counter-card-item
      v-for="(item, key, index) in total"
      :item="item"
      :i="index"
      :key="key"
    ></counter-card-item>
  </div>
</template>

<script>

import CounterCardItem from './CounterCardItemComponent.vue'

export default {

  props: [],

  components: { CounterCardItem },

  data: () => ({
    total: null,
  }),

  mounted () {
    try {
      axios.get('locations/growth', {
        params: {
          todayTotal: true
        }
      })
      .then(total => {
      this.total = total.data;
      });
    } catch (e) {
      console.error(e)
    }
  }
}
</script>