<script setup>
  import { ref } from 'vue';
  import { Head, router } from '@inertiajs/vue3';
  import NavLayout from '@/Layouts/NavLayout.vue';
  import CheckCircle from 'vue-material-design-icons/CheckCircle.vue';
  import ThumbUpOutline from 'vue-material-design-icons/ThumbUpOutline.vue';
  import ThumbDownOutline from 'vue-material-design-icons/ThumbDownOutline.vue';
  import RecommendedVideos from '@/Components/RecommendedVideos.vue';

  defineProps({
    errors: Object
  });

  let title = ref('');
  let image = ref('');
  let video = ref('');
  let error = ref({
    title: null,
    image: null,
    video: null
  });

  const addVideo = () => {
    let err = false;
    error.value.title = null;
    error.value.image = null;
    error.value.video = null;

    console.log('error start', error.value);

    if (!title.value) {
      error.value.title = 'Please enter a title';
      console.log('Please enter a title');
      err = true;
    }
    if (!image.value) {
      error.value.title = 'Please select a thumbnail';
      console.log('Please enter a thumbnail');
      err = true;
    }

    if (!video.value) {
      error.value.title = 'Please select a video file';
      console.log('Please enter a video file');
      err = true;
    }

    if (err) {
      console.log('error end', error.value);
      return;
    }

    let data = new FormData();
    data.append('title', title.value);
    data.append('image', image.value);
    data.append('video', video.value);

    router.post('/videos-post', data);
  };

  const getVideo = (e) => (video.value = e.target.files[0]);
  const getImage = (e) => (image.value = e.target.files[0]);
</script>

<template>
  <Head title="Youtube" />
  <NavLayout>
    <div class="px-4 mx-auto max-w-xl">
      <div class="py-10 text-3xl font-extrabold text-white">Add video</div>
      <form @submit.prevent="addVideo">
        <div>
          <div class="text-gray-200">Title</div>
          <input
            v-model="title"
            type="text"
            class="block px-5 py-1.5 m-0 w-full text-xl placeholder-gray-400 text-gray-200 bg-clip-padding bg-black rounded border border-transparent border-gray-600 transition ease-in-out form-control dont-normal boderd-solid focus:ring-0"
            placeholder="My cool video"
          />
          <span v-if="errors.title" class="text-red-500">{{
            errors.title
          }}</span>
        </div>
        <div class="my-5"></div>
        <div>
          <div class="text-gray-200">Thumbnail</div>
          <input
            @change="getImage"
            type="file"
            id="formFileImage"
            class="block px-3 py-1.5 m-0 w-full text-xl placeholder-gray-700 text-gray-200 bg-clip-padding bg-black rounded border border-transparent border-gray-600 transition ease-in-out form-control dont-normal boderd-solid focus:border-blue-600 focus:outline-none"
          />
          <span v-if="error.image" class="text-red-500">{{ error.image }}</span>
          <span v-if="errors && errors.image" class="text-red-500">{{
            errors.image
          }}</span>
        </div>
        <div class="my-5"></div>
        <div>
          <div class="text-gray-200">Video/MP4</div>
          <input
            @change="getVideo"
            type="file"
            id="formFile"
            class="block px-3 py-1.5 m-0 w-full text-xl placeholder-gray-700 text-gray-200 bg-clip-padding bg-black rounded border border-transparent border-gray-600 transition ease-in-out form-control dont-normal boderd-solid focus:border-blue-600 focus:outline-none"
          />
          <span v-if="error.video" class="text-red-500">{{ error.video }}</span>
          <span v-if="errors && errors.video" class="text-red-500">{{
            errors.video
          }}</span>
        </div>
        <div class="my-5"></div>
        <div class="float-right">
          <button
            type="submit"
            class="px-4 py-2 font-bold text-white bg-green-600 rounded cursor-pointer hover:bg-green-700"
          >
            Upload Video
          </button>
        </div>
      </form>
    </div>
  </NavLayout>
</template>
