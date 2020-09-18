<template>
  
    <table class="table table-dark table-borderless table-hover table-striped">
      <thead class="">
      <tr>
        <th>#</th>
        <th>Име</th>
        <th>Презиме</th>
        <th>Уплата</th>
      </tr>
      </thead>
      <tbody>
        <tr v-for="(top, index) in topTen">
        <td>{{ index+1 }}</td>
        <td>{{ top.first_name }}</td>
        <td>{{ top.last_name }}</td>
        <td>{{ top.pay_in }}</td>
      </tr>
      </tbody>
    </table>
  
</template>

<script>

export default {
  data: () => ({
    topTen: [],
  }),
  async mounted () {
    try {
      axios.get('api/top-ten', {
        params: {
          pay_in: true
        }
      })
      .then(topTenList => {
      this.topTen = topTenList.data;
      });
    } catch (e) {
      console.error(e)
    }
  }
}
</script>