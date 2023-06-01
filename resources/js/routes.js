import Vue from 'vue'
	import Router from 'vue-router'
	Vue.use(Router)

	export default new Router ({
    mode: 'history',
    linkActiveClass: 'active',
    routes: [
        {
            path: '*', //Cuando no encuentre una ruta aca sera por defecto
            component: require('./components/ExampleComponent.vue').default
        },
        {
            path: '/',
            name: 'Inicio',
            component: require('./components/Plantilla.vue').default
        },
        // Modulo tipo propiedasdes
        /* {
            path: '/tipoPropiedad',
            name: 'TipoPropiedad',
            component: require('./components/Propiedades/Index.vue').default
        }, */
    ]
})