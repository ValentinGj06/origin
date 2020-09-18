<template>
    <div class="input-group">
        <select multiple data-placeholder="Add location" placeholder="Address" ref="from_city" v-model="from_city" >
            <option v-for="address in city">{{ address.city }}</option>
        </select>
    </div>
</template>

<script>

  export default {
    data() {
        return {
	        inputs: [
	            
	        ],
	        from_city: [],
	        isDisabled: true,
	        isReadOnly: false,
	        variant: 'primary'
	    }
	},

	props: {
    	city: {
    		type: Array
    	}
  	},

     methods: {
      add() {
        this.inputs.push({ text: this.$refs.from_city.placeholder, value: [this.$refs.from_city.value]});
        // Close the menu and (by passing true) return focus to the toggle button
        // this.$refs.dropdown.hide(true)
        this.isDisabled = false;
        this.isReadOnly = true;
        this.variant = 'success';

      },
      remove() {
        this.inputs.splice({ text: this.$refs.from_city.placeholder, value: this.$refs.from_city.value});
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
          // console.log(res.data);
          // console.log(self.$refs.response);
            $('#response').html(res.data);
        });
      }
  }
}
</script>