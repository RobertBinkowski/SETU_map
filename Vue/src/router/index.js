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
      path: "/signIn",
      name: "SignIn",
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

router.beforeEach((to, from, next) => {
  // Protected routes that require authentication
  const protectedRoutes = [
    "Admin",
    "Locations",
    "Users",
    "Logs",
    "Buildings",
    "Campuses",
    "Connections",
    "Floors",
    "Images",
    "Rooms",
  ];

  // Check if logged in and if the location requires login
  if (protectedRoutes.includes(to.name) && !isLoggedIn()) {
    // Redirect to the sign-in page
    next({ name: "SignIn" });
  } else {
    // Continue to the destination route
    next();
  }
});

const isLoggedIn = () => {
  // Check if the authentication token exists in localStorage
  const authToken = localStorage.getItem("authToken");
  return authToken !== null;
};

export default router;
