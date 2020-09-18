<template>
  <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
    <div class="card-counter" :class="classes[i]">
      <i :class="icons[i]"></i>
      <span v-text="item.number" class="count-numbers"></span>
      <span v-text="item.name" class="count-name"></span>
    </div>
  </div>
</template>

<script>

export default {

  props: [
    'item',
    'i'
  ],

  data: () => ({
    icons: [
      'fa fa-money-bill-alt',
      'fa fa-file-invoice-dollar',
      'fa fa-money-check-alt',
      'fa fa-receipt'
      ],
    classes: [
      'success',
      'primary',
      'danger',
      'secondary',
    ]
  }),
}
</script>