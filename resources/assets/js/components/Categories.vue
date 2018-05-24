<template>
<ul class="menu-list">
  <category
    v-for="(category, index) in categories"
    v-bind:category="category"
    v-bind:index="index"
    v-bind:key="category.id"
  ></category>
</ul>
</template>

<script>
export default {
  name: 'categories',
  props: ['categories']
}
</script>
