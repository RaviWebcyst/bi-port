<template >
    <div>
        <sidebar />
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
            <Header />
            <div class="contianer-fluid px-4 py-4">

                <div class="row justify-content-center">
                    <div class="col-md-6 ">
                        <div class="card mt-4" id="password">
                            <div class="alert alert-success" v-if="success != ''">{{ success }}</div>
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Create Ticket If you have any Enquiry</h5>
                            </div>
                            <div class="card-body ">

                                <label class="form-label"> Select Topic</label>
                                <div class="form-group">
                                    <select name="topic" class="form-control" v-model="form.topic">
                                        <option value="General">General</option>
                                        <option value="Tech Support">Tech Support</option>
                                        <option value="Enquires">Enquires</option>
                                        <option value="Account">Account</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <label class="form-label"> Email</label>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Enter Your Valid Email"
                                        v-model="form.email">
                                </div>
                                <label class="form-label">Subject</label>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Enter Your Subject"
                                        v-model="form.subject">
                                </div>
                                <label class="form-label">Message</label>
                                <div class="form-group">
                                    <textarea class="form-control" name="message" rows="3"
                                        placeholder="Enter Your Message" v-model="form.message"></textarea>
                                </div>
                                <button class="btn bg-gradient-dark btn-sm float-end mt-2 mb-0 ml-2"
                                    @click="message">Submit</button>
                                <button class="btn bg-gradient-light btn-sm float-end mt-2 mb-0">Cancel</button>
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
                topic: "",
                email: "",
                subject: "",
                message: ""
            },
            success: ""
        }
    },
    created(){
          axios
              .get("api/user", {
                  headers: {
                      Authorization: `Bearer ${localStorage.usertoken}`,
                  },
                  params:{
                    token:localStorage.getItem('usertoken')
                  },
              })
              .then((res) => {
                    if (res.data[0] == "token_expired") {
                        localStorage.setItem("path","Index");
                        this.$router.push({name:"Login"});
                    }

              })
              .catch((err) => {
                console.log("error");
                  console.log(err);
              });
    },

    methods: {
        message() {
            axios.post("api/send_message", {
                topic: this.form.topic,
                email: this.form.email,
                subject: this.form.subject,
                message: this.form.message,
            },
                {
                    headers: {
                        Authorization: `Bearer ${localStorage.usertoken}`
                    },
                    params:{
                      token:localStorage.getItem('usertoken')
                    },
                }).then(res => {
                    console.log(res);
                    this.form.topic = "";
                    this.form.email = "";
                    this.form.subject = "";
                    this.form.message = "";
                    this.success = res.data.status;

                }).catch(err => {
                    this.success = "";
                    console.log(err);
                })
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
