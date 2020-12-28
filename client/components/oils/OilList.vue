<template>
  <div>

    <div class="row">
      <div class="col-md-3 mbot2">

        <div class="input-group">
          <input v-model="search"
                  type="text" 
                  class="form-control" 
                  placeholder="Поиск">
        </div>

      </div>

      <div class="col-md-9 mbot2">

        <span class="oilButton typeButton" 
              v-for="type in types" 
              :key="type.id"
              :title="type.data[locale].name">
          {{ type.data[locale].name }}
          <span class="typeIcon" :class="type.name" style="font-size: 27px; line-height: 17px;">•</span>
        </span>

      </div>
    </div>

    <div class="row mbot2">
      <div class="col-md-12">

        <router-link v-for="oil in oils.filter(oil => oil.data[locale].name.toLowerCase().includes(search.toLowerCase()))" 
                     :key="oil.id"
                     :to="'oils/' + oil.name"
                     :title="oil.data[locale].name"
                     class="oilButton"
                     :class="{ 'active': checkedOils.includes(oil.id) }">
          {{ oil.data[locale].name }}
          <span class="types">
            <span v-for="type in oil.types"
                    :key="type"
                    class="typeIcon" 
                    :class="type">
                    ●
            </span>
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
      search: '',
    }),

    computed: mapGetters({
      oils: 'oils/oils',
      types: 'oils/types',
      locale: 'lang/locale',
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
