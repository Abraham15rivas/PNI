<template>
    <v-app>
      <v-content>
        <v-container class="fill-height" >
          <v-row align="center" justify="center">
            <v-col cols="10">
              <v-card class="elevation-12">
                <v-window v-model="step">
                  <v-window-item :value="1">
                    <v-row>
                      <v-col cols="12" md="8">
                        <v-card-text class="mt-12">
                          <h3 class="text-center display-2 blue--text text--accent-3">Iniciar sesión</h3>
                          <v-form>
                            <v-text-field 
                              label="Cedula" 
                              v-model="ci" 
                              type="text" 
                              color="blue accent-3"/>

                            <v-text-field 
                              label="Contraseña" 
                              v-model="pass" 
                              type="password" 
                              color="blue accent-3"/>
                          </v-form>
                          <h4 class="text-center mt-3">Restablecer contraseña</h4>
                          <div class="mt-3 text-center">
                            <v-btn rounded color="blue accent-3" dark>INICIAR SESIÓN</v-btn>
                          </div>                          
                        </v-card-text>
                      </v-col>
                      <v-col cols="12" md="4" class="blue accent-3">
                        <v-card-text class="white--text mt-12">
                          <h3 class="text-center display-1">{{title}}</h3>
                          <h5 class="text-center mt-6">{{sub_title}}</h5>
                        </v-card-text>
                        <div class="text-center mt-6">
                          <v-btn rounded outlined="" dark @click="step++">Registrar usuario</v-btn>
                        </div>
                      </v-col>
                    </v-row>
                  </v-window-item>
                  <v-window-item :value="2">
                    <v-row class="fill-height">
                      <v-col cols="12" md="4" class="blue accent-3">
                        <v-card-text class="white--text mt-12">
                          <h3 class="text-center display-1">{{title}}</h3>
                          <h5 class="text-center mt-6">{{sub_title}}</h5>
                          <div class="text-center mt-6">
                            <v-btn rounded outlined="" dark @click="step--">Iniciar sesión</v-btn>
                          </div>
                        </v-card-text>
                      </v-col>
                      <v-col cols="12" md="8">
                        <v-card-text class="mt-12">
                          <h3 class="text-center display-2 blue--text text--accent-3">Registrar usuario</h3>
                          <h5 class="text-center mt-4">Sistema para la aprovación de proyectos</h5>
                          <v-form>
                            <v-text-field 
                              label="Cedula" 
                              v-model="ci" 
                              type="text" 
                              color="blue accent-3"/>

                            <v-text-field 
                              label="Contraseña" 
                              v-model="rePass" 
                              type="password" 
                              color="blue accent-3"/>

                            <v-text-field 
                              label="Repetir contraseña" 
                              v-model="pass" 
                              type="password" 
                              color="blue accent-3"/>
                          </v-form>
                          <div class="mt-3 text-center">
                            <v-btn rounded color="blue accent-3" dark>Registar usuario</v-btn>
                          </div>                          
                        </v-card-text>
                      </v-col>
                    </v-row>      
                  </v-window-item>
                </v-window>
              </v-card>
            </v-col>
          </v-row>
        </v-container>
      </v-content>
    </v-app>
  <!--v-app id="keep">
    <v-app-bar app clipped-left color="blue darken-1">
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
      <span class="title ml-3 mr-5">PNI<span class="font-weight-light">Covid-19</span></span>
      <v-text-field
        solo-inverted
        flat
        hide-details
        label="Search">
      </v-text-field>
      <v-spacer></v-spacer>
    </v-app-bar>

    <v-navigation-drawer
      v-model="drawer"
      app
      clipped
      color="grey lighten-4"
    >
      <v-list
        dense
        class="grey lighten-3"
      >
        <template v-for="(item, i) in items">
          <v-row
            v-if="item.heading"
            :key="i"
            align="center"
          >
            <v-col cols="6">
              <v-subheader v-if="item.heading">
                {{ item.heading }}
              </v-subheader>
            </v-col>
            <v-col
              cols="6"
            >
              <v-btn
                small
                text
              >edit</v-btn>
            </v-col>
          </v-row>
          <v-divider
            v-else-if="item.divider"
            :key="i"
            dark
            class="my-4"
          ></v-divider>
          <v-list-item
            v-else
            :key="i"
            link
          >
            <v-list-item-action>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title class="grey--text">
                {{ item.text }}
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </template>
      </v-list>
    </v-navigation-drawer>

    <v-main>
      <v-container
        fluid
        class="grey lighten-4 fill-height"
      >
        <v-row
          justify="center"
          align="center"
        >
          <v-col class="shrink">
           
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app-->
</template>

<script>
  export default {
    props: {
      source: String,
    },
    data: () => ({
      title: "PNI COVID-19",
      sub_title: "Sistema para la aprovación de proyectos",
      step: 1,
      drawer: null,
      items: [
        { icon: 'lightbulb_outline', text: 'Notes' },
        { icon: 'touch_app', text: 'Reminders' },
        { divider: true },
        { heading: 'Labels' },
        { icon: 'add', text: 'Create new label' },
        { divider: true },
        { icon: 'archive', text: 'Archive' },
        { icon: 'delete', text: 'Trash' },
        { divider: true },
        { icon: 'settings', text: 'Settings' },
        { icon: 'chat_bubble', text: 'Trash' },
        { icon: 'help', text: 'Help' },
        { icon: 'phonelink', text: 'App downloads' },
        { icon: 'keyboard', text: 'Keyboard shortcuts' },
      ],
    }),
  }
</script>

<style>
#keep .v-navigation-drawer__border {
  display: none
}
</style>