<template>
    <div class="login-container">
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form @submit.prevent="login">
                        <h1>Login Form</h1>
                        <div>
                            <input type="email" class="form-control" placeholder="Email" required v-model="form.email" />
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Password" required v-model="form.password" />
                        </div>
                        <div>
                            <button type="submit" class="btn btn-default submit">Log in</button>
                            <a class="reset_pass" href="#">Lost your password?</a>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1><i class="fa fa-paw"></i> Your App Name</h1>
                                <p>©2023 All Rights Reserved.</p>
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
            }
        }
    },
    methods: {
        async login() {
            try {
                await axios.get('/sanctum/csrf-cookie');
                const response = await axios.post('/login', this.form);
                
                if (response.status === 200) {
                    window.location.href = '/home';
                }
            } catch (error) {
                if (error.response.status === 422) {
                    // Mostrar errores de validación
                    console.log(error.response.data.errors);
                }
            }
        }
    }
}
</script>