<template>
  <article v-if="!loading" class="container-fluid">

    <div class="row mbot3">
      <div class="col-md-10">

        <table class="table table-sm table-hover">
          <thead>
            <tr>
              <th scope="col">IP</th>
              <th scope="col" class="text-center">Язык</th>
              <th scope="col" class="text-center">Мобильный</th>
              <th scope="col" class="text-left">Инфо</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="view in views">
              <td>{{ view.ip }}</td>
              <td class="text-center">{{ view.mobile }}</td>
              <td class="text-center">{{ view.language }}</td>
              <td class="text-left">{{ view.agent }}</td>
            </tr>
          </tbody>
        </table>

      </div>
    </div>
    
  </article>
</template>

<script>
  import { mapGetters } from 'vuex'

  export default {
    data: () => ({

    }),

    computed: mapGetters({
      loading: 'loading',
      views: 'views/views',
    }),

    async fetch() {
      await this.init()
    },

    methods: {
      // Инициализация данных
      async init () {
        await this.$store.dispatch('views/fetchViewsByUrl', this.$route.query.url)
      },
    },
  }
</script>
