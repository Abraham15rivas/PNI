<template>
    <div class="margin-x">
        <div class="content bg">
            <div class="row">
                <div class="col s12">
                    <br><br>
                    <h5 class="black-text center principal-title">
                        Indicador del Perfil de los Investigadores e Investigaciones Registradas
                    </h5>
                </div>
            </div>
            
            <div class="container">
                <div class="row">
                    <div class="col s3"></div>
                    <div class="col s12 m7">
                        <div class="card horizontal">
                            <div class="card-image">
                                <img class="icon-total-register" src="images/registro.svg">
                            </div>
                            <div class="card-stacked">
                                <div class="card-content">
                                    <h5 class="center-align">Total registrados en el perfil del Investigador</h5>
                                </div>
                                <div class="card-action">
                                    <!-- <h2 class="total-register">{{total_investigators}}</h2> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        
        <div class="row">
            <div class="col s12">
                <div class="card card-bg">
                    <div class="card-content center">
                        <span class="card-title">Investigadores por estados</span>
                        <p>Gráfico</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col s3"></div>
                <div class="col s12 m7">
                    <div class="card horizontal">
                        <div class="card-image">
                            <img class="icon-total-register" src="images/registro.svg">
                        </div>
                        <div class="card-stacked">
                            <div class="card-content">
                                <h5 class="center-align">Total registrados en el perfil de la investigación</h5>
                            </div>
                            <div class="card-action">
                                <!-- <h2 class="total-register">{{total_investigators}}</h2> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        

        <div class="row">
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center">Tipo de Investigación</span>
                        <p>Gráfico</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center" >Línea de Investigación</span>
                        <p>Gráfico</p>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="row">
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center">Tipo de Institución</span>
                        <p>Gráfico</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center" >Tiempo de Investigación</span>
                        <p>Gráfico</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {},
    }
</script>
<style>
.margin-x{
    margin: 0 50px
}
</style>
