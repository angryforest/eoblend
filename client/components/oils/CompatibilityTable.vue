<template>
  <div>
    <div class="row mbot2">
      <div class="col-sm-12">

        <span class="oilButton" 
              v-for="property in properties" 
              :key="property.id"
              :title="property.rus_description"
              :class="{'active': checkedProperties[property.id]}"
              @click="toggleProperty(property.id)">
            {{ locale === 'ru' ? property.rus_name : property.eng_name }}
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
                  {{ oil.name[locale] }}
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
      checkedOils: {},
      availableOils: {},
      checkedProperties: {},
    }),

    computed: mapGetters({
      locale: 'lang/locale',
      oils: 'oils/oils',
      properties: 'oils/properties',
      oilProperties: 'oils/oilProperties',
      compatibility: 'oils/compatibility',
      authenticated: 'auth/check',
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
          { 'available': Object.keys(this.checkedOils).length && Object.keys(this.checkedOils).length === this.availableOils[id] }
        ]
      },

      toggleProperty (id) {
        if (this.checkedProperties[id])
          this.$delete(this.checkedProperties, id)
        else this.$set(this.checkedProperties, id, true)
      },

      toggleOil (id) {
        let change;

        // Определяем модификатор и меняем список выбранных масел
        if (this.checkedOils[id]) {
          change = -1
          this.$delete(this.checkedOils, id)
        }
        else {
          change = 1
          this.$set(this.checkedOils, id, true)
        }

        // Проходим только по комплиментарным маслам модифицируя счётчик
        this.compatibility[id].forEach(oil => {
          if (id != oil) {
            if (!this.availableOils[oil]) 
              this.availableOils[oil] = change
            else this.availableOils[oil] += change
          }
        });
      },
    },
  }
</script>
