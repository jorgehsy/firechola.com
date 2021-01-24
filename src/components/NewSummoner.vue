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
        @click="validateSummoner(summonerName)"
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
  </div>
  <div class="message" v-if="message !== ''">
    {{ message }}
  </div>
</template>

<script>
import { ref, computed } from "vue";
import router from "@/router";
import axios from "axios";
const _findIndex = require("lodash/findIndex");
const apiUrl = process.env.VUE_APP_API_HOST;

export default {
  name: "NewSummoner",

  created() {
    let userStorage = window.localStorage;
    if (userStorage.player) {
      // let player = JSON.parse(userStorage.player);
      router.push({ path: "registered" });
    }
  },
  setup() {
    var summonerName = ref("");
    var loading = ref(false);
    var validated = ref(false);
    var message = ref("");
    var player = ref({});
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
      return axios.get(`${apiUrl}/player/check/${summonerName.value}`);
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

    async function validateSummoner(name) {
      this.loading = true;
      return checkSummoner()
        .then(({ data }) => {
          if (data === "registered") {
            router.push({ path: "registered" });
          } else {
            validateRiotAccount(name)
              .then(() => {
                this.loading = false;
                this.validated = true;
              })
              .catch(() => {
                showMessage(`No existe ${name} en la cuenta de LAN`);
              });
          }
        })
        .catch(err => {
          console.log(err);
        });
    }

    async function submitSummoner() {
      await registerSummoner();
    }

    async function validateRiotAccount(name) {
      return new Promise((resolve, reject) => {
        axios
          .get(`${apiUrl}/riot/summoner/by-name/${name}`)
          .then(({ data }) => {
            player = { riot_data: data };
            resolve(data);
          })
          .catch(() => {
            reject("rejected");
          });
      });
    }

    function showMessage(msg) {
      message.value = msg;
      setTimeout(() => {
        message.value = null;
      }, 5000);
      loading.value = false;
      return true;
    }

    async function registerSummoner() {
      let data = {
        ...player,
        ...{
          summoner_name: summonerName.value,
          tier: selectedTier.value[0],
          roles: selectedRoles.value
        }
      };
      return axios
        .post(`${apiUrl}/player`, data)
        .then(({ data }) => {
          window.localStorage.setItem("player", JSON.stringify(data));
          router.push({ path: "registered" });
        })
        .catch(err => {
          console.log(err);
        });
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
