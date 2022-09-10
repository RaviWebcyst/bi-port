<template >
    <div>
        <sidebar />
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
            <Header />
            <div class="contianer-fluid px-2 py-2">
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
                            <div class="alert alert-success" v-if="success != ''">{{ success }}</div>
                            <div class="card-header bg-white pt-3 pb-3">
                                <h5 class="mb-0">Chat</h5>
                            </div>
                            <div class="card-body ">
                                <div class="mb-3 border border-light pl-1 pr-1 h-25 overflow-y-scroll chat">
                                    <div v-for="chat in chats">
                                        <div :class="chat.sender == 'admin' ? 'justify-content-start' : 'justify-content-end'"
                                            class="d-flex flex-row">
                                            <div :class="chat.sender == 'admin' ? 'bg-light text-dark' : 'bg-success text-white'"
                                                class="mt-1 mb-1 rounded-3 p-2">{{ chat.message }}</div>
                                        </div>
                                    </div>
                                </div>
                                <label class="form-label">Message</label>
                                <div class="form-group">
                                    <textarea class="form-control" name="message" rows="3"
                                        placeholder="Enter Your Message" v-model="form.message"></textarea>
                                </div>
                                <button class="btn bg-gradient-dark btn-sm float-end mt-2 mb-0 ml-2"
                                    @click="message">Send Message</button>
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
                message: "",
                id: this.$route.params.id
            },
            success: "",
            chats: [],
            loading:true
        }
    },
    created() {

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


        })
        .catch((err) => {
          console.log("error");
            console.log(err);
        });

        axios.get("../api/chats", {
            params: {
                id: this.form.id
            }
        }).then(res => {
            console.log(res);
            this.chats = res.data;
            this.loading=false;

        }).catch(err => {
            console.log(err);
            this.loading=false;

        });
    },

    methods: {
        message() {
            axios.post("api/chat", {
                message: this.form.message,
                id: this.form.id,
                  token:localStorage.getItem('usertoken')
            },
                {
                    headers: {
                        Authorization: `Bearer ${localStorage.usertoken}`
                    },

                }).then(res => {
                    console.log(res);
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
            localStorage.setItem("path","Login");
            this.$router.push({name:"Login"});
        }
    }




}
</script>
<style >
.chat::-webkit-scrollbar {
display: none;
}

</style>
