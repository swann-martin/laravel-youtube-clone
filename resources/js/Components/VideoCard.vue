<script setup>
  import { defineProps, toRefs, ref, watch, onMounted } from 'vue';
  import CheckCircle from 'vue-material-design-icons/CheckCircle.vue';

  const props = defineProps({
    title: String,
    user: String,
    views: String,
    image: String,
    videoUrl: String,
    thumbnail: String
  });

  const { title, user, views, image, videoUrl, thumbnail } = toRefs(props);

  let show = ref(false);
  let showVideo = ref(false);
  let video = ref(null);
  let width = ref(document.documentElement.clientWidth);

  onMounted(() => {
    window.addEventListener('resize', () => {
      width.value = document.documentElement.clientWidth;
    });
  });

  watch(
    () => show.value,
    (show) => {
      video.value.play();
      if (show) {
        showVideo.value = true;
        video.value.play();
        return '';
      }

      showVideo.value = false;
      video.value.pause();
      video.value.currentTime = 0;
    }
  );
</script>

<template>
  <div class="relative">
    <div
      class="m-2 bg-black rounded-lg"
      :class="[
        show && width > 630
          ? 'absolute z-30 transition ease-in-out delay-150 hover:translate-y-8 hover:scale-125 hover:bg-[#202020] duration-300'
          : ''
      ]"
    >
      <div
        @mouseover="show = true"
        @mouseleave="
          show = false;
          showVideo = false;
        "
      >
        <img
          class="cursor-pointer aspect-video"
          :src="thumbnail || ''"
          :class="
            (show
              ? 'transition ease-in-out delay-150 rounded-lg'
              : 'rounded-lg',
            showVideo ? 'delay-350 hidden' : '')
          "
          alt="video"
        />
        <div
          class="w-full h-full cursor-pointer aspect-video"
          :class="showVideo ? '' : 'delay-350 hidden'"
        >
          <video ref="video" :src="videoUrl || ''" type="video/mp4" />
        </div>
      </div>

      <div>
        <div class="flex mt-1.5">
          <div>
            <img
              :src="image || 'https://picsum.photos/id/240/100'"
              alt="channel image"
              class="items-baseline m-1.5 mt-2 w-8 h-8 rounded-full"
            />
          </div>
        </div>

        <div class="px-1.5 mt-1 text-white">
          <div class="text-[17px] font-extrabold cursor-pointer w-full">
            {{ title.substring(0, 100) }}
          </div>
          <div
            class="text-[14px] font-extrabold text-gray-300 cursor-pointer flex gap-1 items-center"
          >
            {{ user.substring(0, 30) }}
            <CheckCircle fillColor="#888888" :size="18" />
          </div>
          <div class="mb-1 text-sm text-gray-300 cursor-pointer">
            {{ views }}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped></style>
