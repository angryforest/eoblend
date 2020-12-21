<template>
  <div class="layout d-flex flex-column min-vh-100">

  	<header id="header">
	    <div class="mainContainer">
	    	<navigation />
		  </div>
    </header>

    <main class="mainContainer text-left">
      <nuxt />
    </main>

    <footer class="footer mt-auto">
      <div class="mainContainer"> 
        <localization />
      </div>
    </footer>

  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import Navigation from '~/components/Navigation'
  import Localization from '~/components/Localization'

  export default {

    computed: mapGetters({
      locale: 'lang/locale',
    }),

    head() {
      return {
        htmlAttrs: {
          lang: this.locale,
        },
      }
    },

    components: {
      Navigation,
      Localization
    }
  }
</script>
