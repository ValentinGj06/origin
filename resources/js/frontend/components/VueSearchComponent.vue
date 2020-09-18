<style type="text/css">
	
.search_input {
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
.search_input::placeholder {
	    color: #99A3BA;
}
.search_input-prepend {
	border-radius: 10px 0 0 10px !important;
}

</style>
<template>
    <div class="row">
        <div class="span5 col-md-3">
            <input id="search_input" class="search_input" type="text" placeholder="Search by Name or Card Number" name="search_input" ref="search_input" v-model="search_input" />                   
			<button class="btn btn-primary m-1">
				<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M12.8645 11.3208H12.0515L11.7633 11.0429C12.7719 9.86964 13.3791 8.34648 13.3791 6.68954C13.3791 2.99485 10.3842 0 6.68954 0C2.99485 0 0 2.99485 0 6.68954C0 10.3842 2.99485 13.3791 6.68954 13.3791C8.34648 13.3791 9.86964 12.7719 11.0429 11.7633L11.3208 12.0515V12.8645L16.4666 18L18 16.4666L12.8645 11.3208ZM6.68954 11.3208C4.12693 11.3208 2.05832 9.25214 2.05832 6.68954C2.05832 4.12693 4.12693 2.05832 6.68954 2.05832C9.25214 2.05832 11.3208 4.12693 11.3208 6.68954C11.3208 9.25214 9.25214 11.3208 6.68954 11.3208Z" fill="#071923" fill-opacity="0.5">
					</path>
				</svg>
			</button>
        </div>
    </div>
</template>

<script>

  export default {
    data() {
        return {
        search_input: '',
        inputs: [
            
        ],
        clients: {
            total: 0,
            per_page: 2,
            from: 1,
            to: 0,
            current_page: 1
        },
        offset: 4,
        isDisabled: true,
        isReadOnly: false,
        variant: 'primary'
    	}
	},
}
</script>