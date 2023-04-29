<template>
  <p>Your site link is {{ sitelink }}</p>
  <button @click="counter++">You clicked me {{ counter }} times</button>
</template>
<script>
export default {
  props: ['sitelink'],
  data() {
    return {
      counter: 0
    }
  }
}
</script>