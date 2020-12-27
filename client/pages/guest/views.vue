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
  </article>
</template>

<script>
  // import hreflang from '~/mixins/hreflang'
  import ViewList from '~/components/views/ViewList'

  export default {
    layout: 'default',
    
    // mixins: [
    //   hreflang,
    // ],

    head () {
      return { 
        title: 'Счётчик просмотров',
        // link: this.getHreflangs(),
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
    },

  }
</script>
