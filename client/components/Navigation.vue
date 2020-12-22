<template>
  <nav class="navbar navbar-expand-sm navbar-dark">
    <router-link :to="getPath('welcome')" 
                 class="navbar-brand">
      <img class="logo" 
           src="/img/logo.png">
      <span class="mainLabel">
        {{ appName }}
      </span>
    </router-link>

    <button class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarCollapse"
            aria-controls="navbarCollapse"
            aria-expanded="false"
            :aria-label="$t('toggle_navigation')">
      <span class="navbar-toggler-icon" />
    </button>

    <div id="navbarCollapse" class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
          
          <!-- Authenticated -->
          <li v-if="user" class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark"
               href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            >
              <img :src="user.photo_url" class="rounded-circle profile-photo mr-1">
              {{ user.name }}
            </a>
            <div class="dropdown-menu">
              <router-link :to="{ name: 'settings.profile' }" class="dropdown-item pl-3">
                <fa icon="cog" fixed-width />
                {{ $t('settings') }}
              </router-link>

              <div class="dropdown-divider" />
              <a class="dropdown-item pl-3" href="#" @click.prevent="logout">
                <fa icon="sign-out-alt" fixed-width />
                {{ $t('logout') }}
              </a>
            </div>
          </li>

          <!-- Guest -->
          <template v-else>

            <li class="nav-item">
              <router-link :to="getPath('welcome')" 
                           class="nav-link" 
                           active-class="active" 
                           exact>
                {{ $t('calculator') }}
              </router-link>
            </li>

            <li class="nav-item">
              <router-link :to="getPath('oils')" 
                           class="nav-link" 
                           active-class="active">
                {{ $t('handbook') }}
              </router-link>
            </li>

          </template>
        </ul>

        <!-- Авторизация и регистрация будут проработаны позже -->
        <!--<ul class="navbar-nav mr-right">

          <li class="nav-item">
            <router-link :to="getPath('login')" 
                         class="nav-link" 
                         active-class="active">
              {{ $t('login') }}
            </router-link>
          </li>

          <li class="nav-item">
            <router-link :to="getPath('register')" 
                         class="nav-link" 
                         active-class="active">
              {{ $t('register') }}
            </router-link>
          </li>

        </ul>-->

    </div>
  </nav>
</template>

<script>
  import { mapGetters } from 'vuex'

  export default {
    data: () => ({
      appName: process.env.appName
    }),

    computed: mapGetters({
      lang: 'lang/locale',
      user: 'auth/user',
    }),

    methods: {
      getPath (name) {
        const lang = this.lang
        if (lang) return { name, params: { lang }}
        else return { name }
      },

      async logout () {
        await this.$store.dispatch('auth/logout')
        this.$router.push({ name: 'login' })
      },
    },
  }
</script>

<style scoped>
  .profile-photo {
    width: 2rem;
    height: 2rem;
    margin: -.375rem 0;
  }
</style>
