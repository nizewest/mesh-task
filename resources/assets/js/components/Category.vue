<template>
<li>
  <router-link :to="'/categories/'+category.id" :class="{'is-active': $route.params.id == category.id}">{{ category.name }}</router-link>
  <categories :categories="category.children"></categories>
</li>
</template>

<script>
export default {
  name: 'category',
  props: ['category']
};
</script>
