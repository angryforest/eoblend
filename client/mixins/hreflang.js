import { mapGetters } from 'vuex'

export default {
  computed: mapGetters({
    locale: 'lang/locale',
    locales: 'lang/locales',
  }),

  methods: {
    getHreflangs() {
      let route = this.$router.currentRoute,
          path = route.path
      
      if(route.params.lang)
        path = path.replace('/' + route.params.lang, '')

      return Object.keys(this.locales)
        .filter(locale => locale !== this.locale)
        .map(locale => {
            return {
              rel: 'alternate',
              hreflang: locale,
              href: process.env.appUrl + '/' + locale + path,
            }
        })
    },
  },

}