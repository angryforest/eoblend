<template>
  <div>

    <div class="row mbot2">
      <div class="col-sm-12">

        <span class="oilButton typeButton" 
              v-for="type in types" 
              :key="type.id"
              :title="type.data[locale].name">
          <span class="typeIcon" :class="type.name"></span>
          {{ type.data[locale].name }}
        </span>

      </div>
    </div>

    <div class="row mbot2">
      <div class="col-md-12">

        <router-link v-for="oil in oils" 
                     :key="oil.id"
                     :to="'oils/' + oil.name"
                     :title="oil.data.name[locale]"
                     class="oilButton"
                     :class="{ 'active': checkedOils[oil.id] }">
          {{ oil.data.name[locale] }}
          <span v-for="val, type, index in oilTypes[oil.id]"
                  :key="type"
                  class="typeIcon" 
                  :class="types[type-1].name">
          </span>
        </router-link>

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
      oils: 'oils/oils',
      types: 'oils/types',
      locale: 'lang/locale',
      oilTypes: 'oils/oilTypes',
      checkedOils: 'oils/checkedOils',
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
