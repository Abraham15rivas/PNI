<template>
     <div class="margin-x">
        <div class="row">
            <div class="col s12">
                <h5 class="center-align" >Reportes de estadísticas</h5>
            </div>
        </div>
        <div class="row" v-if="!ready">
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center">Seleccionar tipos de rangos</span>
                        <md-field>
                            <label for="state">Rangos</label>
                            <md-select v-model="ranges" name="ranges" id="ranges">
                                <md-option value="select">Seleccionar un tipo</md-option>
                                <md-option value="week">Semanas</md-option>
                                <md-option value="month">Meses</md-option>
                            </md-select>
                        </md-field>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <div v-if="loadSelect">
                            <span class="card-title center">Seleccionar rangos de fecha</span>
                            <i class="material-icons">picture_as_pdf</i>
                            <span class="card-title">No ha seleccionado ningún tipo rango</span>
                        </div>
                        <div v-if="loadWeek">
                            <span class="card-title center">Seleccionar semanas</span>
                            <span class="card-title">Desde:</span>
                            <input type="week">
                            <span class="card-title">Hasta:</span>
                            <input type="week">
                        </div>
                        <div v-if="loadMoth">
                            <span class="card-title center">Seleccionar meses</span>
                            <span class="card-title">Desde:</span>
                            <input type="month">
                            <span class="card-title">Hasta:</span>
                            <input type="month">
                        </div>
                        <div v-if="!loadSelect">
                            <button class="btn btn-success right" @click="sendRanges">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" v-else>
            <div class="col s12 m12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center">descargar reporte</span>
                        <a class="card-title center" href="#" :download="valueDoc" @click="download">
                           <i class="material-icons">picture_as_pdf</i>
                        </a> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            loadSelect: true,
            loadWeek: false,
            loadMoth: false,
            ready: false,
            ranges: '',
            valueDoc: "numero.pdf"
        }
    },
    methods: {
        async sendRanges () {
            this.ready = true
            /*try {
                const url = ""
                let response = await axios.get(url)
                let data = response.data
                if (data) {
                    alert("Enviado correctamente")
                    this.ready = true
                } else {
                    alert("Error al enviar")
                    this.ready = false
                }
            } catch (error) {
                console.log(error)
            }*/
        },
        download () {
            alert("descargando")
            window.location.reload()
        }
    },
    watch: {
        ranges () {
            if (this.ranges == "week") {
                this.loadSelect = false
                this.loadWeek = true
                this.loadMoth = false
            } else if (this.ranges == "month") {
                this.loadSelect = false
                this.loadWeek = false
                this.loadMoth = true
            } else {
                this.loadSelect = true
                this.loadWeek = false
                this.loadMoth = false
            }
        }
    }
}
</script>

<style scoped>

</style>