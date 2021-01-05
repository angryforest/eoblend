<template>
  <article class="container-fluid">

    <div class="row mbot3">
      <div class="col-md-12">
        <h1>
          {{ $t('handbook_tagline') }}
        </h1>
      </div>
    </div>
    
    <oil-list />
    <hreflang />
  </article>
</template>

<script>
  import Hreflang from '~/components/global/Hreflang'
  import OilList from '~/components/oils/OilList'

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
      OilList,
      Hreflang,
    },

  }
</script>
