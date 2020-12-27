<template>
  <article class="container-fluid">

    <div class="row mbot3">
      <div class="col-md-4">

        <table class="table table-sm">
          <thead>
            <tr>
              <th scope="col">Адрес</th>
              <th scope="col" class="text-center">Посещения</th>
              <th scope="col" class="text-center">Просмотры</th>
              <th scope="col" class="text-right">Язык</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="view in views">
              <td>{{ view.url }}</td>
              <td class="text-center">{{ view.visits }}</td>
              <td class="text-center">{{ view.total }}</td>
              <td class="text-right">{{ view.language }}</td>
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
      views: 'views/views',
    }),

    async fetch() {
      await this.init()
    },

    methods: {
      // Инициализация данных
      async init () {
        await this.$store.dispatch('views/fetchViews')
      },
    },
  }
</script>
