<template>
  <div id="catalog">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-3 mbot3 oilPreview"
               v-for="oil in oils" 
               :key="oil.id">
            <router-link :to="'oils/' + oil.url"
               :title="oil.name[locale]">
              <img :src="oil.cover"
                   :alt="oil.name[locale]"
                   width="100%">
              <span class="oil-title">
                {{ oil.name[locale] }}
              </span>
            </router-link>
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
