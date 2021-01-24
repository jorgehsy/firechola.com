<template>
  <div class="player media align-self-stretch">
    <img
      :src="getPlayerTier(player.tier)"
      class="mr-1 summoner-icon"
      :alt="player.tier"
    />
    <div class="media-body text-left">
      <h5 class="mt-0">{{ playerName }}</h5>
      <div class="roles">
        <span v-for="(role, key) in player.roles" :key="key" class="mr-2">
          <img :src="getPlayerRole(role)" :alt="role" class="sumonner-role" />
        </span>
      </div>
    </div>
  </div>
</template>

<script>
import { computed } from "vue";
export default {
  props: {
    player: Object
  },

  created() {},

  setup(props) {
    const playerName = computed(() => props.player.name);

    function getPlayerTier(tier) {
      switch (tier) {
        case "TIER I":
          return "/images/ranked-emblems/Emblem_Platinum.png";
        case "TIER II":
          return "/images/ranked-emblems/Emblem_Gold.png";
        case "TIER III":
          return "/images/ranked-emblems/Emblem_Silver.png";
        case "TIER IV":
          return "/images/ranked-emblems/Emblem_Bronze.png";
        case "TIER V":
          return "/images/ranked-emblems/Emblem_Iron.png";
      }
    }
    function getPlayerRole(role) {
      switch (role) {
        case "TOP":
          return "/images/ranked-positions/Position_Challenger-Top.png";
        case "JUNGLE":
          return "/images/ranked-positions/Position_Challenger-Jungle.png";
        case "MID":
          return "/images/ranked-positions/Position_Challenger-Mid.png";
        case "BOTTOM":
          return "/images/ranked-positions/Position_Challenger-Bot.png";
        case "SUPPORT":
          return "/images/ranked-positions/Position_Challenger-Support.png";
      }
    }

    return { getPlayerTier, getPlayerRole, playerName };
  }
};
</script>
