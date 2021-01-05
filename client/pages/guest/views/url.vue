<template>
  <article class="container-fluid">

    <div class="row mbot3">
      <div class="col-md-12">
        <h1>
          {{ this.$route.query.url }}
        </h1>
      </div>
    </div>
    
    <view-list-by-url />
  </article>
</template>

<script>
  import ViewListByUrl from '~/components/views/ViewListByUrl'

  export default {
    layout: 'default',
    

    head () {
      return { 
        title: 'Счётчик просмотров',
      }
    },

    components: {
      ViewListByUrl,
    },

  }
</script>
