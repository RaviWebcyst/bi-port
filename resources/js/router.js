import Vue from 'vue';
import Router from 'vue-router';

import home from './components/pages/home.vue';
import register from './components/pages/Register.vue';
import refer from './components/pages/refer.vue';

import index from './components/pages/index.vue';
import login from './components/pages/Login.vue';
import profile from './components/pages/profile.vue';
import password from './components/pages/password.vue';
import recharge from './components/pages/recharge.vue';
import investment from './components/pages/investment.vue';
import actives from './components/pages/actives.vue';
import walletDetails from './components/pages/walletDetails.vue';
import directMembers from './components/pages/directMembers.vue';

import levelView from './components/pages/levelView.vue';
import downline from './components/pages/downline.vue';
import royalty from './components/pages/royalty.vue';
import gBonus from './components/pages/generation_bonus.vue';
import roiBonus from './components/pages/roi_bonus.vue';
import royaltyBonus from './components/pages/royality_bonus.vue';
import walletTransfer from './components/pages/walletTransfer.vue';
import addWallet from './components/pages/add_wallet.vue';
import withdraw from './components/pages/withdraw.vue';
import withdrawDetails from './components/pages/withdrawDetails.vue';
import tickets from './components/pages/tickets.vue';
import createTicket from './components/pages/create_ticket.vue';
import recentTickets from './components/pages/recent_tickets.vue';
import chat from './components/pages/chat.vue';
import topup from './components/pages/topup.vue';
import investDetails from './components/pages/invest_details.vue';
import transactions from './components/pages/transactions.vue';
import pay from './components/pages/pay.vue';
import thankyou from './components/pages/thankyou.vue';


Vue.use(Router);
const routes = [
    {
        path:'/vue/home',
        component:home,
        name:"Home"
    },
    {
        path:'/vue/register',
        component:register,
        name:"Register"
    },
    {
        path:'/vue/login',
        component:login,
        name:"Login"
    },
    {
        path:'/vue',
        component:index,
        name:"Index"
    },
    {
        path:'/vue/profile',
        component:profile,
        name:"Profile"
    },
    {
        path:'/vue/change-password',
        component:password,
        name:"Password"
    },
    {
        path:'/vue/recharge',
        component:recharge,
        name:"Recharge"
    },

    {
        path:'/vue/investment',
        component:investment,
        name:"Investment"
    },
    {
        path:'/vue/actives',
        component:actives,
        name:"Actives"
    },
    {
        path:'/vue/walletDetails',
        component:walletDetails,
        name:"WalletDetails"
    },
    {
        path:'/vue/directMembers',
        component:directMembers,
        name:"directMembers"
    },
    {
        path:'/vue/levelView',
        component:levelView,
        name:"levelView"
    },
    {
        path:'/vue/downline',
        component:downline,
        name:"downline"
    },
    {
        path:'/vue/royalty',
        component:royalty,
        name:"royalty"
    },
    {
        path:'/vue/generation_bonus',
        component:gBonus,
        name:"gBonus"
    },
    {
        path:'/vue/roi_bonus',
        component:roiBonus,
        name:"roiBonus"
    },
    {
        path:'/vue/walletTransfer',
        component:walletTransfer,
        name:"walletTransfer"
    },
    {
        path:'/vue/royaltyBonus',
        component:royaltyBonus,
        name:"royaltyBonus"
    },
    {
        path:'/vue/addWallet',
        component:addWallet,
        name:"addWallet"
    },
    {
        path:'/vue/withdraw',
        component:withdraw,
        name:"withdraw"
    },
    {
        path:'/vue/withdrawDetails',
        component:withdrawDetails,
        name:"withdrawDetails"
    },
    {
        path:'/vue/tickets',
        component:tickets,
        name:"tickets"
    },
    {
        path:'/vue/createTicket',
        component:createTicket,
        name:"createTicket"
    },
    {
        path:'/vue/recentTickets',
        component:recentTickets,
        name:"recentTickets"
    },

    {
       path:'/vue/topup',
       component:topup,
       name:"Topup"
   },
   {
      path:'/vue/invest_details',
      component:investDetails,
      name:"Invests"
  },
  {
     path:'/vue/transactions',
     component:transactions,
     name:"Transactions"
  },
    {
     path:'/vue/payment',
     component:pay,
     name:"pay"
    },
    {
     path:'/vue/thankyou',
     component:thankyou,
     name:"thanks"
    },
    {
        path:'/vue/invite/:id',
        component:refer,
        name:"invite"
    },

    {
        path:'/vue/chat/:id',
        component:chat,
        name:"chat"
    },

];

const router = new Router({
        mode:'history',
        routes
});



export default router;
