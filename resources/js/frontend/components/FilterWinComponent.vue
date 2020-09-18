<template>
    <b-dropdown variant="primary" id="dropdown-filter" text="Win" ref="dropdown" class="m-1">
        <input type="text" class="js-range-slider" placeholder="Win" id="win" name="win" ref="win" v-model="win"
          data-type="double"
          data-min="0"
          :data-max="max_win"
          data-from="0"
          data-to="500000"
          data-grid="true"
          />
        <br>
        <b-button variant="danger" size="md" id="clearWinFilter">Clear Filter</b-button>
        <b-button variant="primary" size="md" id="applyWinFilter">Apply Filter</b-button>
    </b-dropdown>
</template>

<script>

  export default {
    data() {
        return {
        inputs: [

        ],
        win: '',
        isDisabled: true,
        isReadOnly: false,
        variant: 'primary'
        }
    },
    props: [
      'max_win',
    ],
     methods: {
      add() {
        this.inputs.push({ text: this.$refs.win.placeholder, value: this.$refs.win.value});
        // Close the menu and (by passing true) return focus to the toggle button
        // this.$refs.dropdown.hide(true)
        this.isDisabled = false;
        this.isReadOnly = true;
        this.variant = 'success';

      },
      remove() {
        this.inputs.splice({ text: this.$refs.win.placeholder, value: this.$refs.win.value});
        // Close the menu and (by passing true) return focus to the toggle button
        // this.$refs.dropdown.hide(true)
        this.isDisabled = true;
        this.isReadOnly = false;
        this.variant = 'primary';

      },
      filter() {
        let self = this;
        axios.post("../clients", {pay_in: this.$refs.pay_in.value}).then(function(res){
          self.clients = res.data;
          console.log(res.data);
          // console.log(self.$refs.response);
            $('#response').html(res.data);
        });
      }
  }
}
</script>
