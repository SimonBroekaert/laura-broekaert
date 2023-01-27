<template>
  <div>
    <a
      class="font-bold no-underline dim text-primary"
      target="_blank"
      v-if="field.link"
      :href="field.link"
      >{{ field.link }}</a
    >
  </div>
</template>

<script>
export default {
  props: ["resourceName", "field"],
};
</script>
