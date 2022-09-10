<template >
    <div>
        <sidebar />
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
            <Header />
            <div class="contianer-fluid px-4 py-4">
            <div style="position:relative;top:250px;text-align:-webkit-center;overflow:unset;z-index:100">
                <swapping-squares-spinner
                  :animation-duration="1000"
                  :size="65"
                  color="#17c1e8"
                  class="text-center"
                  :class="loading?'':'d-none'"
                  />
              </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 ">
                        <div class="card mt-4" id="password">
                            <div class="alert alert-danger" v-if="error != ''">{{ error }}</div>
                            <div class="alert alert-success" v-if="success != ''">{{ success }}</div>
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Fund Transfer from E-wallet to E-wallet</h5>
                            </div>
                            <div class="card-body ">
                                <label class="form-label">Amount</label>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Enter Amount"
                                        v-model="form.amount">
                                </div>
                                <label class="form-label">User ID</label>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Enter User ID"
                                        v-model="form.userId" @change="users()">
                                        <div class="text-danger">{{ error }}</div>
                                        <div class="text-success">{{ name }}</div>
                                </div>
                                <label class="form-label">Password</label>
                                <div class="form-group">
                                    <input class="form-control" type="password" placeholder="Enter Your Password"
                                        v-model="form.password">
                                </div>
                                <button type="button" class="btn bg-gradient-dark btn-sm float-end mt-2 mb-0 ml-2"
                                    @click="transfer()">Submit</button>
                                <button type="button"
                                    class="btn bg-gradient-light btn-sm float-end mt-2 mb-0">Cancel</button>
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
import { SwappingSquaresSpinner  } from 'epic-spinners';
export default {
    components: {
        Header,
        Sidebar,
        'swapping-squares-spinner':SwappingSquaresSpinner,
    },

    data() {
        return {
            form: {
                amount: "",
                password: "",
                userId: ""
            },
            name:"",
            error: "",
            success:""
        }
    },
    methods: {
    users() {
        axios.post("api/users", {
            spid: this.form.userId,
            token:localStorage.getItem('usertoken')
        })
            .then(res => {
                console.log(res);
                if (res.data.length > 0) {
                    this.name = res.data[0].name;
                    this.error = "";
                    this.disable = false;
                }
                else {
                    this.error = "Invalid Sponser Id";
                    this.name = "";
                    this.disable = true;
                }
            })
            .catch(err => {
                console.log(err);
            });
    },
        transfer() {
            axios.post("api/ewallet_transfer", {
                user_id: this.form.userId,
                password: this.form.password,
                amount: this.form.amount,
                token:localStorage.getItem('usertoken')

            }, {
                headers: {
                    Authorization: `Bearer ${localStorage.usertoken}`
                },

            }).then(res => {
                console.log(res);
                if (res.data.status == 401) {
                    this.error = "Invalid Password";
                    this.success = "";
                }
                if (res.data.status == 400) {
                    this.error = "Insufficent Balance";
                    this.success = "";
                }
                if (res.data.status == 200) {
                    this.error = "";
                    this.form.userId = "";
                    this.form.password = "";
                    this.form.amount = "";
                    this.success = "Fund Transfer successfully";
                }
            }).catch(err => {
                console.log(err);
            })
        }
    },
    mounted() {
        if(localStorage.getItem('usertoken') == null){
            localStorage.setItem("path","Login");
            this.$router.push({name:"Login"});
        }
    }



}
</script>
<style lang="">

</style>
