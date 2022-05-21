<script>
    import Layout from "@/views/layouts/auth";
    import { authMethods } from "@/state/helpers";
    import appConfig from "@/app.config";
	import { required, email, minLength } from 'vuelidate/lib/validators';

    /**
     * Login component
     */
    export default {
        page: {
            title: "Login",
            meta: [{ name: "description", content: appConfig.description }]
        },
        components: { Layout },
        data() {
            return {
                email: "",
                password: "",
                authError: null,
                tryingToLogIn: false,
                isAuthError: false,
	            appName: appConfig.name
            };
        },
	    validations: {
            email: {
                required,
                email
            },
            password: {
                required,
                minLength: minLength(8)
            }
	    },
        methods: {
            ...authMethods,
            // Try to log the user in with the username
            // and password they provided.
            tryToLogIn() {
                this.tryingToLogIn = true;

                // Test form for validations
                this.$v.$touch();

                // Reset the authError if it existed.
                this.authError = null;
                if (this.$v.$invalid === false) {
                    return (
                        this.logIn({
                            email: this.email,
                            password: this.password
                        }).then(token => {
                            this.tryingToLogIn = false;
                            this.isAuthError = false;
                            // Redirect to the originally requested page, or to the home page

                            this.$router.push(
                                this.$route.query.redirectFrom || { name: "home" }
                            ).catch(error => {});
                        }).catch(error => {
                            this.tryingToLogIn = false;
                            this.authError = "Invalid credentials";
                            this.isAuthError = true;
                        })
                    );
                }
            }
        }
    };
</script>

<template>
	<Layout>
		<div class="row justify-content-center">

<div class="card col-md-12 login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
            <img src="https://cdn2.hubspot.net/hubfs/53/computer-run-faster.jpg" alt="login" class="login-card-img">
           
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <div class="brand-wrapper">
                <img src="images/logo.svg" height="34" alt="logo"  >
              </div>
              	<h5 class="text-primary">Welcome Back !</h5>
									<p>Sign in to {{ appName }}.</p>
               		 <b-alert v-model="isAuthError" variant="danger" class="mt-3" dismissible>{{authError}}</b-alert>

						<b-form class="p-2" @submit.prevent="tryToLogIn">
							<b-form-group id="input-group-1" label="Email" label-for="email">
								<b-form-input id="email"
								              v-model="email"
								              type="text"
								              placeholder="Enter email"
								              :class="{ 'is-invalid': tryingToLogIn && $v.email.$error }"></b-form-input>
								<b-form-invalid-feedback v-if="tryingToLogIn && $v.email.$error">
									<span v-if="!$v.email.required">Email is required.</span>
									<span v-if="!$v.email.email">Please enter valid email.</span>
								</b-form-invalid-feedback>
							</b-form-group>

							<b-form-group id="input-group-2" label="Password" label-for="password">
								<b-form-input
										id="password"
										v-model="password"
										type="password"
										placeholder="Enter password"
										:class="{ 'is-invalid': tryingToLogIn && $v.password.$error }"
								></b-form-input>
								<b-form-invalid-feedback v-if="tryingToLogIn && $v.password.$error">
									<span v-if="!$v.password.required">Please enter password</span>
									<span v-if="!$v.password.minLength">Password should be at least 8 characters</span>
								</b-form-invalid-feedback>
							</b-form-group>
								<div class="custom-control custom-checkbox">
								<input id="customControlInline" type="checkbox" class="custom-control-input" />
								<label class="custom-control-label" for="customControlInline">Remember me</label>
							</div>
							<div class="mt-3">
								<b-button type="submit" variant="primary" class="btn-block">Log In</b-button>
							</div>
							<div class="mt-4 text-center">
								<router-link tag="a" to="/forgot-password" class="text-muted">
									<i class="mdi mdi-lock mr-1"></i> Forgot your password?
								</router-link>
							</div>
                      	</b-form>
				<div class="mt-5 text-center">
					<p>
						© {{new Date().getFullYear()}} {{ appName }}. Crafted with
						<i class="mdi mdi-heart text-danger"></i> by <a href="https://www.multicloudai.com/" target="_blank">Multi Cloud Ai</a>
					</p>
				</div>
    
            </div>
          </div>
        </div>
      </div>


			<!-- end col -->
		</div>
		<!-- end row -->
	</Layout>
</template>

<style lang="scss" module></style>
