<template>
  <DefaultField
    :field="field"
    :errors="errors"
    :show-help-text="showHelpText"
    :full-width-content="fullWidthContent"
  >
    <template #field>
      <input
        :id="field.attribute"
        type="text"
        class="w-full form-control form-input form-input-bordered"
        :class="errorClasses"
        :placeholder="field.name"
        v-model="value"
      />
      <div class="youtube-preview" v-if="computedValue">
        <iframe
          type="text/html"
          :src="'https://www.youtube.com/embed/' + computedValue"
          frameborder="0"
        ></iframe>
      </div>
    </template>
  </DefaultField>
</template>

<script>
import { FormField, HandlesValidationErrors } from "laravel-nova";

export default {
  mixins: [FormField, HandlesValidationErrors],

  props: ["resourceName", "resourceId", "field"],

  computed: {
    computedValue() {
      let videoId = this.value;
      if (!videoId) {
        return null;
      }
      // Check if value is a youtube url (or short url)
      if (
        videoId.indexOf("youtube.com") > -1 ||
        videoId.indexOf("youtu.be") > -1
      ) {
        // Get the video id from the url
        videoId = this.value.split("v=")[1];
        if (!videoId) {
          return null;
        }
        // Remove any additional parameters
        const ampersandPosition = videoId.indexOf("&");
        if (ampersandPosition != -1) {
          return videoId.substring(0, ampersandPosition);
        }
      }

      // Return the video id
      return videoId;
    },
  },

  methods: {
    /*
     * Set the initial, internal value for the field.
     */
    setInitialValue() {
      this.value = this.field.value || "";
    },

    /**
     * Fill the given FormData object with the field's internal value.
     */
    fill(formData) {
      formData.append(this.field.attribute, this.computedValue || "");
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
