<template>
    <header>
        <div class="navbar-fixed">
            <nav class="navbar blue darken-1">
                <div class="nav-wrapper">
                    <a href="/" class="brand-logo white-text">Dashboard</a>
                    <a href="#!" data-target="sidenav-left" class="sidenav-trigger left">
                        <i class="material-icons white-text">menu</i>
                    </a>
                </div>
            </nav>
        </div>
        <ul class=" sidenav sidenav-fixed">
            <li>
                <a href="/" class="logo-container">
                    <img src="images/logo-mincyt.png" class="logo-min">
                </a>
            </li>
            <li>

                <ul class="collapsible collapsible-accordion">
                    <li class="waves-effect">
                        <a class="collapsible-header" tabindex="0">
                            Estadisticas de Investigadores<i class="material-icons">chevron_left</i> 
                            <!-- Pages<i class="material-icons chevron">chevron_left</i>  -->

                        </a>

                        <div class="collapsible-body" style="display: block;">
                            <ul>
                                <li>
                                    <a href="/pages/admin-dashboard" class="waves-effect active">1<i class="material-icons">web</i></a>
                                </li>
                                <li>
                                    <a href="/pages/admin-fixed-chart" class="waves-effect">2<i class="material-icons">list</i></a>
                                </li>
                                <li>
                                    <a href="/pages/admin-grid" class="waves-effect">3<i class="material-icons">dashboard</i></a>
                                </li>
                                <li>
                                    <a href="/pages/admin-chat" class="waves-effect">4<i class="material-icons">chat</i></a>
                                </li>
                            </ul>
                        </div>
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
    padding: 0px 20px;
}


.sidenav .logo-container {
    padding: 0 16px;
    height: 64px;
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
    height: 55px;
    margin: 5px 40px;
}

/* #1e88e5 blue darken-1
#1976d2 blue darken-2
#1565c0 blue darken-3
#0d47a1 blue darken-4 */


</style>
