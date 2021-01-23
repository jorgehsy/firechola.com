<template>
  <div class="container">
    <div>Total registrados: {{ totalRegistered }}</div>
    <div>Total confirmados: {{ totalConfirmed }}</div>
  </div>
  <div class="">
    <div class="row">
      <div class="col">
        <h2>Registrados</h2>
        <div id="registered" class="summoners d-flex flex-wrap ">
          <player-card
            v-for="(player, index) in summoners"
            :key="index"
            :player="player"
          />
        </div>
      </div>
      <div class="col">
        <h2>Confirmados</h2>
        <div id="confimred" class="summoners d-flex flex-wrap ">
          <player-card
            v-for="(player, index) in playersConfirmed"
            :key="index"
            :player="player"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, computed } from "vue";
import PlayerCard from "@/components/PlayerCard";
export default {
  name: "Registered",
  components: {
    "player-card": PlayerCard
  },
  setup() {
    var playersConfirmed = computed(() =>
      summoners.value.filter(p => p.confirmed)
    );
    var playersUnconfirmed = computed(() =>
      summoners.value.filter(p => !p.confirmed)
    );
    var totalConfirmed = computed(() => playersConfirmed.value.length);
    var totalRegistered = computed(() => summoners.value.length);
    var summoners = ref([
      {
        name: "YKZA Fireshoot",
        tier: ["TIER I"],
        roles: ["MID", "TOP"],
        confirmed: true
      },
      {
        name: "YKZA Tek",
        tier: ["TIER I"],
        roles: ["JUNGLE", "TOP"],
        confirmed: false
      },
      {
        name: "YKZA Tek",
        tier: ["TIER I"],
        roles: ["JUNGLE", "TOP"],
        confirmed: false
      },
      {
        name: "YKZA Tek",
        tier: ["TIER I"],
        roles: ["JUNGLE", "TOP"],
        confirmed: false
      },
      {
        name: "Escor",
        tier: ["TIER II"],
        roles: ["JUNGLE", "TOP", "SUPPORT"],
        confirmed: true
      },
      {
        name: "EstaraATodoOGT",
        tier: ["TIER II"],
        roles: ["JUNGLE", "TOP", "SUPPORT", "BOTTOM", "MID"],
        confirmed: true
      }
    ]);

    return {
      summoners,
      playersConfirmed,
      playersUnconfirmed,
      totalConfirmed,
      totalRegistered
    };
  }
};
</script>

<style lang="scss" scope></style>
