<template>
  <div id="catalog">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading mbot3">
            <h1>
              {{ oil.title }}
            </h1>
          </div>
          <div class="panel-body oil-description">
            <p>
              <img :src="require('~/assets' + oil.cover)"
                   :alt="locale === 'ru' ? oil.rus_name : oil.eng_name"
                   class="img-rounded">
            </p>
            <p>{{ oil.plant }}</p>
            <p>{{ oil.aroma }}</p>
            <p>{{ oil.properties }}</p>
            <p>{{ oil.methods }}</p>
            <p>{{ oil.contraindications }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'

  export default {
    data: () => ({

    }),

    computed: {
      ...mapGetters({
        locale: 'lang/locale',
        oil: 'oils/oil',
      }),
    },

    async fetch() {
      // Избегаем повторной загрузки данных
      if(!Object.keys(this.oil).length)
        await this.init()
    },

    methods: {
      // Инициализация данных
      async init () {
        await this.$store.dispatch('oils/fetchOil', this.$route.params.name)
      },
    },
  }
</script>
