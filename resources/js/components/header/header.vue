<template>
<div>
    <header>
<<<<<<< HEAD
        <div >
            <nav class="navbar" style="">
                <div >
                   <img src="images/cintillo.jpg" class="cintillo-min">
=======
        <div class="navbar-fixed">
            <nav class="navbar blue darken-1"  style="height: 95px">
                <div class="nav-wrapper">
                    <div class="brand-logo" >
                        <img class="logo-min header-logo" src="images/mincyt.png" alt="">
                    </div>
>>>>>>> cbce73ddbe5801961e3b258e14e6a381520683ee
                </div>
            </nav>
        </div>
        <ul class=" sidenav sidenav-fixed">
            <li>
<<<<<<< HEAD
                <img src="images/pni.png" class="logo-min">
=======
                <div class="logo-container">
                    <img src="images/pni.png" class="logo-min">
                </div>
>>>>>>> cbce73ddbe5801961e3b258e14e6a381520683ee
            </li>
            <li>
                <ul class="collapsible collapsible-accordion">
<<<<<<< HEAD
                    <li>
                        <h5 class="center">
                            Indicadores
                        </h5>
=======
                    <li class="waves-effect">
                        <a class="collapsible-header" tabindex="0">
                           <h5 class="black-text name center">Indicadores</h5>
                        </a>
>>>>>>> cbce73ddbe5801961e3b258e14e6a381520683ee
                    </li>
                    <li class="waves-effect">
                        <router-link to="/researcher" class="collapsible-header" tabindex="0">
                           Inicio<i class="material-icons">home</i> 
                        </router-link>
                    </li>
                    <li class="waves-effect">
<<<<<<< HEAD
                        <router-link to="/research" class="collapsible-header" tabindex="0">
                            Interés de Investigaciones<i class="material-icons">list</i>
=======
                        <router-link to="/researcher" class="collapsible-header" tabindex="0">
                            Investigadores e Investigadoras<i class="material-icons ">people</i> 
>>>>>>> cbce73ddbe5801961e3b258e14e6a381520683ee
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
<<<<<<< HEAD
    height: 64px;
    line-height: 0px;
=======
    height: 94px;
    line-height: 64px;
>>>>>>> cbce73ddbe5801961e3b258e14e6a381520683ee
    font-size: 24px;
    box-sizing: content-box;
}

.sidenav .collapsible>li.waves-effect {
    display: block;
}

.sidenav .collapsible li, .sidenav.fixed .collapsible li {
    padding: 0;
}
<<<<<<< HEAD

/* .chevron {
    float: right;
    height: 24px;
    width: 24px;
    line-height: 24px;
    margin: 20px 0 0 0;
    transition: transform .2s;
    transform: rotate(-90deg);
} */

.logo-min {
    width: 188px;
    height: 100px;
    margin: 5px 40px;
=======
.logo-min{
	width: 195px;
	height: 85px;
	margin-top: 6px;
>>>>>>> cbce73ddbe5801961e3b258e14e6a381520683ee
}
.cintillo-min {
    width: 100%;
    height: 100px;
   
}

.header-logo {
    margin-left: 750px;
}
</style>
