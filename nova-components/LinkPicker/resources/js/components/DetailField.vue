<template>
  <PanelItem :index="index" :field="field">
    <template #value>
      <a
        class="link-default"
        target="_blank"
        v-if="field.link"
        :href="field.link"
      >
        {{ field.link }}
      </a>
      <span v-else class="font-bold text-red-500"> Invalid link </span>
    </template>
  </PanelItem>
</template>

<script>
export default {
  props: ["index", "resource", "resourceName", "resourceId", "field"],
};
</script>
