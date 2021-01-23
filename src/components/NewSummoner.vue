<template>
  <div class="container">
    <div class="label">Introduce el nickname</div>
    <div class="summoner">
      <input
        type="text"
        class="mb-3"
        v-model="summonerName"
        placeholder="summoner name"
      />
    </div>
    <div class="d-flex justify-content-center" v-if="loading">
      <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    <template v-if="!validated && !loading">
      <button
        type="button"
        class="btn btn-primary btn-lg"
        @click="validateSummoner"
      >
        Validar
      </button>
      <div class="mt-5">
        <p>El torneo se realizará el día sabado 30 de enero.</p>
        <p>La selección de equipos se realizará aleatorio.</p>
        <p>
          Luego de confirmar, deberás seleccionar la dos (2) posiciones en las
          que quieres jugar.
        </p>
        <p class="font-weight-bold">
          ¡RECUERDA!, si confirmas tu asistencia te comprometes a jugar todos
          los juegos del torneo, incluyendo la final, el cual puede tomar hasta
          la madrugada.
        </p>
        <p>
          El premio se notificara posteriormente, pero equivale a
          aproximadamente 1500 Rps para cada participante del equipo ganador.
        </p>
      </div>
    </template>
    <template v-if="validated">
      <div class="label mt-4">¿Que lineas deseas jugar?</div>
      <div class="d-flex justify-content-around mb-5">
        <div
          class="option"
          :class="{ active: isSelectedRole(role) }"
          v-for="(role, index) in roles"
          :key="index"
          @click="toggleRole(role)"
        >
          {{ role }}
        </div>
      </div>
      <div v-if="selectedRoles.length">
        <div class="label">
          ¿Que tier te consideras jugando en estas lineas?
        </div>
        <div class="d-flex justify-content-around mt-2">
          <div
            class="option"
            :class="{ active: isSelectedTier(tier.value) }"
            v-for="(tier, index) in tiers"
            :key="index"
            @click="toggleTier(tier.value)"
          >
            {{ tier.value }}
            <span>{{ tier.label }}</span>
          </div>
        </div>
      </div>
      <button
        type="button"
        v-if="profileCompleted"
        class="btn btn-primary btn-lg mt-5"
        @click="submitSummoner"
      >
        Registrarse
      </button>
    </template>
    <div class="message" v-if="message !== null">
      {{ message }}
    </div>
  </div>
</template>

<script>
import { ref, computed } from "vue";
const _findIndex = require("lodash/findIndex");
import router from "@/router";

export default {
  name: "NewSummoner",
  setup() {
    var summonerName = ref("");
    var loading = ref(false);
    var validated = ref(false);
    var message = ref(null);
    const roles = ref(["TOP", "JUNGLE", "MID", "BOTTOM", "SUPPORT"]);
    const tiers = ref([
      { value: "TIER I", label: "Faker es mi pupilo" },
      { value: "TIER II", label: "Soy bueno pero tengo miedo" },
      { value: "TIER III", label: "Uso el flash cuando me asusto" },
      { value: "TIER IV", label: "Soy un ward con habilidades" },
      { value: "TIER V", label: "¡doy pena! por favor no me maten" }
    ]);
    var selectedRoles = ref([]);
    var selectedTier = ref([]);
    var profileCompleted = computed(() => {
      return (
        validated &&
        selectedRoles.value.length > 0 &&
        selectedTier.value.length > 0
      );
    });

    async function checkSummoner() {
      return new Promise(resolve => {
        setTimeout(() => {
          resolve("ok");
        }, 2000);
      });
    }

    function isSelectedRole(role) {
      return selectedRoles.value.includes(role);
    }

    function toggleRole(role) {
      let index = _findIndex(selectedRoles.value, i => i === role);
      if (index === -1) {
        selectedRoles.value.push(role);
      } else {
        selectedRoles.value.splice(index, 1);
      }
    }

    function isSelectedTier(tier) {
      return selectedTier.value.includes(tier);
    }

    function toggleTier(role) {
      selectedTier.value = [];
      selectedTier.value.push(role);
    }

    function validateSummoner() {
      this.loading = true;
      checkSummoner()
        .then(() => {
          this.loading = false;
          this.validated = true;
          // registerSummoner();
        })
        .catch(err => {
          console.log(err);
        });
    }

    function submitSummoner() {
      registerSummoner();
    }

    // function showMessage(msg) {
    //   message.value = msg;
    //   setTimeout(() => {
    //     message.value = null;
    //   }, 5000);
    //   return true;
    // }

    function registerSummoner() {
      router.push({ path: "registered" });
    }

    return {
      summonerName,
      submitSummoner,
      validateSummoner,
      loading,
      validated,
      roles,
      isSelectedRole,
      isSelectedTier,
      toggleRole,
      toggleTier,
      selectedRoles,
      selectedTier,
      tiers,
      profileCompleted,
      message
    };
  }
};
</script>

<style lang="scss" scoped></style>
