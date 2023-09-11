<script setup>
  import { ref, onMounted } from 'vue';
  import { usePage, Link } from '@inertiajs/vue3';
  import MenuIcon from 'vue-material-design-icons/Menu.vue';
  import MagnifyIcon from 'vue-material-design-icons/Magnify.vue';
  import SideNavItem from '@/Components/SideNavItem.vue';

  let openSideNav = ref(true);
  let openSideNavOverlay = ref(false);
  let sideNavOverlay = ref(false);
  let width = ref(document.documentElement.clientWidth);

  onMounted(() => {
    resize();
    sideNavOverlay.value.classList.value =
      sideNavOverlay.value.classList.value += ' hidden';

    window.addEventListener('resize', () => {
      width.value = document.documentElement.clientWidth;
      resize();
    });
  });

  const resize = () => {
    if (width.value < 1280 && openSideNav.value) openSideNav.value = false;
    if (width.value > 1280 && !openSideNav.value) openSideNav.value = true;
  };

  const isNavOverlay = () => {
    if (usePage().url === '/') openSideNav.value = !openSideNav.value;
    if (usePage().url === '/add-video')
      openSideNavOverlay.value = !openSideNavOverlay.value;
    if (usePage().url === '/delete-video')
      openSideNavOverlay.value = !openSideNavOverlay.value;
    if (width.value < 640) openSideNavOverlay.value = !openSideNavOverlay.value;
    if (usePage().url !== '/' && width.value < 640)
      openSideNavOverlay.value = !openSideNavOverlay.value;
    if (usePage().props.video)
      openSideNavOverlay.value = !openSideNavOverlay.value;
  };
</script>

<template>
  <div class="relative">
    <div
      id="TopNav"
      class="w-[100%] h-[60px] fixed bg-black z-20 flex items-center justify-between"
    >
      <div class="flex items-center">
        <button
          @click="isNavOverlay()"
          class="inline-block p-2 ml-3 rounded-full cursor-pointer hover:bg-gray-800"
        >
          <MenuIcon fillColor="#FFFFFF" :size="26" />
        </button>
        <div class="mx-2"></div>
        <Link
          :href="route('home')"
          class="flex justify-center items-center mr-10 text-white cursor-pointer"
        >
          <img width="32" src="/images/YT-logo.png" alt="YOUTUBE" />
          <img width="62" src="/images/YT-logo-text.png" alt="YOUTUBE" />
        </Link>
      </div>

      <div class="w-[600px] md:block hidden">
        <div class="rounded-full flex items-center bg-[#222222]">
          <input
            type="text"
            class="block px-5 py-1.5 m-0 w-full text-base font-normal placeholder-gray-400 text-gray-400 bg-clip-padding bg-black rounded-l-full border border-transparent border-solid ease-in-out form-control border-l-gray-700 border-y-gray-700 transistion focus:ring-0"
            placeholder="Search"
          />
          <MagnifyIcon class="mx-6" fillColor="#FFFFFF" :size="23" />
        </div>
      </div>
      <div>
        <img
          class="mx-8 rounded-full"
          src="https://www.swannmartin.xyz/assets/swann-faaf847e.webp"
          alt="my-face"
          width="35"
        />
      </div>
    </div>

    <!-- Side Navigation part  -->

    <div v-if="width > 639">
      <div
        v-if="$page.url === '/'"
        id="SideNav"
        class="h-[100%] fixed z-0 bg-black"
        :class="[!openSideNav ? 'w-[70px]' : 'w-[240px]']"
      >
        <ul
          class="w-full mt-[60px]"
          :class="[!openSideNav ? 'p-2' : 'px-5 pb-2 pt-[7px]']"
        >
          <Link :href="route('home')">
            <SideNavItem :openSideNav="openSideNav" iconString="Home" />
          </Link>
          <Link :href="route('addVideo')">
            <SideNavItem :openSideNav="openSideNav" iconString="Add Video" />
          </Link>
          <Link :href="route('deleteVideo')">
            <SideNavItem :openSideNav="openSideNav" iconString="Delete Video" />
          </Link>
          <div class="my-2.5 border-b border-b-gray-700"></div>

          <SideNavItem :openSideNav="openSideNav" iconString="Subscriptions" />
          <SideNavItem :openSideNav="openSideNav" iconString="Library" />
          <SideNavItem :openSideNav="openSideNav" iconString="Liked" />
          <SideNavItem :openSideNav="openSideNav" iconString="History" />
          <SideNavItem :openSideNav="openSideNav" iconString="Watch Later" />

          <div v-if="openSideNav">
            <div class="my-2.5 border-b border-b-gray-700"></div>
            <div class="text-gray-400 text-extrabold text-[14px]">
              About Press Copyright
              <div>Contact Us</div>
              Creator Advertise Developpers
            </div>
            <div class="my-2.5 border-b border-b-gray-700"></div>
            <div class="text-gray-400 text-extrabold text-[14px]">
              Terms Privacy Policy Safety
              <div>How Youtube works</div>
              <span>Test new features</span>
            </div>
          </div>
        </ul>
      </div>
    </div>

    <div
      @click="openSideNavOverlay = false"
      class="fixed z-50 w-full h-screen bg-black bg-opacity-70"
      :class="
        openSideNavOverlay
          ? 'animate__animated animate__fadeIn animate__faster'
          : 'hidden z-[-1]'
      "
    />

    <div>
      <div
        id="SideNavOverlay"
        ref="sideNavOverlay"
        class="h-[100%] fixed z-50 bg-black mt-[9px]"
        :class="[
          openSideNavOverlay
            ? 'animate__animated animate__slideInLeft animate__faster'
            : 'animate__animated animate__slideOutLeft animate__faster'
        ]"
      >
        <div class="flex items-center">
          <button
            @click="isNavOverlay()"
            class="p-2 ml-3 rounded-full cursor-pointer hover:bg-gray-800"
          >
            <MenuIcon fillColor="#FFFFFF" :size="26" />
          </button>
          <div class="mx-2"></div>
          <Link
            :href="route('home')"
            class="flex justify-center items-center mr-10 text-white cursor-pointer"
          >
            <img width="32" src="/images/YT-logo.png" alt="YOUTUBE" />
            <img width="62" src="/images/YT-logo-text.png" alt="YOUTUBE" />
          </Link>
        </div>
        <ul class="p-2 px-5 py-2 mt-2 w-full">
          <Link :href="route('home')">
            <SideNavItem :openSideNav="true" iconString="Home" />
          </Link>
          <Link :href="route('addVideo')">
            <SideNavItem :openSideNav="true" iconString="Add Video" />
          </Link>
          <Link :href="route('deleteVideo')">
            <SideNavItem :openSideNav="true" iconString="Delete Video" />
          </Link>
          <div class="my-2.5 border-b border-b-gray-700"></div>

          <SideNavItem :openSideNav="true" iconString="Subscriptions" />
          <SideNavItem :openSideNav="true" iconString="Library" />
          <SideNavItem :openSideNav="true" iconString="Liked" />
          <SideNavItem :openSideNav="true" iconString="History" />
          <SideNavItem :openSideNav="true" iconString="Watch Later" />

          <div v-if="openSideNav">
            <div class="my-2.5 border-b border-b-gray-700"></div>
            <div class="text-gray-400 text-extrabold text-[14px]">
              About Press Copyright
              <div>Contact Us</div>
              Creator Advertise Developpers
            </div>
            <div class="my-2.5 border-b border-b-gray-700"></div>
            <div class="text-gray-400 text-extrabold text-[14px]">
              Terms Privacy Policy Safety
              <div>How Youtube works</div>
              <span>Test new features</span>
            </div>
          </div>
        </ul>
      </div>
    </div>

    <div
      class="w-[100%] h-[calc(100vh-60px)] absolute right-0 top-[60px]"
      :class="{
        'w-[calc(100%-70px)]': !openSideNav,
        'w-[calc(100%-240px)]': openSideNav,
        'w-[100vw] xl:w-[calc(100%-80px)]': $page.url !== '/',
        'w-[100vw]': width < 639
      }"
    >
      <slot />
    </div>
  </div>
</template>

<style>
  body {
    background-color: black;
  }
</style>
