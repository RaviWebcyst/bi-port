<template >
    <div>
        <sidebar />
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
            <Header />
            <div class="contianer-fluid px-4 py-4">

                <div class="row justify-content-center">
                    <div class="col-md-6 ">
                        <div class="card mt-4" id="password">
                        <div class="alert alert-danger" v-if="error">{{ error }}</div>
                        <div class="alert alert-success" v-if="success">{{ success }}</div>
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Change Password</h5>
                            </div>
                            <div class="card-body ">
                                <label class="form-label">Current password</label>
                                <div class="form-group">
                                    <input class="form-control" type="password" placeholder="Current password"
                                        onfocus="focused(this)" onfocusout="defocused(this)"
                                        v-model="form.old_password">
                                </div>
                                <label class="form-label">New password</label>
                                <div class="form-group">
                                    <input class="form-control" type="password" placeholder="New password"
                                        onfocus="focused(this)" onfocusout="defocused(this)" v-model="form.password">
                                </div>
                                <label class="form-label">Confirm new password</label>
                                <div class="form-group">
                                    <input class="form-control" type="password" placeholder="Confirm password"
                                        onfocus="focused(this)" onfocusout="defocused(this)" v-model="form.cpassword">
                                </div>
                                <button class="btn bg-gradient-dark btn-sm float-end mt-2 mb-0" @click="pwd()">Update
                                    password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>
<script>
import Header from "./header.vue";
import Sidebar from "./sidebar.vue";
export default {
    components: {
        Header,
        Sidebar,
    },

    data() {
        return {
            form: {
                old_password: "",
                password: "",
                cpassword: ""
            },
            password: "",
            email: "",
            success:"",
            error:""
        }
    },

    created() {
        axios.get("api/user", {
            headers: {
                Authorization: `Bearer ${localStorage.usertoken}`
            },
            params:{
              token:localStorage.getItem('usertoken')
            },
        })
            .then(res => {
                console.log(res);
                if (res.data[0] == "token_expired") {
                    localStorage.setItem("path","Index");
                    this.$router.push({name:"Login"});
                }
                this.email = res.data.user.email;
                this.password = res.data.user.showPass;

            }).catch(err => {
                console.log(err.response);
            });
    },

    methods: {
        pwd() {
            if (this.password == this.form.old_password && this.form.password == this.form.cpassword) {
                axios.post("api/password", { email: this.email, password: this.form.password }).then((res) => {
                    console.log(res);
                    if (res.status == 200) {
                        this.success = "password change successfully";
                        this.error = "";
                        location.reload();
                    }
                }).catch((e) => {
                    console.log(e);
                });
            }
            else {
                this.error = "password not match or wrong current password";
                this.success= "";
            }
        }
    },
    mounted() {
        if(localStorage.getItem('usertoken') == null){
            localStorage.setItem("path","Index");
            this.$router.push({name:"Login"});
        }
    }


}
</script>
<style lang="">

</style>
