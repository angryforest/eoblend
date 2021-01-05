<template>
  <article class="container-fluid">
    
    <oil-item />
    <hreflang />
  </article>
</template>

<script>
  import Hreflang from '~/components/global/Hreflang'
  import OilItem from '~/components/oils/OilItem'

  export default {
    layout: 'default',
    track: true,

    head () {
      return { 
        title: this.$t('handbook'),
        meta: [ 
          {
            hid: 'description', 
            name: 'description', 
            content: this.$t('handbook_description'),
          }
        ],
      }
    },

    components: {
      OilItem,
      Hreflang,
    },

  }
</script>
