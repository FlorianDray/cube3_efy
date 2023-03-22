
<template>
    <h1>Ceci est le Footer </h1>
    <ChatbotComponent />
</template>
  
<script>
import ChatbotComponent from './ChatbotComponent.vue';
export default {
    name: 'FooterComponent',
    components: { ChatbotComponent }
}
</script>
  
<style>
h1 {
    background-color: bisque;
}
</style>