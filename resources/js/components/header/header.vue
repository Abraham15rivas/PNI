<template>
    <header>
        <div >
            <nav class="navbar" style="">
                <div >
                   <img src="images/cintillo.jpg" class="cintillo-min">
                </div>
            </nav>
        </div>
        <ul class=" sidenav sidenav-fixed">
            <li>
                <img src="images/pni.png" class="logo-min">
            </li>
            <li>

                <ul class="collapsible collapsible-accordion">
                    <li>
                        <h5 class="center">
                            Indicadores
                        </h5>
                    </li>
                    <li class="waves-effect">
                        <router-link to="/researcher" class="collapsible-header" tabindex="0">
                            Investigadoras e Investigadores<i class="material-icons">web</i> 
                            <!-- Pages<i class="material-icons chevron">chevron_left</i>  -->
                        </router-link>

                        <!-- <div class="collapsible-body" style="display: block;">
                            <ul>
                                <li>
                                    <router-link to="/researcher" class="waves-effect active">1<i class="material-icons">web</i></router-link>
                                </li>
                                <li>
                                    <router-link to="/researcher/1" class="waves-effect">2<i class="material-icons">list</i></router-link>
                                </li>
                                <li>
                                    <router-link to="/researcher/2" class="waves-effect">3<i class="material-icons">dashboard</i></router-link>
                                </li>
                            </ul>
                        </div> -->
                    </li>
                    <li class="waves-effect">
                        <router-link to="/research" class="collapsible-header" tabindex="0">
                            Interés de Investigaciones<i class="material-icons">list</i>
                        </router-link>
                    </li>
                
                </ul>

            </li>
        </ul>
    </header>
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
    height: 64px;
    line-height: 0px;
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
}
.cintillo-min {
    width: 100%;
    height: 100px;
   
}

/* #1e88e5 blue darken-1
#1976d2 blue darken-2
#1565c0 blue darken-3
#0d47a1 blue darken-4 */


</style>
