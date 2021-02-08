<template>
   <div id="preloader" v-show="load">
        <div id="loader"></div>
        <img class="load-icon" src="images/buscar.svg" width="65px" alt="">
        <h5 class="text">Cargando datos...</h5>
    </div>
</template>
<script>
export default {
   
}
</script>

<script>
    export default {
        data() {
            return {
                load: false
            }
        },
        mounted() {
            setTimeout(() => this.load = true, 0);
            setTimeout(() => this.load = false, 7000);
        },
}
</script>

<style lang="scss">
     #preloader {
        background-color: #162531;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1000;
    }
    #loader {
        display: block;
        position: relative;
        left: 50%;
        top: 50%;
        width: 150px;
        height: 150px;
        margin: -75px 0 0 -75px;
        border-radius: 50%;
        border: 3px solid transparent;
        border-top-color: #1e98d4;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }

    #loader:before {
        content: "";
        position: absolute;
        top: 5px;
        left: 5px;
        right: 5px;
        bottom: 5px;
        border-radius: 50%;
        border: 3px solid transparent;
        border-top-color: #2a92d0;
        -webkit-animation: spin 3s linear infinite;
        animation: spin 3s linear infinite;
    }
    #loader:after {
        content: "";
        position: absolute;
        top: 15px;
        left: 15px;
        right: 15px;
        bottom: 15px;
        border-radius: 50%;
        border: 3px solid transparent;
        border-top-color: #507cbe;
        -webkit-animation: spin 1.5s linear infinite;
        animation: spin 1.5s linear infinite;
    }

    h5.text {
        display: inline-block;
        position: relative;
        top: 50%;
        left: 45%;
        transform: translate(-50%,-50%);
        color: #fff;
    }
    .load-icon{
        display: inline-block;
        position: relative;
        top: 40%;
        left: 50%;
        transform: translate(-50%,-50%);
        color: #fff;
    }
@-webkit-keyframes spin {
    0%   {
        -webkit-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}
@keyframes spin {
    0%   {
        -webkit-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}

</style>