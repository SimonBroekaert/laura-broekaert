<template>
  <PanelItem :index="index" :field="field">
    <template #value>
      <div class="w-1/2">
        <div class="youtube-preview" v-if="field.value">
          <iframe
            type="text/html"
            :src="'https://www.youtube.com/embed/' + field.value"
            frameborder="0"
          ></iframe>
        </div>
      </div>
    </template>
  </PanelItem>
</template>

<script>
export default {
  props: ["index", "resource", "resourceName", "resourceId", "field"],
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
