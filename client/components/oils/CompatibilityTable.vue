<template>
  <div>
    <div class="row mbot2">
      <div class="col-sm-12">

        <span class="oilButton" 
              v-for="property in properties" 
              :key="property.id"
              :title="property.data[locale].description"
              :class="{'active': checkedProperties[property.id]}"
              @click="toggleProperty(property.id)">
            {{ property.data[locale].name }}
          <sup class="propertySup" v-if="checkedProperties[property.id]">{{ property.id }}</sup>
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
                    :class="oilButtonClass(oil.id)"
                    @click="toggleOil(oil.id)">
                  {{ oil.data.name[locale] }}
                  <span class="property">{{ oilProps(oil.id).join(', ') }}</span>
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
      locale: 'lang/locale',
      oils: 'oils/oils',
      properties: 'oils/properties',
      oilProperties: 'oils/oilProperties',
      compatibility: 'oils/compatibility',
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

      oilProps (oilId) {
        return Object.keys(this.checkedProperties).filter(propId => this.oilProperties?.[oilId]?.[propId])
      },

      // Летучесть масел указана в числах с плавающей точкой (возможно будет использовано позже)
      oilsVolatility (index) {
        return this.oils.filter(oil => oil.volatility > index-1 && oil.volatility <= index)
      },

      oilButtonClass (id) {
        return [
          // Масло выбрано
          { 'active': this.checkedOils[id] }, 
          // Масло сочетается со всеми выбранными маслами
          { 'available': Object.keys(this.checkedOils).length && Object.keys(this.checkedOils).length === this.availableOils[id] },
        ]
      },

      toggleProperty (id) {
        this.$store.commit('oils/toggleProperty', id)
      },

      toggleOil (id) {
        // Определяем модификатор и меняем список выбранных масел
        let change = this.checkedOils[id] ? -1 : 1;

        // Проходим только по комплиментарным маслам модифицируя счётчик
        this.compatibility[id].forEach(oil => {
          if (id != oil) {
            if (!this.availableOils[oil]) 
              this.availableOils[oil] = change
            else this.availableOils[oil] += change
          }
        });

        // Провоцирует перерисовку шаблона
        this.$store.commit('oils/toggleOil', id)
      },

      // Проход по всем выбраным маслам и рассчёт для отображения при возврате с другой страницы
      tableCalc () {
        let checked = Object.entries(this.checkedOils);

        if(checked.length) {
          for (const [id, value] of checked) {
            this.compatibility[id].forEach(oil => {
              if (id != oil) {
                if (!this.availableOils[oil]) 
                  this.availableOils[oil] = 1
                else this.availableOils[oil]++
              }
            });
          }

          // Провоцирует перерисовку шаблона
          this.$set(this.availableOils, this.availableOils)
        }
      },
    },
  }
</script>
