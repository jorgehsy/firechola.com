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
import axios from "axios";
import PlayerCard from "@/components/PlayerCard";
const apiUrl = process.env.VUE_APP_API_HOST;
export default {
  name: "Registered",
  components: {
    "player-card": PlayerCard
  },
  created() {
    axios
      .get(`${apiUrl}/players`)
      .then(({ data }) => {
        this.summoners = data.map(d => {
          return {
            name: d.riot_data.name,
            tier: d.tier,
            roles: d.roles,
            confirmed: d.confirmed
          };
        });
      })
      .catch(err => {
        console.log(err);
      });
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
    var summoners = ref([]);

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
