<template>
  <div>
    <header>
      <div class="navbar-fixed" style="height: 95px">
        <nav class="navbar blue darken-1" style="height: 95px">
          <div class="nav-wrapper">
            <div class="brand-logo">
              <img
                class="logo-min header-logo"
                src="images/mincyt.png"
                alt=""
              />
            </div>
            <a
              data-target="slide-out"
              class="sidenav-trigger left"
              v-bind:class="{ 'button-collapse': sidebar }"
              v-on:click="collapse()"
            >
              <i class="material-icons white-text">menu</i>
            </a>
          </div>
        </nav>
      </div>
      <ul
        class="sidenav sidenav-fixed"
        v-bind:class="{ 'sidenav-collapse': sidebar }"
        id="slide-out"
      >
        <li>
          <div class="logo-container">
            <img src="images/pni_logo_nuevo.png" class="logo-sidebar" />
          </div>
        </li>
        <li>
          <ul class="collapsible collapsible-accordion top-m">
            <li class="waves-effect">
              <h5 class="black-text name center">Indicadores</h5>
            </li>
            <li class="waves-effect" :class="[`${this.$root.$route.path === '/home' || this.$root.$route.path === '/' ? 'active' : ''}`]">
              <router-link to="/home" class="collapsible-header" tabindex="0">
                Inicio<i class="material-icons">home</i>
              </router-link>
            </li>
            <li class="waves-effect" :class="[`${this.$root.$route.path === '/investigadores' ? 'active' : ''}`]">
              <router-link
                to="/investigadores"
                class="collapsible-header"
                tabindex="0"
              >
                Investigadores e Investigadoras<i class="material-icons">people</i>
              </router-link>
            </li>
            <li class="waves-effect" :class="[`${this.$root.$route.path === '/research' ? 'active' : ''}`]">
              <router-link
                to="/research"
                class="collapsible-header"
                tabindex="0"
              >
                Interés de Investigación<i class="material-icons">work</i>
              </router-link>
            </li>
            <li class="waves-effect" :class="[`${this.$root.$route.path === '/profileResearch' ? 'active' : ''}`]">
              <router-link
                to="/profileResearch"
                class="collapsible-header"
                tabindex="0"
              >
                Perfil de Investigación<i class="material-icons">person</i>
              </router-link>
            </li>
            <li class="waves-effect" :class="[`${this.$root.$route.path === '/currentResearch' ? 'active' : ''}`]">
              <router-link
                to="/currentResearch"
                class="collapsible-header"
                tabindex="0"
              >
                Módulo de Investigación Actual<i class="material-icons">view_module</i>
              </router-link>
            </li>
          </ul>
        </li>
      </ul>
    </header>
  </div>
</template>

<script>
export default {
  data() {
    return {
      sidebar: false
    }
  },
  methods: {
    collapse() {
      this.sidebar = !this.sidebar;
    }
  }
};
</script>

<style scoped>
.sidenav li.active {
  background-color: #1e88e5 !important;
  color: white !important;
}
.sidenav li.active > a {
  color: white !important;
}
.sidenav li.active > a > i {
  color: white !important;
}
.sidenav .logo-container {
  padding: 0 16px;
  height: 94px;
  line-height: 64px;
  font-size: 24px;
  box-sizing: content-box;
}

.sidenav .collapsible > li.waves-effect {
  display: block;
}

.sidenav .collapsible li,
.sidenav.fixed .collapsible li {
  padding: 0;
}

.logo-min {
  width: 195px;
  height: 85px;
  margin-top: 6px;
}

.cintillo-min {
  width: 100%;
  height: 100px;
}

.header-logo {
  position: fixed;
  right: 10px;
}

.brand-logo {
  width: 100%;
}

.logo-sidebar {
  height: 100px;
  margin: 0 auto;
  display: block;
}

.top-m {
  margin-top: 10px;
}

@media (max-width: 992px) {
  .sidenav-collapse {
    transform: translateX(0%);
    -webkit-transition: transform 300ms linear;
    -moz-transition: transform 300ms linear;
    -ms-transition: transform 300ms linear;
    -o-transition: transform 300ms linear;
    transition: transform 300ms linear;
  }

  .button-collapse {
    margin-left: 312px;
    -webkit-transition: margin-left 300ms linear;
    -moz-transition: margin-left 300ms linear;
    -ms-transition: margin-left 300ms linear;
    -o-transition: margin-left 300ms linear;
    transition: margin-left 300ms linear;
  }
}
</style>
