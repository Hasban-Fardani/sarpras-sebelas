<script setup lang="ts">
import router from "@/router";
import { useUserStore } from "@/stores/user";
import { ref } from "vue";
import { useRoute } from "vue-router";
import { useDisplay } from "vuetify";
import { VSonner } from "vuetify-sonner";

const display = useDisplay();
const drawer = ref(!display.mobile.value);
const rail = ref(false);
const route = useRoute();
const routeList = route.path.split("/").splice(1);
const user = useUserStore();
const opened = ref(["Pengelolaan Barang", "Transaksi", "Laporan", "User"]);

const breadcrumbItems = routeList.map((r, i) => {
	return {
		title: r,
		to: `/${routeList.slice(0, i + 1).join("/")}`,
	};
});

const toggle = () => {
	if (display.mobile.value) {
		drawer.value = !drawer.value;
	} else {
		rail.value = !rail.value;
	}
};

const logout = async () => {
	router.push("/auth/login");

	await user.logout();
	await user.clear();

	location.reload();
};

type Link = {
	type: "item" | "divider" | "group";
	title: string;
	value?: string;
	icon: string;
	to?: string;
	sublinks?: Link[];
};

const links: Link[] = [
	{
		type: "item",
		title: "Dashboard",
		icon: "mdi-view-dashboard",
		to: "/admin/dashboard",
	},
	{
		type: "group",
		title: "Laporan",
		icon: "mdi-home-analytics",
		sublinks: [
		],
	},
	{
		type: "divider",
		title: "",
		icon: "",
	},
	{
		type: "group",
		title: "Kelola Barang",
		icon: "mdi-view-list",
		sublinks: [
			{
				type: "item",
				title: "Kategori Barang",
				icon: "mdi-tag-multiple",
				to: "/admin/category",
			},
			{
				type: "item",
				title: "Barang",
				icon: "mdi-view-list",
				to: "/admin/items",
			},
			{
				type: "item",
				title: "Barang Masuk",
				icon: "mdi-arrow-down-bold-hexagon-outline",
				to: "/admin/barang-masuk",
			},
			{
				type: "item",
				title: "Barang Keluar",
				icon: "mdi-arrow-up-bold-outline",
				to: "/admin/barang-keluar",
			},
		],
	},
	{
		type: "group",
		title: "Kelola Pegajuan",
		icon: "mdi-file-document-edit-outline",
		sublinks: [
			{
				type: "item",
				title: "Permintaan",
				icon: "mdi-format-list-checks",
				to: "/admin/permintaan",
			},
			{
				type: "item",
				title: "Pengadaan",
				icon: "mdi-basket-plus-outline",
				to: "/admin/pengadaan",
			},
		],
	},
	{
		type: "group",
		title: "Kelola Akun",
		icon: "mdi-account-box-multiple",
		sublinks: [
			{
				type: "item",
				title: "User",
				value: "user",
				icon: "mdi-account-group-outline",
				to: "/admin/users",
			},
			{
				type: "item",
				title: "Supplier",
				icon: "mdi-truck-delivery",
				to: "/admin/supplier",
			},
		],
	},
];
</script>

<template>
  <v-layout>
    <v-navigation-drawer
      v-model="drawer"
      width="250"
      color="primary"
      elevation="3"
      :rail="rail"
      :permanent="!$vuetify.display.mobile"
      :location="$vuetify.display.mobile ? 'bottom' : undefined"
    >
      <v-list density="compact" v-model:opened="opened" nav>
        <v-list-item
          class="d-flex justify-center align-center gap-2"
          v-show="!display.mobile"
          to="/"
        >
          <img
            src="/logo/icon.svg"
            :width="rail ? 25 : 50"
            alt="Logo sarpras"
          />
        </v-list-item>
        <div v-for="link in links" :key="link.title">
          <v-list-item
            v-if="link.type === 'item'"
            :prepend-icon="link.icon"
            :title="link.title"
            :value="link.value"
            :to="link.to"
          />
          
          <v-divider v-else-if="link.type === 'divider'"/>

          <v-list-group v-else-if="link.type === 'group'" :value="link.value">
            <template v-slot:activator="{ props }">
              <v-list-item
                v-bind="props"
                :prepend-icon="link.icon ?? 'mdi-view-list'"
                :title="link.title"
              />
            </template>

            <v-list-item
              v-for="sublink in link.sublinks"
              :prepend-icon="sublink.icon"
              :title="sublink.title"
              :value="sublink.value"
              :to="sublink.to"
            />
          </v-list-group>
        </div>
      </v-list> 
      <template v-slot:append> </template>
    </v-navigation-drawer>

    <v-app-bar :order="1" elevation="1" color="white" flat>
      <template v-slot:prepend>
        <v-app-bar-nav-icon @click.stop="toggle()"></v-app-bar-nav-icon>
      </template>
      <v-app-bar-title> Sarana Prasarana </v-app-bar-title>
      <template v-slot:append>
        <v-menu transition="scale-transition" color="white">
          <template v-slot:activator="{ props }">
            <v-btn
              color="primary"
              elevation="1"
              v-bind="props"
              icon="mdi-account"
              class="btn-account"
            />
          </template>

          <v-list>
            <v-list-item> Hello {{ user.data.name }} </v-list-item>
            <v-divider />
            <v-list-item to="/profile"> Akun </v-list-item>
            <v-list-item @click="logout()"> Logout </v-list-item>
          </v-list>
        </v-menu>
      </template>
    </v-app-bar>
    <v-main>
      <v-breadcrumbs :items="breadcrumbItems" class="bg-base">
        <template v-slot:divider>
          <v-icon icon="mdi-chevron-right" />
        </template>
      </v-breadcrumbs>
      <div class="px-4 bg-base h-100">
				<v-sonner expand position="top-center"/>
        <slot />
      </div>
    </v-main>
  </v-layout>
</template>

<style>
.v-main {
  min-height: 100vh;
}

.no-indent {
  --indent-padding: -8px;
  padding-inline-start: 0;
}

.btn-account {
  background-color: white;
}

.bg-base {
  background-color: #f2f2f2;
}

.v-list-group {
    --list-indent-size: 12px;
}
</style>
