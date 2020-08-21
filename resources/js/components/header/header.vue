<template>
<div>
    <header>
        <div class="navbar-fixed">
            <nav class="navbar blue darken-1"  style="height: 95px">
                <div class="nav-wrapper">
                    <div class="brand-logo" >
                            <img class="logo-min header-logo" src="images/mincyt.png" alt="">
                    </div>
                    <a href="#" data-target="sidenav-left" class="sidenav-trigger left">
                        <i class="material-icons white-text">menu</i>
                    </a>
                </div>
            </nav>
        </div>
        <ul class=" sidenav sidenav-fixed">
            <li>
                <router-link to="/home" class="logo-container">
                    <img src="images/pni.png" class="logo-min">
                </router-link>
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
                            Investigadores<i class="material-icons ">people</i> 
                        </router-link>
                    </li>
                    <li class="waves-effect">
                        <router-link to="/research" class="collapsible-header" tabindex="0">
                            Interes de Investigaciones<i class="material-icons">work</i>
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
    padding: 0px 20px;
}

.sidenav .logo-container {
    padding: 0 16px;
    height: 94px;
    line-height: 64px;
    font-size: 24px;
    border-bottom: 1px solid rgba(0,0,0,0.2);
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

.header-logo {
    margin-left: 700px;
}
</style>
