<template>
  <article class="container-fluid">

    <div class="row mbot3">
      <div class="col-md-12">
        <h1>
          {{ $t('calculator_tagline') }}
        </h1>
      </div>
    </div>

    <div class="row">

      <div class="col-sm-6 col-md-4 mbot3">
        {{ $t('select_oils') }}
      </div>

      <div class="col-sm-6 col-md-4 mbot3">
        {{ $t('volatility_reminder') }}
      </div>

      <div class="col-sm-6 col-md-4 mbot3">
        {{ $t('property_notice') }}
      </div>

    </div>
    
    <compatibility-table />
    <hreflang />
  </article>
</template>

<script>
  import Hreflang from '~/components/global/Hreflang'
  import CompatibilityTable from '~/components/oils/CompatibilityTable'

  export default {
    layout: 'default',
    track: true,

    head () {
      return { 
        title: this.$t('calculator'),
        meta: [ 
          {
            hid: 'description', 
            name: 'description', 
            content: this.$t('calculator_description'),
          }
        ],
      }
    },

    components: {
      CompatibilityTable,
      Hreflang,
    },

  }
</script>
