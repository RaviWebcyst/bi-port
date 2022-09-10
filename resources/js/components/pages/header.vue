<template lang="">
        <nav class="navbar navbar-main navbar-expand-lg position-sticky mt-4 top-1 px-0 mx-4 border-radius-xl z-index-sticky blur shadow-blur left-auto g-sidenav-pinned" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none " @click="toggle()">
                    <a href="javascript:;" class="nav-link text-body p-0">
                        <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </div>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <!-- <div class="input-group">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" placeholder="Type here..." onfocus="focused(this)" onfocusout="defocused(this)">
                        </div> -->
                    </div>
                    <ul class="navbar-nav  justify-content-end">
                        <!-- <li class="nav-item d-flex align-items-center">
                        <a href="https://demos.creative-tim.com/soft-ui-dashboard-pro/pages/authentication/signin/illustration.html" class="nav-link text-body font-weight-bold px-0" target="_blank">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none">Sign In</span>
                        </a>
                        </li> -->
                        <li class="nav-item px-3 d-flex align-items-center text-bold">{{name}} {{enable == 1 ? '* (Premium)':''}}</li>
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0"  @click="toggle()">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                        </li>
                        <li class="nav-item px-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" @click="logout()">
                        <i class="fa fa-power-off fixed-plugin-button-nav cursor-pointer"></i>
                        </a>
                        </li>
                        <!-- <li class="nav-item dropdown pe-2 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell cursor-pointer"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="javascript:;">
                                    <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <img src="" class="avatar avatar-sm  me-3 " alt="user image">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">New message</span> from Laur
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                            <i class="fa fa-clock me-1"></i>
                                            13 minutes ago
                                        </p>
                                    </div>
                                    </div>
                                </a>
                            </li>
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="javascript:;">
                                    <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <img src="https://demos.creative-tim.com/soft-ui-dashboard-pro/assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark  me-3 " alt="logo spotify">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">New album</span> by Travis Scott
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                            <i class="fa fa-clock me-1"></i>
                                            1 day
                                        </p>
                                    </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item border-radius-md" href="javascript:;">
                                    <div class="d-flex py-1">
                                    <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <title>credit-card</title>
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                                <g transform="translate(1716.000000, 291.000000)">
                                                    <g transform="translate(453.000000, 454.000000)">
                                                        <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                                                        <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                                                    </g>
                                                </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            Payment successfully completed
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                            <i class="fa fa-clock me-1"></i>
                                            2 days
                                        </p>
                                    </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        </li> -->
                    </ul>
                </div>
            </div>
        </nav>
</template>
<script>
import $ from "jquery";
export default {
    data() {
        return {
            name: "",
            enable:""
        };
    },
    methods: {
        logout() {
            localStorage.removeItem("usertoken");
            this.$router.push({name:"Login"});
        },

        toggle() {
            if (document.getElementsByClassName("g-sidenav-show")[0].classList.contains("g-sidenav-pinned") == true) {
                document.getElementsByClassName("g-sidenav-show")[0].classList.remove("g-sidenav-pinned");
                document.getElementsByClassName("g-sidenav-show")[0].classList.add("g-sidenav-hidden");
                }
            else {
                document.getElementsByClassName("g-sidenav-show")[0].classList.add("g-sidenav-pinned");
                document.getElementsByClassName("g-sidenav-show")[0].classList.remove("g-sidenav-hidden");
            }



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
                }
            })
            .then((res) => {

                this.name = res.data.user.name;
                this.enable = res.data.user.enable;
                // console.log(res);
            })
            .catch((err) => {
                // console.log(err);
            });


    },
    mounted(){
        const mediaQuery = window.matchMedia('(max-width: 768px)');
        if (mediaQuery.matches) {
        document.getElementsByClassName("g-sidenav-show")[0].classList.remove("g-sidenav-pinned");
        document.getElementsByClassName("g-sidenav-show")[0].classList.add("g-sidenav-hidden");
        }
    }




};
</script>
<style >
/* .ps{
    overflow-y:visible !important;
} */
.ps__rail-x , .ps__rail-y{
    display: none !important;
}
</style>
