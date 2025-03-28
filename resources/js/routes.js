import Vue from 'vue'
	import Router from 'vue-router'
	Vue.use(Router)

	export default new Router ({
    mode: 'history',
    linkActiveClass: 'active',
    routes: [
        {
            path: '*', //Cuando no encuentre una ruta aca sera por defecto
            component: require('./components/Notfound.vue').default
        },
        {
            path: '/',
            name: 'Inicio',
            component: require('./components/Bienvenida.vue').default
        },
        // Modulo tipo propiedasdes
        {
            path: '/grupoServicio',
            name: 'GrupoServicio',
            component: require('./components/GrupoServicios/Index.vue').default,
            /* beforeEnter: [auth, can('ver usuarios')] */
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



        {
            path: '/ceo',
            name: 'CeoTotal',
            component: require('./components/Unidades/Ceo.vue').default
        },
        {
            path: '/gguu',
            name: 'GrandeUnidad',
            component: require('./components/Unidades/GranUni.vue').default
        },
        {
            path: '/ppuu',
            name: 'PequeñaUnidad',
            component: require('./components/Unidades/PeqUni.vue').default
        },

        {
            path: '/mapa',
            name: 'MapaCeo',
            component: require('./components/Unidades/MapaCeo.vue').default
        },

        // ACCESO AL SISTEMA
        {
            path: '/usu',
            name: 'Usuarios',
            component:  require('./components/usuarios/Usuarios.vue').default,
            /* beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('administracion.usuarios.index')) {
                    next();
                } else {
                    next(from.path);
                }
            } */
        },


        







        {
            path: '/incidente',
            name: 'Incidente',
            component: require('./components/Incidente/Index.vue').default
        },

        /******************* ROLES************************* */
        {
            path: '/lrol',
            name: 'ListRoles',
            component:  require('./components/roles/ListRoles.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('administracion.roles.index')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },
        {
            path: '/erol',
            name: 'EditarRol',
            component:  require('./components/roles/Editar.vue').default,
            beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('rol-per')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },

        {
            path: '/nrol',
            name: 'NuevoRol',
            component:  require('./components/roles/NuevoRol.vue').default,
           beforeEnter: (to, from, next) => {
                let per = window.user.permissions.map(permission=>permission.name);
                if (per.includes('rol-per')) {
                    next();
                } else {
                    next(from.path);
                }
            }
        },

        /*******************PERSONAL************************* */
        {
            path: '/personal',
            name: 'Personal',
            component: require('./components/Personal/listPersonal.vue').default,
            /* beforeEnter: [auth, can('ver usuarios')] */
        },

    ]
})