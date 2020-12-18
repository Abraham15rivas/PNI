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
                            <span class="card-title center">Seleccionar año</span>
                            <span class="card-title">Año:</span>
                            <input type="date" v-model="year" min="2015" max="2020">
                            <span class="card-title center">Seleccionar semanas</span>
                            <span class="card-title">Desde:</span>
                            <input type="week" v-model="since" min="2015-W06" max="2015-W24">
                            <span class="card-title">Hasta:</span>
                            <input type="week" v-model="until" min="2015-W06" :max="weekActual">
                        </div>
                        <div v-if="loadMoth">
                            <span class="card-title center">Seleccionar meses</span>
                            <span class="card-title">Desde:</span>
                            <input type="month" v-model="since" :min="monthMin" :max="monthActual">
                            <span class="card-title">Hasta:</span>
                            <input type="month" v-model="until" :min="since" :max="monthActual">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 m12" v-if="readySelectedDate">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center">Seleccionar tipos de reportes</span>
                        <md-field>
                            <label for="state"></label>
                            <md-select v-model="typeQuery" name="typeQuery" id="typeQuery">
                                <md-option :value="0">Seleccionar un tipo</md-option>
                                <md-option :value="1">Investigadores e Investigadoras</md-option>
                                <md-option :value="2">Interés de Investigación</md-option>
                                <md-option :value="3">Perfil de Investigación</md-option>
                                <md-option :value="4">Modulo de Investigación Actual</md-option>
                            </md-select>
                        </md-field>                        
                    </div>
                    <div class="card-footer" v-if="!loadSelect">
                        <button class="btn btn-success right" @click="sendRanges">Solicitar reporte</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" v-else>
            <div class="col s12 m12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center">descargar reporte</span>
                        <a class="card-title center" :href="valueDoc" :download="routeName" @click="download">
                           <i class="material-icons">picture_as_pdf</i>
                        </a> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment'
export default {
    data () {
        return {
            loadSelect: true,
            loadWeek: false,
            loadMoth: false,
            ready: false,
            ranges: '',
            valueDoc: "",
            since: "",
            until: "",
            weekActual: moment().format('YYYY-[W]WW'),
            monthActual: moment().format('YYYY-MM'),
            monthMin: "2018-02",
            readySelectedDate: false,
            typeQuery: 0,
            routeName: "",
            year: ""
        }
    },
    methods: {
        async sendRanges () {
            try {
                const url = "reports/pdf"
                let params = {
                    typeQuery: this.typeQuery,
                    since: this.since,
                    until: this.until
                }
                let response = await axios.post(url, params)
                let data = response.data
                if (data) {
                    this.ready = true
                    this.routeName = data
                    this.valueDoc = `/storage/pdf/${data}`
                } else {
                    alert("Error al enviar")
                    this.ready = false
                }
            } catch (error) {
                console.log(error)
            }
        },
        download () {    
            setTimeout(() => {
                try {
                    const url = `reports/delete/pdf/${this.routeName}` 
                    let response = axios.delete(url).then((response) => {
                    let data = response.data
                        if (data) {
                            window.location.reload()
                        } else {
                            alert("Error al descargar")
                        }
                    })
                } catch (error) {
                    console.log(error)
                }
            }, 1000)        

        }
    },
    watch: {
        since () {
            if ((this.since && this.until) != "") {
                this.readySelectedDate = true
            }
        },
        until () {
            if ((this.since && this.until) != "") {
                this.readySelectedDate = true
            }
        },
        ranges () {
            if (this.ranges == "week") {
                this.loadSelect = false
                this.loadWeek = true
                this.loadMoth = false
            } else if (this.ranges == "month") {
                this.loadSelect = false
                this.loadWeek = false
                this.loadMoth = true
                this.validateDateNow
            } else {
                this.loadSelect = true
                this.loadWeek = false
                this.loadMoth = false
                this.readySelectedDate = false
            }
        }
    }
}
</script>

<style scoped>

</style>