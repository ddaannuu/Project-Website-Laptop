import { createRouter, createWebHistory } from "vue-router";

import HomePage from "../views/HomePage.vue";
import Categories from "../views/Categories.vue";
// import Product from '../views/Product.vue'
import Business from "../views/Business.vue";
import Workstastion from "../views/Workstastion.vue";
import ProductDetail from "@/views/ProductDetail.vue";
import Students from "@/views/Students.vue";
import VideoEditing from "@/views/VideoEditing.vue";
import Profil_danu from "../views/Profil_danu.vue";
import Profil_baskara from "../views/Profil_baskara.vue";
import Profil_vianda from "../views/Profil_vianda.vue";
import Profil_farhan from "../views/Profil_farhan.vue";
import Profil_arya from "../views/Profil_arya.vue";
import Login from "../views/Login.vue";
import DashboardAdmin from "../views/DashboardAdmin.vue";
import CreateUser from "../views/user/Create.vue";
import EditUser from "../views/user/Edit.vue";
import ManageProduct from "../views/Manage_product.vue";
import CreateForm from "../views/products/Create_form.vue";
import EditNewArrival from "../views/products/EditNewArrival.vue";
// import EditOnSale from '@/views/products/EditOnSale.vue'
import EditBestSeller from "@/views/products/EditBestSeller.vue";

const routes = [
  { path: "/", redirect: "/homepage" },
  { path: "/homepage", name: "HomePage", component: HomePage },
  { path: "/categories", name: "Categories", component: Categories },
  //{ path: '/products', name: 'Product', component: Product },
  { path: "/business", name: "Business", component: Business },
  { path: "/workstastion", name: "Workstastion", component: Workstastion },
  { path: "/product/:id", name: "ProductDetail", component: ProductDetail },
  { path: "/students", name: "Students", component: Students },
  { path: "/videoediting", name: "VideoEditing", component: VideoEditing },
  { path: "/profil_danu", name: "Profil_danu", component: Profil_danu },
  { path: "/profil_baskara", name: "Profil_baskara", component: Profil_baskara },
  { path: "/profil_vianda", name: "Profil_vianda", component: Profil_vianda },
  { path: "/profil_farhan", name: "Profil_farhan", component: Profil_farhan },
  { path: "/profil_arya", name: "Profil_arya", component: Profil_arya },
  { path: "/login", name: "Login", component: Login, meta: { layout: "auth" } },
  { path: "/dashboard", name: "DashboardAdmin", component: DashboardAdmin, meta: { layout: "auth", requiresAuth: true } },
  { path: "/users/create", name: "Create", component: CreateUser, meta: { layout: "auth", requiresAuth: true } },
  { path: "/users/edit/:id", name: "Edit", component: EditUser, meta: { layout: "auth", requiresAuth: true } },
  { path: "/products/manage", name: "ManageProduct", component: ManageProduct, meta: { layout: "auth", requiresAuth: true } },
  { path: "/products/create", name: "CreateForm", compnent: CreateForm, meta: { layout: "auth", requiresAuth: true } },
  { path: "/products/edit/:id", name: "EditNewArrival", component: EditNewArrival, meta: { layout: "auth", requiresAuth: true } },
  // { path: '/products/edit_on_sale/:id',name: 'EditOnSale',component: EditOnSale,meta: { layout: 'auth', requiresAuth: true }},
  { path: "/products/edit_best_seller/:id", name: "EditBestSeller", component: EditBestSeller, meta: { layout: "auth", requiresAuth: true } },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (to.hash) {
      return {
        el: to.hash,
        behavior: "smooth",
      };
    }
    return { top: 0 };
  },
});

export default router;
