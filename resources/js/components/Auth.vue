<template>
    <div class="login login-bg">
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form @submit.prevent="login">
                        <h1>Acceso al Sistema</h1>
                        <div>
                            <input type="email" class="form-control" placeholder="Correo electronico" required v-model="form.email" />
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Contraseña" required v-model="form.password" />
                        </div>
                        <div>
                            <button type="submit" class="btn btn-default submit" @click.prevent="login()">Ingresar</button>
                            <a class="reset_pass" href="#">Olvidaste tu contraseña?</a>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1><i class="fa fa-shield"></i> CEO Ciberdefensa</h1>
                                <p>©2025 Derechos reservados.</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: {
                email: '',
                password: ''
            },
            error: 0,
            permisos: [],
        }
    },
    methods: {
    login(){
        let me = this;
        if (me.validarLogin()) {
            return;
        }
        //me.opcionesToastr();
        axios
            .post("/authenticate/ingreso", {
                email: me.form.email,
                password: me.form.password
            })
            .then(function (response) {

                if (response.data.code == 401) {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response.data.message || "Las credenciales que ingresó no son correctas.",
                        confirmButtonColor: "#d33"
                    });
                    me.form.password = "";
                }
                if (response.data.code == 402) {
                    Swal.fire({
                        icon: "warning",
                        title: "Advertencia",
                        text: response.data.message || "Última oportunidad antes de que su cuenta sea bloqueada.",
                        confirmButtonColor: "#f39c12"
                    });
                    me.form.password = "";
                }
                if (response.data.code == 403) {
                    Swal.fire({
                        icon: "error",
                        title: "Cuenta bloqueada",
                        text: response.data.message || "Su cuenta ha sido bloqueada por múltiples intentos fallidos.",
                        confirmButtonColor: "#d33"
                    });
                }
                if (response.data.code == 200) {
                    Swal.fire({
                        icon: "success",
                        title: "Inicio de sesión exitoso",
                        text: "Bienvenido al sistema.",
                        confirmButtonColor: "#3085d6",
                        timer: 2000, 
                        showConfirmButton: false, 
                        allowOutsideClick: false, 
                        willClose: () => {
                            me.ListarPermisos(response.data.authUser.id);
                            me.$router.push({ name: "Principal" });
                            location.reload();
                        }
                    });
                }
                //console.log(response);
            })
            .catch(function (error) {
            // handle error
            console.log(error);
        })
    },
    validarLogin(){
        this.error = 0;
        if (!this.form.email && !this.form.password) {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Debe introducir sus credenciales de acceso.",
                confirmButtonColor: "#d33"
            });
            return 1;
        }
        if (!this.form.email) {
            Swal.fire({
                icon: "warning",
                title: "Atención",
                text: "Debe introducir su Correo Electrónico.",
                confirmButtonColor: "#f39c12"
            });
            this.error = 1;
        }
        if (!this.form.password) {
            Swal.fire({
                icon: "warning",
                title: "Atención",
                text: "Debe introducir su Contraseña.",
                confirmButtonColor: "#f39c12"
            });
            this.error = 1
        }
        return this.error;
    },
    ListarPermisos(id){
        let me = this;
        axios
        .post("/listarPermisos", {
            id: id
        })
        .then(function (response) {
            me.permisos = response.data
        })
    },
    opcionesToastr(){
    toastr.options = {
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "600",
        "hideDuration": "1000",
        "timeOut": "2500",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "slideDown",
        "hideMethod": "fadeOut"
    }
    }
    }
}
</script>
<style>
/* Si usas CSS global en tu aplicación */
.login-bg {
  background-color: #F7F7F7;
  min-height: 100vh;
  width: 100%;
}

/* Opcional: estilo para el contenedor del formulario */
.login_wrapper {
  background-color: #FFFFFF;

  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0,0,0,0.1);
  /* max-width: 400px; */
  margin: 0 auto;
  position: relative;
  top: 50%;
  transform: translateY(-50%);

  right: 0px;
    margin: 0px auto;
    margin-top: 5%;
    max-width: 350px;
    position: relative;
}
</style>