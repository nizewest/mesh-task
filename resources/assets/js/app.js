import Vue from 'vue'
import VueRouter from 'vue-router'
import Categories from './components/Categories.vue'
import Category from './components/Category.vue'

Vue.use(VueRouter)

Vue.component('categories', Categories)
Vue.component('category', Category)

const routes = [
  { path: '/categories/:id', component: {} },
]

const router = new VueRouter({
  routes
})

const app = new Vue({
  router,
  data: {
    categories: [
      {id: 1, name: 'test 1'},
      {id: 2, name: 'test 2', children: [
        {id: 3, name: 'test 3'},
        {id: 4, name: 'test 4', children: [
          {id: 5, name: 'test 5'}
        ]}
      ]},
    ]
  }
}).$mount('#app')
