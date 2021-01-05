import Vue from 'vue'
import axios from 'axios'

if (!Vue.__views_tracker__) {
  Vue.__views_tracker__ = true

  Vue.mixin({
    data() {
      return {
        prevRoute: null,
      }
    },

    // Засекаем время на странице
    created() {
      if (this.$options.track !== true) return 
      this.$_mountTime = Date.now()
    },

    // Отслеживаем внутренние переходы
    beforeRouteEnter(to, from, next) {
      next(vm => {
        vm.prevRoute = from
      })
    },

    // Трекаем посещение
    beforeDestroy()  {
      if (this.$options.track !== true) return 

      console.log(this.prevRoute.path)

      axios.post('page-view', { 
        url: this.$router.currentRoute.fullPath,
        time: Date.now() - this.$_mountTime,
        lang: this.$router.currentRoute.params.lang,
        referer: this.prevRoute.name ? this.prevRoute.path : null
      })
    },

  })
}