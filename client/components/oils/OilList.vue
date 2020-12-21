<template>
  <div id="catalog">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-3 mbot3 oilPreview"
               v-for="oil in oils" 
               :key="oil.id">
            <a :href="'oils/' + oil.url"
               :title="locale === 'ru' ? oil.rus_name : oil.eng_name">
              <img :src="require('~/assets' + oil.cover)"
                   :alt="locale === 'ru' ? oil.rus_name : oil.eng_name"
                   width="100%">
              <span class="oil-title">
                {{ locale === 'ru' ? oil.rus_name : oil.eng_name }}
              </span>
            </a>
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

    computed: mapGetters({
      locale: 'lang/locale',
      oils: 'oils/oils',
    }),

    async fetch() {
      // Избегаем повторной загрузки данных
      if(!this.oils.length)
        await this.init()
    },

    methods: {
      // Инициализация данных
      async init () {
        await this.$store.dispatch('oils/fetchOils')
      },
    },
  }
</script>
