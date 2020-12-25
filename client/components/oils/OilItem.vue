<template>
  <div id="catalog">
    <div class="row">
      <div class="col-md-12">
        <div v-if="oil.data" class="panel panel-default">
          <div class="panel-heading mbot3">
            <h1>
              {{ oil.data[locale].title }}
            </h1>
          </div>
          <div class="panel-body oil-description">
            <p>
              <img :src="'/img/oils/' + oil.name + '.jpg'"
                   :alt="oil.data[locale].name"
                   class="img-rounded">
            </p>
            <p>{{ oil.data[locale].plant }}</p>
            <p>{{ oil.data[locale].aroma }}</p>
            <p>{{ oil.data[locale].properties }}</p>
            <p>{{ oil.data[locale].methods }}</p>
            <p>{{ oil.data[locale].contraindications }}</p>
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
          title: this.oil.data[this.locale].title,
          meta: [ 
            {
              hid: 'description', 
              name: 'description', 
              content: this.oil.data[this.locale].title
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
