<template>
  <div class="hold-transition register-page" style="background-image: url('front/uploads/2022/04/vrrvx.png');background-size:contain ;">
  <div class="register-box">

  <div class="card">
  <div class="alert alert-danger" v-if="errors.length > 0">{{errors}}</div>

    <div class="card-body register-card-body">
      <p class="login-box-msg">Register User</p>

      <form>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Sponser Id" v-model="form.spid" @change="getSpid()">
          <!-- <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div> -->
        </div>
          <div class="text-danger ">{{error}}</div>
          <div class="text-success ">{{success}}</div>

        <div class="form-group mb-3 mt-3">
          <input type="text" class="form-control" placeholder="Full name" v-model="form.name">
          <!-- <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div> -->
        </div>
        <div class="form-group mb-3">
          <input type="email" class="form-control" placeholder="Email" v-model="form.email">
          <!-- <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div> -->
        </div>
        <div class="form-group mb-3">
          <input type="text" class="form-control" placeholder="Phone" v-model="form.phone">
          <!-- <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div> -->
        </div>
        <div class="form-group mb-3">
          <input type="password" class="form-control" placeholder="Password" v-model="form.password">
          <!-- <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div> -->
        </div>

        <div class="row">
          <div class="col-6">
            <button type="button" class="btn btn-primary btn-block btn-flat" @click="register()" :disabled="form.disable">Register</button>
          </div>
          <div class="col-6">
            <!-- <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div> -->
          </div>
        </div>
      </form>
        <div class="row">
          <div class="col-md-8">
              <a href="javascript:;" @click="login()" class="text-center">I already have a membership</a>
          </div>
          <div class="col-md-4">
              <a href="javascript:;" @click="Index()" >Go to Home</a>
          </div>
        </div>

    </div>
  </div>
</div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            loading: false,
            form: {
                email: "",
                password: "",
               name:"",
               phone:"",
               spid:"",
            disable:false
            },
            error:"",
            success:"",
            errors:[]
        };
    },
    mounted(){
    if (this.$route.params.id) {
           this.form.spid = this.$route.params.id;
       }
    },

    methods: {
      Index(){
          localStorage.setItem("path","Index");
            location.reload();
      },
      login(){
        localStorage.setItem("path","Login");
        this.$router.push({name:"Login"});
      },

      getSpid(){

                axios.post("api/users", {
                    spid:this.form.spid
                })
                .then(res => {
                  console.log(res);
                   if(res.data.length > 0){
                    this.success = "Valid Sponser Id";
                    this.error="";
                    this.form.disable=false;
                   }
                   else{
                    this.error = "Invalid Sponser Id";
                    this.success="";
                    this.form.disable=true;
                   }
                })
                .catch(err => {
                    console.log(err);
                });
      },
        register() {
            // this.loading = true;
            // if (this.form.email == "") {
            //     alert("Phone is required");
            // }
            // if (this.form.password == "") {
            //     alert("Password is required");
            // }
            axios
                .post("api/register", {
                    spid: this.form.spid,
                    email: this.form.email,
                    password: this.form.password,
                    name: this.form.name,
                    phone: this.form.phone,
                })
                .then(res => {
                if(res.data.status == 400){
                var errors = JSON.parse(res.data.error);
                if(errors.email){
                      this.errors = errors.email[0];;
                    }
                    if(errors.spid){
                      this.errors = errors.spid[0];
                    }
                    if(errors.pwd){
                      this.errors = errors.pwd[0];
                    }
                    if(errors.name){
                    this.errors = errors.name[0];
                    }
                }
                else{
                      this.$fire({
                          title: "Registeration Successfully",
                          text: "UserID: "+res.data.user.uid+ " , password: "+res.data.user.showPass,
                          type: "success",
                          timer: 10000
                      }).then(res=>{
                          this.$router.push({name:"Login"});
                      });
                  //this.$router.push({"name":"Login"});
                  }
                })
                .catch(err => {
                console.log(err);
                    if (err.response.data.res) {
                        alert(err.response.data.res);
                    } else {
                        alert("error while register");
                    }
                });
        }
    }
};
</script>

<style scoped>
.cstminpt {
    border: 1px solid goldenrod;
    background: goldenrod;
    color: white;
    height: 40px;
    margin: 20px 0px;
}
.cstminpt::placeholder {
    color: white;
}
.p-20 {
    padding: 60px 0px !important;
}
/* .cstminpt {
    border: none;
}
.text {
    margin-left: 13px;
}
.text1 {
    margin-left: -15px;
}
.text > div > div {
    background-color: transparent;
    border: none;
}
.text1 > div > div {
    background-color: transparent;
    border: none;
} */
</style>
