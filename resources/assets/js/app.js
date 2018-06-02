import Vue from "vue"
import VueRouter from "vue-router"
import VueResource from "vue-resource"
import Categories from "./components/Categories.vue"
import Category from "./components/Category.vue"
import Products from "./components/Products.vue"
import ProductsCreate from "./components/ProductsCreate.vue"

Vue.use(VueRouter)
Vue.use(VueResource)

Vue.component("categories", Categories)
Vue.component("category", Category)
Vue.component("products", Products)

const routes = [
  { path: "/:id?", component: Products },
  {
    path: "/products/create",
    component: ProductsCreate,
    name: "products.create"
  }
]

const router = new VueRouter({
  routes
})

new Vue({
  router,
  data: {
    categories: [],
    messages: {
      success: '',
      error: ''
    }
  },
  http: {
    root: "/api"
  },
  created() {
    this.initResources()
    this._resources.category.get().then(response => {
      this.categories = response.body
    })
  },
  computed: {
    flattedCategories: function() {
      return this.flat(this.categories)
    }
  },
  watch: {
    'messages.success': function(val) {
      if (val != '') {
        setTimeout(() => {
          this.messages.success = ''
        }, 3000)
      }
    },
    'messages.error': function(val) {
      if (val != '') {
        setTimeout(() => {
          this.messages.error = ''
        }, 3000)
      }
    },
  },
  methods: {
    initResources() {
      let self = this
      this._resources = {
        category: self.$resource(
          "categories",
          {},
          {
            getProducts: { method: "GET", url: "categories{/id}/products" }
          }
        ),
        product: self.$resource("products")
      }
    },
    flat(items, level = '') {
      let final = []
      let self = this
      items.forEach(function(item) {
        item.level = level
        final.push(item)

        if (typeof item.children !== "undefined") {
          final = final.concat(self.flat(item.children, level + '- '))
        }
      })

      return final
    }
  }
}).$mount("#app")
