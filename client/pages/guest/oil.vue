<template>
  <article class="container-fluid">

<!--     <div class="row mbot3">
      <div class="col-md-12">
        <h1>{{ $t('handbook_tagline') }}</h1>
      </div>
    </div> -->
    
    <oil-item />
  </article>
</template>

<script>
  import hreflang from '~/mixins/hreflang'
  import OilItem from '~/components/oils/OilItem'

  export default {
    layout: 'default',

    mixins: [
      hreflang,
    ],

    head () {
      return { 
        title: this.$t('handbook'),
        link: this.getHreflangs(),
        meta: [ 
          {
            hid: 'description', 
            name: 'description', 
            content: this.$t('handbook_description')
          }
        ],
      }
    },

    components: {
      OilItem
    },

  }
</script>
