<template>
  <article v-if="!loading" class="container-fluid">

    <div class="row mbot3">
      <div class="col-md-4">

        <table class="table table-sm table-hover">
          <thead>
            <tr>
              <th scope="col">Адрес</th>
              <th scope="col" class="text-center">Посетители</th>
              <th scope="col" class="text-center">Просмотры</th>
            </tr>
          </thead>
          <tbody>
            <router-link v-for="view in views"
                         :key="view.url"
                         :to="'views/url?url=' + view.url"
                         :title="view.url"
                         tag="tr">
              <td>{{ view.url }}</td>
              <td class="text-center">{{ view.visits }}</td>
              <td class="text-center">{{ view.total }}</td>
            </router-link>
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
        await this.$store.dispatch('views/fetchViews')
      },
    },
  }
</script>
