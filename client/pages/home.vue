<template>
  <card :title="$t('calculator')">
    {{ $t('you_are_logged_in') }}
  </card>
</template>

<script>
export default {
  middleware: 'auth',

  head () {
    return { title: this.$t('calculator') }
  }
}
</script>
