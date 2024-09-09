<template>
  <div class="w-full lg:grid lg:min-h-[600px] lg:grid-cols-2 xl:min-h-[700px]">
    <div class="flex items-center justify-center py-12">
      <slot/>
    </div>
    <div class="hidden bg-muted lg:block">
      <NuxtImg
        src="/images/login-ilustration.svg"
        alt="Image"
        width="1920"
        height="1080"
        class="h-full w-full object-cover dark:brightness-[0.2] dark:grayscale"
      />
    </div>
  </div>
</template>