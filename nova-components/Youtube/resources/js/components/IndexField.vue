<template>
  <div class="youtube-preview" v-if="fieldValue">
    <iframe
      type="text/html"
      :src="'https://www.youtube.com/embed/' + fieldValue"
      frameborder="0"
    ></iframe>
  </div>
</template>

<script>
export default {
  props: ["resourceName", "field"],

  computed: {
    fieldValue() {
      return this.field.displayedAs || this.field.value;
    },
  },
};
</script>

<style>
.youtube-preview {
  position: relative;
  margin-top: 1rem;
  width: 100%;
  height: 0;
  padding-top: 56.25%;
}

.youtube-preview iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
</style>
