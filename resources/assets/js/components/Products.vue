<template>
<div class="products">
  <div v-if="loading">Загрузка...</div>
  <div v-else class="columns is-multiline">
    <div class="column is-one-third"
      v-for="(product, index) in products"
      v-bind:index="index"
      v-bind:key="product.id"
    >
      <div class="card product">
        <div class="card-image">
          <figure class="image is-4by3">
            <img :src="product.image">
          </figure>
        </div>
        <div class="card-content">
          <div class="media product__name">
            <div class="media-content">
              <p class="title is-6">{{ product.name }}</p>
            </div>
          </div>
          <div class="content product__description">
            {{ product.description }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
  data() {
    return {
      products: null,
      loading: false
    }
  },
  watch: {
    $route: "fetchData"
  },
  created() {
    this.fetchData()
  },
  methods: {
    fetchData() {
      let self = this
      this.loading = true
      if (self.$route.params.id) {
        this.$root._resources.category
          .getProducts({ id: self.$route.params.id })
          .then(response => {
            this.products = response.body
            this.loading = false
          })
      } else {
        this.$root._resources.product.get().then(response => {
          this.products = response.body
          this.loading = false
        })
      }
    }
  }
}
</script>

<style lang="scss">
.product {
  &__name {
    overflow: hidden;
    white-space: nowrap;
    position: relative;
    &::before {
      position: absolute;
      bottom: 0;
      top: 0;
      right: 0;
      width: 50px;
      display: block;
      content: "";
      background: linear-gradient(
        90deg,
        rgba(255, 255, 255, 0),
        rgba(255, 255, 255, 1)
      );
    }
  }
  &__description {
    height: 6em;
    overflow: hidden;
    position: relative;
    &::before {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 20px;
      display: block;
      content: "";
      background: linear-gradient(
        rgba(255, 255, 255, 0),
        rgba(255, 255, 255, 1)
      );
    }
  }
}
</style>
