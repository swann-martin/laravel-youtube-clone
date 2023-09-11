<script setup>
  import { Head, Link } from '@inertiajs/vue3';
  import NavLayout from '@/Layouts/NavLayout.vue';
  import CheckCircle from 'vue-material-design-icons/CheckCircle.vue';
  import ThumbUpOutline from 'vue-material-design-icons/ThumbUpOutline.vue';
  import ThumbDownOutline from 'vue-material-design-icons/ThumbDownOutline.vue';
  import RecommendedVideos from '@/Components/RecommendedVideos.vue';

  defineProps({
    video: Object,
    comments: Array,
    recommendedVideos: Array
  });
</script>

<template>
  <Head title="Youtube" />
  <NavLayout>
    <div class="xl:flex">
      <!-- VIDEO SECTION -->
      <div class="p-3">
        <video :src="video.video || ''" controls autoplay />
        <div class="mt-4 text-2xl font-extrabold text-white">
          {{ video.title }}
        </div>

        <!-- CHANNEL AVATAR SECTION  -->
        <div class="flex items-center mb-4">
          <img
            :src="`https://picsum.photos/id/${(Math.random() * 100).toFixed(
              0
            )}/100`"
            alt="channel image"
            class="items-baseline m-1.5 mt-2 w-8 h-8 rounded-full"
          />

          <div class="pl-2 mt-1">
            <div
              class="flex gap-1 items-center text-lg font-extrabold text-white"
            >
              {{ video.user }}
              <CheckCircle fillColor="#888888" :size="18" />
            </div>
            <div class="text-sm font-extrabold text-gray-300">
              {{ video.views }}
            </div>
          </div>
        </div>

        <!-- END AVATAR SECTION  -->

        <!-- RECOMMENDED VIDEO SECTION  -->
        <div class="p-3 sm:hidden block w-[500px]">
          <div v-for="vid in recommendedVideos" :key="vid">
            <Link class="flex mb-3">
              <RecommendedVideos
                :href="route('videos.show', { id: vid.id })"
                :vid="vid"
              />
            </Link>
          </div>
        </div>
        <!-- END RECOMMENDED VIDEO SECTION  -->

        <!-- VIDEO DESCRIPTION section -->

        <div class="bg-[#3F3F3F] rounded-lg w-full p-3 text-white">
          <div class="text-lg font-extrabold">{{ video.title }}</div>
          <div class="mb-6 text-sm font-extrabold">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Assumenda
            asperioreset.
          </div>
          <div class="text-sm font-extrabold">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Assumenda
            asperiores qui, nisi eos vel magnam ipsam eius cupiditate minus
            culpa ad impedit adipisci vero. Laudantium voluptatum natus quia
            molestiae et.
          </div>
        </div>
        <!-- END VIDEO DESCRIPTION section -->

        <!-- COMMENTS section -->
        <div class="mt-6">
          <div class="text-lg font-extrabold text-white">
            {{ comments?.length }} Comments
          </div>

          <div v-for="comment in comments" :key="comment">
            <div class="flex items-center mt-2 mb-4">
              <img
                class="mt-2 w-12 h-12 rounded-full"
                :src="
                  `https://picsum.photos/id/${(Math.random() * 100).toFixed(
                    0
                  )}/100` || ''
                "
                alt="persons avatar"
              />
              <div class="pl-2 mt-1">
                <div
                  class="flex items-baseline text-lg font-extrabold text-white"
                >
                  <div>{{ comment.user }}</div>
                  <div class="pl-3 text-gray-400">{{ comment.time }}</div>
                </div>
                <div class="text-sm font-extrabold text-gray-200">
                  {{ comment.text }}
                </div>

                <div class="flex items-center mt-4">
                  <ThumbUpOutline fillColor="#888888" :size="18" class="pr-2" />
                  <div class="pr-10 text-sm font-extrabold text-gray-400">
                    {{ (Math.random() * 100).toFixed(0) }}
                  </div>
                  <ThumbDownOutline
                    fillColor="#888888"
                    :size="18"
                    class="pr-2"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- END COMMENTS section -->
      </div>

      <!-- END VIDEO SECTION  -->

      <!-- RECOMMENDED VIDEO SECTION  -->
      <div class="p-3 sm:block hidden w-[500px]">
        <div v-for="vid in recommendedVideos" :key="vid">
          <Link class="flex mb-3">
            <RecommendedVideos
              :href="route('videos.show', { id: vid.id })"
              :vid="vid"
            />
          </Link>
        </div>
      </div>
      <!-- END RECOMMENDED VIDEO SECTION -->
    </div>
  </NavLayout>
</template>
