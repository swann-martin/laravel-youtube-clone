<script setup>
  import { Head, Link } from '@inertiajs/vue3';
  import NavLayout from '@/Layouts/NavLayout.vue';
  import CheckCircle from 'vue-material-design-icons/CheckCircle.vue';
  import ThumbUpOutline from 'vue-material-design-icons/ThumbUpOutline.vue';
  import ThumbDownOutline from 'vue-material-design-icons/ThumbDownOutline.vue';
  import RecommendedVideos from '@/Components/RecommendedVideos.vue';

  defineProps({
    videos: Array
  });
</script>

<template>
  <Head title="Youtube" />
  <NavLayout>
    <div class="p-4 mx-auto max-w-2xl">
      <table class="min-w-full">
        <thead class="border-b">
          <tr class="flex justify-between text-white">
            <th scope="col" class="px-6 py-4 text-sm font-medium text-left">
              Vidoes
            </th>
            <th scope="col" class="px-6 py-4 text-sm font-medium text-left">
              Options
            </th>
          </tr>
        </thead>
        <tbody>
          <div v-for="video in videos" :key="video">
            <tr class="flex justify-between border-b">
              <td class="px-6 py-4 w-7/12 text-sm font-medium text-gray-900">
                <video controls muted width="320" :src="video.video" />
              </td>
              <td
                class="relative px-6 py-4 w-5/12 text-sm font-medium text-gray-900"
              >
                <div class="mb-4 font-extrabold text-white">
                  {{ video.title }}
                </div>
                <div class="w-full">
                  <Link
                    as="button"
                    method="delete"
                    :href="route('videos.destroy', { id: video.id })"
                    class="float-right absolute bottom-4 px-1 py-1 text-xs font-bold text-white bg-red-600 rounded cursor-pointer hover:bg-red-700"
                  >
                    Delete
                  </Link>
                </div>
              </td>
            </tr>
          </div>
        </tbody>
      </table>
    </div>
  </NavLayout>
</template>
