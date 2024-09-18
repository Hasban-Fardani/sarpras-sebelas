<script setup lang="ts">
import type { UserLogin } from '~/types/user';

const { user, refreshIdentity } = useSanctumAuth<UserLogin>()

definePageMeta({
  middleware: ['sanctum:auth'],
});
</script>

<template>
  <div class="grid min-h-screen w-full md:grid-cols-[220px_1fr] lg:grid-cols-[280px_1fr]">
    <div class="hidden border-r bg-white text-black md:block">
      <div class="flex h-full max-h-screen flex-col gap-2">
        <div class="flex h-14 items-center border-none px-4 lg:h-[60px] lg:px-6">
          <Brand />
        </div>
        <!-- Sidebar on desktop -->
        <div class="flex-1">
          <nav class="grid items-start px-2 text-sm font-medium lg:px-4" aria-label="Sidebar">
            <AdminSidebarLinks />
          </nav>
        </div>
        <div class="mt-auto p-4">
        </div>
      </div>
    </div>
    <div class="flex flex-col">
      <header class="flex h-14 items-center gap-4 border-b bg-white text-black px-4 lg:h-[60px] lg:px-6">
        <!-- Sidebar on mobile -->
        <SSheet>
          <SSheetTrigger as-child>
            <SButton variant="outline" size="icon" class="shrink-0 md:hidden">
              <MenuIcon class="h-5 w-5" />
              <span class="sr-only">Toggle navigation menu</span>
            </SButton>
          </SSheetTrigger>
          <SSheetContent side="left" class="flex flex-col">
            <nav class="grid gap-2 text-lg font-medium" aria-label="Sidebar">
              <Brand />
              <AdminSidebarLinks />
            </nav>
            <div class="mt-auto"></div>
          </SSheetContent>
        </SSheet>
        <div class="flex-1"></div>
        <AdminNotification />
        <UserDropdown />
      </header>
      <main class="flex flex-1 flex-col gap-2 p-4 lg:px-6 bg-gray-100">
        <AdminBreadcrumb />
        <slot />
      </main>
    </div>
  </div>
</template>