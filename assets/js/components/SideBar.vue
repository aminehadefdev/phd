<script>

import "../../styles/SideBar.css"
import ItemSideBare from "./ItemSideBare.vue"

import configAsideBar from "../config/asideBar.js"

export default {
  data() {
    return configAsideBar
  },
  methods: {
    getConfig: ()=>{
      return configAsideBar;
    }
  },
  components: { ItemSideBare },
}
</script>

<template>
  <div class="offcanvas offcanvas-start p-3" tabindex="-1" id="offcanvasExample"
    aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
      <img src="../../images/Logo_PhDTalent.png" alt="logo phd talent" />
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <div v-for="item in this.getConfig()">
        <ItemSideBare :item="item"></ItemSideBare>
      </div>
    </div>
  </div>
</template>