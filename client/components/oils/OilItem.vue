<template>
  <div id="catalog">
    <div class="row">
      <div class="col-md-12">
        <div v-if="oil.specification" class="panel panel-default">
          <div class="panel-heading mbot3">
            <h1>
              {{ oil.title }}
            </h1>
          </div>
          <div class="panel-body oil-description">
            <p>
              <img :src="oil.cover"
                   :alt="oil.specification[locale].name"
                   class="img-rounded">
            </p>
            <p>{{ oil.specification[locale].plant }}</p>
            <p>{{ oil.specification[locale].aroma }}</p>
            <p>{{ oil.specification[locale].properties }}</p>
            <p>{{ oil.specification[locale].methods }}</p>
            <p>{{ oil.specification[locale].contraindications }}</p>
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

    head () {
      if(process.server) {
        return { 
          title: this.oil.specification[this.locale].title,
          meta: [ 
            {
              hid: 'description', 
              name: 'description', 
              content: this.oil.specification[this.locale].title
            }
          ],
        }
      }
      else {
        return { 
        }
      }
    },

    computed: {
      ...mapGetters({
        locale: 'lang/locale',
        oil: 'oils/oil',
      }),
    },

    async fetch() {
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
