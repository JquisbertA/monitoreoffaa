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
        {
            path: '/grupoServicio',
            name: 'GrupoServicio',
            component: require('./components/GrupoServicios/Index.vue').default
        },
        {
            path: '/empresaServicio',
            name: 'EmpresaServicio',
            component: require('./components/EmpresaServicios/Index.vue').default
        },
        {
            path: '/modoPagoServicio',
            name: 'ModoPagoServicio',
            component: require('./components/ModoPagoServicios/Index.vue').default
        },
    ]
})