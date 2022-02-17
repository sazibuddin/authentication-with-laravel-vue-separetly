import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import Profile from '../views/Profile.vue'
import Users from '../views/Users.vue'
import RoleCreate from '../views/role/Create.vue'
import AssignRole from '../views/role/AssignRole.vue'
import UpdateRole from '../views/role/UpdateRole.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
    meta: {
      requiresAuth: true
    }
  },
  {
    path: '/login',
    name: 'Login',
    component: Login,
    meta: {
      visitor: true
    }
  },
  {
        path: "/logout",
        name: "Logout",
        component: () =>
            import ("../components/Logout"),
        meta: {
            requiresAuth: true
        }
    },
  {
    path: '/register',
    name: 'Register',
    component: Register,
    meta: {
      visitor: true
    }
  },
  {
    path: '/profile',
    name: 'Profile',
    component: Profile,
    meta: {
      requiresAuth: true
    }
  },
  {
    path: '/users',
    name: 'Users',
    component: Users,
    meta: {
      requiresAuth: true
    }
  },
  {
    path: '/role/create',
    name: 'RoleCreate',
    component: RoleCreate,
    meta: {
      requiresAuth: true
    }
  },
  {
    path: '/role/assign',
    name: 'AssignRole',
    component: AssignRole,
    meta: {
      requiresAuth: true
    }
  },
  {
    path: '/role/update/:id',
    name: 'UpdateRole',
    component: UpdateRole,
    meta: {
      requiresAuth: true
    }
  },
]

const router = new VueRouter({
  mode: 'history',
  routes
})
router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!localStorage.token) {
      next({
        name: "Login",
      })
    } else {
      next()
    }
  } else if (to.matched.some(record => record.meta.visitor)) {
    if (localStorage.token) {
      next({
        name: "Home",
      })
    } else {
      next()
    }
  } else {
    next()
  }
})
export default router
