<style type="text/css">

.datefilter {
    position: relative;
    z-index: 2;
    padding: 0 0 0 5px;
    text-align: left !important;
    border-radius: 0 10px 10px 0 !important;
    border: 0;
    background: #fff;
    font-size: 14px;
    min-height: 44px;
    width: 80%;
    box-shadow: 0 4px 16px 0 rgba(22, 42, 90, 0.12);
    transition: box-shadow 0.3s ease;
}
.datefilter::placeholder {
	    color: #99A3BA;
}
.datefilter-prepend {
	border-radius: 10px 0 0 10px !important;
}

</style>
<template>
        <div class="input-group input-daterange">
            <!-- <div class="input-group-prepend"> -->
              <span class="datefilter-prepend input-group-text"><i class="fas fa-calendar-alt"></i></span>
            <!-- </div> -->
            <input autocomplete="off" id="datefilter" class="datefilter" type="text" placeholder="Registration Date" name="datefilter" ref="datefilter" />
        </div>
</template>

<script>

  export default {
    data() {
        return {
        inputs: [

        ],
        datefilter: '',
        isDisabled: true,
        isReadOnly: false,
        variant: 'primary'
    }
},

     methods: {
      add() {
        this.inputs.push({ text: this.$refs.datefilter.placeholder, value: this.$refs.datefilter.value});
        // Close the menu and (by passing true) return focus to the toggle button
        // this.$refs.dropdown.hide(true)
        this.isDisabled = false;
        this.isReadOnly = true;
        this.variant = 'success';

      },
      remove() {
        this.inputs.splice({ text: this.$refs.datefilter.placeholder, value: this.$refs.datefilter.value});
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
