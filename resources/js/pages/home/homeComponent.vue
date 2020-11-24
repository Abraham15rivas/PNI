<template>
    <div>
        <div class="row">
            <div class="col m6 s12 section-imagen">
                <div>
                    <img src="images/portada.png" class="imagen-portada" alt="">
                    <h4 class="texto-imagen" style="margin-top: 10px">COVID-19</h4>
                </div>
            </div>
            <div class="col m6 s12 section-imagen">
                <h3 class="right-align" >Investigadores e Investigadoras Registrados en el Programa Nacional de Investigadores (PNI) </h3>
            </div>
        </div>
    </div>

</template>

<style scoped>
.imagen-portada{
	width: auto;
	height: auto;	
}

.section-imagen{
    display: flex;
    align-items: center;
    height: 80vh;
}
.section-imagen>div{
    display: block;
    font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
}
.section-imagen>h3{
    font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
}
.texto-imagen{
    width: 100%;
    margin: 0;
    text-align: center;
    margin-top: -50px;
}
</style>
