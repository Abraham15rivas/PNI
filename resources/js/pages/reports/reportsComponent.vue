<template>
     <div class="margin-x">
        <div class="row">
            <div class="col s12">
                <h5 class="center-align" >Reportes de estadísticas</h5>
            </div>
        </div>
        <div class="row" v-if="!ready">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center">Seleccionar tipo de reporte</span>
                        <md-field v-if="field">
                            <label for="state"></label>
                            <md-select v-model="typeReport" name="typeReport" id="typeReport">
                                <md-option :value="0">Seleccionar un tipo</md-option>
                                <md-option :value="'pdf'">PDF</md-option>
                                <md-option :value="'xlsx'">Excel</md-option>
                            </md-select>
                        </md-field>                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row" v-if="!ready && typeReport != ''">
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center">Seleccionar tipos de estadisticas</span>
                        <md-field v-if="field">
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
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <div v-if="loadSelect">
                            <span class="card-title center">Seleccionar rangos de fecha</span>
                            <i class="material-icons">picture_as_pdf</i>
                            <span class="card-title">No ha seleccionado ningún tipo de reporte</span>
                        </div>
                        <div v-if="loadDate">
                            <span class="card-title center">Seleccionar fechas</span>
                            <span class="card-title">Desde:</span>
                            <input type="date" v-model="since" :min="dateMin" :max="dateActual">
                            <span class="card-title">Hasta:</span>
                            <input type="date" v-model="until" :min="since" :max="dateActual">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 m12" v-if="readySelectedDate">
                <div class="card">
                    <div class="card-content center" v-if="!loadSelect">
                        <button class="btn btn-success" @click="sendRanges">Solicitar reporte</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" v-if="ready">
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
            typeReport: '',
            field: false,
            loadSelect: true,
            loadDate: false,
            ready: false,
            ranges: "select",
            valueDoc: "",
            since: "",
            until: "",
            dateActual: moment().format('YYYY-MM-DD'),
            dateMin: "",
            readySelectedDate: false,
            typeQuery: 0,
            routeName: "",
        }
    },
    methods: {
        async dateMinima (value) {
            try {
                let url = `reports/date_min/${ value }`
                const response = await axios.get(url)
                let data = response.data
                if (data) {
                    this.dateMin = data
                } else {
                    console.log('Error', data)
                }               
            } catch (error) {
                console.log(error)
            }
        },
        async sendRanges () {
            try {
                const url = "reports/create"
                let params = {
                    typeReport: this.typeReport,
                    typeQuery: this.typeQuery,
                    since: this.since,
                    until: this.until
                }
                let response = await axios.post(url, params)
                let data = response.data
                if (data) {
                    this.ready = true
                    this.routeName = data
                    this.valueDoc = `/storage/${this.typeReport}/${data}`
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
                    const url = `reports/delete/${this.typeReport}/${this.routeName}` 
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
        typeQuery () {
            if (this.typeQuery != 0) {
                this.loadSelect = false
                this.loadDate = true
                this.dateMinima(this.typeQuery)
            } else {
                this.loadSelect = true
                this.loadDate = false
                this.readySelectedDate = false
            }
        }
    },
    mounted () {
        this.field = true
    }
}
</script>

<style scoped>

</style>