<template>
  <div v-if="!loading" id="catalog">
    <div class="row">
      <div class="col-md-12">
        <div v-if="oil.data" class="panel panel-default">
          <div class="panel-heading mbot3">

            <h1>
              {{ oil.data[locale].title }}
            </h1>
            
          </div>
          <div class="panel-body oil-description">

            <section>
              <p>
                <img :src="'/img/oils/' + oil.name + '.jpg'"
                     :alt="oil.data[locale].name"
                     class="img-rounded">
              </p>
            </section>

            <section>
              <p>
                {{ oil.data[locale].plant }}
              </p>
            </section>

            <section>
              <p>
                {{ oil.data[locale].aroma }}
              </p>
            </section>

            <section>
              <p>
                {{ oil.data[locale].properties }}
              </p>
            </section>

            <section>
              <p>
                {{ oil.data[locale].methods }}
              </p>
            </section>

            <section>
              <p>
                {{ oil.data[locale].contraindications }}
              </p>
            </section>

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

    computed: mapGetters({
        loading: 'loading',
        locale: 'lang/locale',
        oil: 'oils/oil',
    }),

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
