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
  import ViewList from '~/components/views/ViewList'

  export default {
    layout: 'default',
    
    head () {
      return { 
        title: 'Счётчик просмотров',
      }
    },

    components: {
      ViewList,
    },

  }
</script>
