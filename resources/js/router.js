import Vue from 'vue';
import Router from 'vue-router';

import home from './components/pages/home.vue';
import register from './components/pages/Register.vue';
import refer from './components/pages/refer.vue';

import index from './components/pages/index.vue';
import about from './components/pages/about.vue';

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
import pay_binance from './components/pages/pay_binance.vue';

import thankyou from './components/pages/thankyou.vue';


Vue.use(Router);
const routes = [
    {
        path:'/home',
        component:home,
        name:"Home"
    },
    {
        path:'/register',
        component:register,
        name:"Register"
    },
    {
        path:'/login',
        component:login,
        name:"Login"
    },
    {
        path:'/',
        component:index,
        name:"Index"
    },
    {
        path:'/about',
        component:about,
        name:"about"
    },
    {
        path:'/profile',
        component:profile,
        name:"Profile"
    },
    {
        path:'/change-password',
        component:password,
        name:"Password"
    },
    {
        path:'/recharge',
        component:recharge,
        name:"Recharge"
    },

    {
        path:'/investment',
        component:investment,
        name:"Investment"
    },
    {
        path:'/actives',
        component:actives,
        name:"Actives"
    },
    {
        path:'/walletDetails',
        component:walletDetails,
        name:"WalletDetails"
    },
    {
        path:'/directMembers',
        component:directMembers,
        name:"directMembers"
    },
    {
        path:'/levelView',
        component:levelView,
        name:"levelView"
    },
    {
        path:'/downline',
        component:downline,
        name:"downline"
    },
    {
        path:'/royalty',
        component:royalty,
        name:"royalty"
    },
    {
        path:'/generation_bonus',
        component:gBonus,
        name:"gBonus"
    },
    {
        path:'/roi_bonus',
        component:roiBonus,
        name:"roiBonus"
    },
    {
        path:'/walletTransfer',
        component:walletTransfer,
        name:"walletTransfer"
    },
    {
        path:'/royaltyBonus',
        component:royaltyBonus,
        name:"royaltyBonus"
    },
    {
        path:'/addWallet',
        component:addWallet,
        name:"addWallet"
    },
    {
        path:'/withdraw',
        component:withdraw,
        name:"withdraw"
    },
    {
        path:'/withdrawDetails',
        component:withdrawDetails,
        name:"withdrawDetails"
    },
    {
        path:'/tickets',
        component:tickets,
        name:"tickets"
    },
    {
        path:'/createTicket',
        component:createTicket,
        name:"createTicket"
    },
    {
        path:'/recentTickets',
        component:recentTickets,
        name:"recentTickets"
    },

    {
       path:'/topup',
       component:topup,
       name:"Topup"
   },
   {
      path:'/invest_details',
      component:investDetails,
      name:"Invests"
  },
  {
     path:'/transactions',
     component:transactions,
     name:"Transactions"
  },
    {
     path:'/payment',
     component:pay,
     name:"pay"
    },
    {
     path:'/binance_pay',
     component:pay_binance,
     name:"pay_binance"
    },
    {
     path:'/thankyou',
     component:thankyou,
     name:"thanks"
    },
    {
        path:'/invite/:id',
        component:refer,
        name:"invite"
    },

    {
        path:'/chat/:id',
        component:chat,
        name:"chat"
    },

];

const router = new Router({
        mode:'history',
        routes
});



export default router;
