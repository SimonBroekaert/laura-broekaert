<template>
  <div>
    <a
      class="font-bold no-underline dim text-primary"
      target="_blank"
      v-if="field.link"
      :href="field.link"
      >{{ field.link }}</a
    >
    <span v-else class="font-bold text-red-500"> Invalid link </span>
  </div>
</template>

<script>
export default {
  props: ["resourceName", "field"],
};
</script>
