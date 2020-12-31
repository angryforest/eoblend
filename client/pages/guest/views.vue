<template>
  <article class="container-fluid">

    <div class="row mbot3">
      <div class="col-md-12">
        <h1>
          Счётчик просмотров
        </h1>
      </div>
    </div>
    
    <view-list />
    <hreflang />
  </article>
</template>

<script>
  import Hreflang from '~/components/global/Hreflang'
  import ViewList from '~/components/views/ViewList'

  export default {
    layout: 'default',
    

    head () {
      return { 
        title: 'Счётчик просмотров',
        // meta: [ 
        //   {
        //     hid: 'description', 
        //     name: 'description', 
        //     content: this.$t('handbook_description'),
        //   }
        // ],
      }
    },

    components: {
      ViewList,
      Hreflang,
    },

  }
</script>
