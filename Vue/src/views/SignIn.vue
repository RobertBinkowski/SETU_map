<template>
  <section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-dark text-white" style="border-radius: 1rem">
            <div class="card-body p-5 text-center">
              <div class="mb-md-5 mt-md-4 pb-5">
                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                <p class="text-white-50 mb-5"></p>

                <div class="form-outline form-white mb-4">
                  <label class="form-label" for="email">Email</label>
                  <input
                    type="email"
                    id="email"
                    name="email"
                    v-model="email"
                    class="form-control form-control-lg"
                  />
                </div>

                <div class="form-outline form-white mb-4">
                  <label class="form-label" for="password">Password</label>
                  <input
                    type="password"
                    id="password"
                    name="password"
                    v-model="password"
                    class="form-control form-control-lg"
                  />
                </div>
                <button
                  class="btn btn-outline-light btn-lg px-5"
                  type="submit"
                  @click="login"
                >
                  Login
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
  import axios from "axios";
  export default {
    data() {
      return {
        email: "",
        password: "",
      };
    },
    methods: {
      async login() {
        try {
          const response = await axios.post("http://localhost:8000/api/login", {
            email: this.email,
            password: this.password,
          });
          const authToken = response.data.token;
          // Store the authToken in localStorage
          localStorage.setItem("authToken", authToken);

          // localStorage.setItem("user", response.data.user);
          // Redirect to the protected route
          this.$router.push({ name: "Admin" });
        } catch (error) {
          console.error(error);
          alert("Invalid login credentials");
        }
      },
    },
  };
</script>
