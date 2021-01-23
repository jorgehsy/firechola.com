<template>
  <div class="player media align-self-stretch">
    <img
      :src="getPlayerTier(player.tier[0])"
      class="mr-1 summoner-icon"
      alt="player.tier[0]"
    />
    <div class="media-body text-left">
      <h5 class="mt-0">{{ player.name }}</h5>
      <div class="roles">
        <span v-for="(role, key) in player.roles" :key="key" class="mr-2">
          <img :src="getPlayerRole(role)" :alt="role" class="sumonner-role" />
        </span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    player: Object
  },

  setup() {
    function getPlayerTier(tier) {
      switch (tier) {
        case "TIER I":
          return "/images/ranked-emblems/Emblem_Bronze.png";
        case "TIER II":
          return "/images/ranked-emblems/Emblem_Silver.png";
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

    return { getPlayerTier, getPlayerRole };
  }
};
</script>
