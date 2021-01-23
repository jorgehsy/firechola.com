<template>
  <div class="home">
    <new-summoner />
  </div>
</template>

<script>
// @ is an alias to /src
import NewSummoner from "@/components/NewSummoner.vue";

export default {
  name: "Home",
  components: {
    NewSummoner
  }
};
</script>
