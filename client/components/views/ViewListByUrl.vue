<template>
  <article v-if="!loading" class="container-fluid">

    <div class="row mbot3">
      <div class="col-md-5">

        <table class="table table-sm table-hover">
          <thead>
            <tr>
              <th scope="col" class="text-left">Дата</th>
              <th scope="col" class="text-center">Язык</th>
              <th scope="col" class="text-left">IP</th>
              <th scope="col" class="text-center">Время</th>
              <th scope="col" class="text-right">Источник</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="view in views">
              <td class="text-left">{{ view.date }}</td>
              <td class="text-center">{{ view.language }}</td>
              <td class="text-left">{{ view.ip }}</td>
              <td class="text-center">{{ view.time }}</td>
              <td class="text-right">{{ view.referer }}</td>
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
