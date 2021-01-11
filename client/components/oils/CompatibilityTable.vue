<template>
  <div v-if="!loading">
    
    <div class="row mbot2">
      <div class="col-sm-12">

        <span class="oilButton" 
              v-for="property in properties" 
              :key="property.id"
              :title="property.data[locale].description"
              :class="{'active': checkedProperties.includes(property.id)}"
              @click="toggleProperty(property)">
            {{ property.data[locale].name }}
          <sup class="propertySup" v-if="checkedProperties.includes(property.id)">{{ property.id }}</sup>
        </span>

      </div>
    </div>

    <div class="row mbot2">
      <div class="mbot2 col-sm-6 col-md-4" 
           v-for="(volatility, index) in ['high', 'average', 'low']" 
           :key="volatility">
        <div :class="volatility + 'Volatility'">

            <div class="volatilityTitle">
              <h2>
                {{ $t(volatility + '_volatility') }} 
                <small>
                  {{ $t(volatility + '_notes') }}
                </small>
              </h2>
            </div>

            <div class="volatilityOils">
              <span class="oilButton" 
                    v-for="oil in oilsVolatility(index + 1)"
                    :key="oil.id"
                    :class="oilButtonClass(oil)"
                    @click="toggleOil(oil)">
                  {{ oil.data[locale].name }}
                  <span class="property">{{ oilProps(oil).join(', ') }}</span>
              </span>
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
      availableOils: {},
    }),

    computed: mapGetters({
      loading: 'loading',
      oils: 'oils/oils',
      locale: 'lang/locale',
      properties: 'oils/properties',
      authenticated: 'auth/check',
      checkedOils: 'oils/checkedOils',
      checkedProperties: 'oils/checkedProperties',
    }),

    async fetch() {
      // Избегаем повторной загрузки данных
      if(!this.oils.length)
        await this.init()
    },

    mounted () {
      this.tableCalc()
    },

    methods: {
      // Инициализация данных
      async init () {
        await this.$store.dispatch('oils/fetchOils')
      },

      oilProps (oil) {
        return this.checkedProperties.filter(id => oil.properties.includes(id))
      },

      // Летучесть масел указана в числах с плавающей точкой (возможно будет использовано позже)
      oilsVolatility (index) {
        return this.oils.filter(oil => oil.volatility > index-1 && oil.volatility <= index)
      },

      oilButtonClass (oil) {
        return [
          // Масло выбрано
          { 'active': this.checkedOils.includes(oil.id) }, 
          // Масло сочетается со всеми выбранными маслами
          { 'available': this.checkedOils.length && this.checkedOils.length === this.availableOils[oil.id] },
        ]
      },

      toggleProperty (property) {
        this.$store.commit('oils/toggleProperty', property.id)
      },

      toggleOil (oil) {
        // Определяем модификатор и меняем список выбранных масел
        let change = this.checkedOils.includes(oil.id) ? -1 : 1

        // Проходим только по комплиментарным маслам модифицируя счётчик
        oil.compatibility.filter(id => oil.id != id).forEach(id => {
          if (!this.availableOils[id]) 
            this.availableOils[id] = change
          else this.availableOils[id] += change
        })

        // Провоцирует перерисовку шаблона
        this.$store.commit('oils/toggleOil', oil.id)
      },

      // Проход по всем выбраным маслам и рассчёт для отображения при возврате с другой страницы
      tableCalc () {
        if(this.checkedOils.length) {
          this.oils.filter(oil => this.checkedOils.includes(oil.id)).forEach(oil => {
            oil.compatibility.filter(id => oil.id != id).forEach(id => {
              if (!this.availableOils[id]) 
                this.availableOils[id] = 1
              else this.availableOils[id]++
            })
          })

          // Провоцирует перерисовку шаблона
          this.$set(this.availableOils, this.availableOils)
        }
      },
    },
  }
</script>
