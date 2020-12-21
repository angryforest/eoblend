<template>
  <nav class="navbar justify-content-end">
    <router-link :to="'/' + key + path"
       class="nav-link"
       v-for="(value, key) in locales" 
       :class="{'active': locale === key}"
       :key="key"
       :hreflang="key"
       @click.native="setLocale(key)">
      {{ value }}
    </router-link>
  </nav>
</template>

<script>
  import { mapGetters } from 'vuex'
  import { loadMessages } from '~/plugins/i18n'

  export default {
    data: () => {
      return {
        path: ''
      }
    },

    computed: mapGetters({
      locale: 'lang/locale',
      locales: 'lang/locales',
    }),

    // Отслеживаем изменения роута для обновления ссылок на перевод
    watch: {
      '$route' (to, from) {
        this.path = this.preparePath(to)
      }
    },

    // Отслеживаение не работет при первичной загрузке, инициализируем
    created () {
        this.path = this.preparePath(this.$router.currentRoute)
    },

    methods: {
      setLocale (locale) {
        if (this.$i18n.locale !== locale) {
          loadMessages(locale)
          this.$store.dispatch('lang/setLocale', { locale })
        }
      },

      // Получаем текущий путь без языкового префикса
      preparePath (router) {
        let path = router.path
        
        if(router.params.lang)
          path = path.replace('/' + router.params.lang, '')

        if(!path) path = '/'

        return path
      },
    },
  }
</script>

<style>

  .nav-link {
    color: #6c757d;
  }

  .nav-link:hover,
  .nav-link.active {
    color: #343a40;
  }

</style>
