<template>
<div>
    <header>
        <div class="navbar-fixed">
            <nav class="navbar blue darken-1"  style="height: 95px">
                <div class="nav-wrapper">
                    <div class="brand-logo" >
                        <img class="logo-min header-logo" src="images/mincyt.png" alt="">
                    </div>
                </div>
            </nav>
        </div>
        <ul class=" sidenav sidenav-fixed">
            <li>
                <div class="logo-container">
                    <img src="images/pni.png" class="logo-min">
                </div>
            </li>
            <li>
                <ul class="collapsible collapsible-accordion">
                    <li class="waves-effect">
                        <a class="collapsible-header" tabindex="0">
                           <h5 class="black-text name center">Indicadores</h5>
                        </a>
                    </li>
                    <li class="waves-effect">
                        <router-link to="/researcher" class="collapsible-header" tabindex="0">
                           Inicio<i class="material-icons">home</i> 
                        </router-link>
                    </li>
                    <li class="waves-effect">
                        <router-link to="/researcher" class="collapsible-header" tabindex="0">
                            Investigadores e Investigadoras<i class="material-icons ">people</i> 
                        </router-link>
                    </li>
                    <li class="waves-effect">
                        <router-link to="/research" class="collapsible-header" tabindex="0">
                            Interés de Investigación<i class="material-icons">work</i>
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
        mounted() {
            console.log('Componente montado.')
        }
    }
</script>

<style scoped>

.navbar {
    background: white;
    height: 0 !important;
}

.sidenav .logo-container {
    padding: 0 16px;
    height: 94px;
    line-height: 64px;
    font-size: 24px;
    box-sizing: content-box;
}

.sidenav .collapsible>li.waves-effect {
    display: block;
}

.sidenav .collapsible li, .sidenav.fixed .collapsible li {
    padding: 0;
}
.logo-min{
	width: 195px;
	height: 85px;
	margin-top: 6px;
}
.cintillo-min {
    width: 100%;
    height: 100px;
   
}

.header-logo {
    margin-left: 750px;
}
</style>
