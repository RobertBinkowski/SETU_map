import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "Home",
      component: HomeView,
    },
    {
      path: "/about",
      name: "About",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import("../views/AboutView.vue"),
    },
    {
      path: "/sign-in",
      name: "Sign-in",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import("../views/SignIn.vue"),
    },

    // Admin Pages------------------------------------------------------------
    {
      path: "/admin",
      name: "Admin",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import("../views/admin/AdminPage.vue"),
    },
    {
      path: "/locations",
      name: "Locations",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import("../views/admin/CRUD/Locations.vue"),
    },
    {
      path: "/users",
      name: "Users",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import("../views/admin/CRUD/Users.vue"),
    },
    {
      path: "/logs",
      name: "Logs",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import("../views/admin/Logs.vue"),
    },
    {
      path: "/buildings",
      name: "Buildings",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import("../views/admin/CRUD/Buildings.vue"),
    },
    {
      path: "/campuses",
      name: "Campuses",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import("../views/admin/CRUD/Campuses.vue"),
    },
    {
      path: "/connections",
      name: "Connections",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import("../views/admin/CRUD/Connections.vue"),
    },
    {
      path: "/floors",
      name: "Floors",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import("../views/admin/CRUD/Floors.vue"),
    },
    {
      path: "/images",
      name: "Images",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import("../views/admin/CRUD/Images.vue"),
    },
    {
      path: "/Rooms",
      name: "Rooms",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import("../views/admin/CRUD/Rooms.vue"),
    },
  ],
});

export default router;
