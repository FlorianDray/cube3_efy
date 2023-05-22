<template>
    <span class="highlights" @click="$emit('keyword-click', keyword)">
      <slot></slot>
    </span>
  </template>
  
  <script>
  export default {
    name: 'ClickableKeyword',
    props: {
      keyword: String,
    },
  };
  </script>
  
  <style scoped>
  </style>
  