import Vue from "vue"
import VueRouter from "vue-router"
import VueResource from "vue-resource"
import Categories from "./components/Categories.vue"
import Category from "./components/Category.vue"
import Products from "./components/Products.vue"

Vue.use(VueRouter)
Vue.use(VueResource)

Vue.component("categories", Categories)
Vue.component("category", Category)
Vue.component("products", Products)

const routes = [{ path: "/:id", component: Products }]

const router = new VueRouter({
  routes
})

new Vue({
  router,
  data: {
    categories: []
  },
  http: {
    root: "/api"
  },
  created() {
    let category = this.$resource("categories")
    category.get().then(response => {
      this.categories = response.body
    })
  }
}).$mount("#app")
