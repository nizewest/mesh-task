<template>
  <div id="products-create">
    <form @submit.prevent="onSubmit">
      <div class="field">
        <label class="label">Категория</label>
        <div class="control">
          <div class="select">
            <select v-model="product.category_id" required>
              <option v-for="(category, index) in $root.flattedCategories" v-bind:key="category.id" v-bind:index="index" v-bind:value="category.id">{{ category.level }} {{ category.name }}</option>
            </select>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Наименование</label>
        <div class="control">
          <input class="input" type="text" placeholder="Наименование" v-model="product.name" required>
        </div>
      </div>

      <div class="field">
        <label class="label">Описание</label>
        <div class="control">
          <textarea class="textarea" placeholder="Описание" v-model="product.description" required></textarea>
        </div>
      </div>

      <div class="field">
        <label class="label">Изображение</label>
        <div class="control">
          <input class="input" type="text" placeholder="URL картинки" v-model="product.image" required>
        </div>
      </div>

      <div class="field is-grouped">
        <div class="control">
          <button class="button is-link" type="submit" :disabled="loading">Сохранить</button>
        </div>
        <div class="control">
          <router-link to="/" class="button is-text" tag="button" :disabled="loading">Отмена</router-link>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      product: {
        name: "Lorem product",
        description: "Lorem product description",
        image: "https://bulma.io/images/placeholders/640x480.png",
        category_id: null
      },
      loading: false
    }
  },
  methods: {
    onSubmit() {
      this.loading = true
      this.$root._resources.product.save(this.product).then(
        response => {
          this.loading = false
          if (response.data.message) {
            this.$root.messages.success = response.data.message
          }
          this.$router.push("/" + this.product.category_id)
        },
        response => {
          this.loading = false
          if (response.data.message) {
            this.$root.messages.error = response.data.message
          }
        }
      )
    }
  }
}
</script>
