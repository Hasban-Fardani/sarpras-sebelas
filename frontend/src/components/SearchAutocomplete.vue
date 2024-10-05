<template>
  <v-autocomplete 
      v-model="selectItem"
      label="tambah barang" 
      item-title="name" 
      item-value="id"
      :items="item.items" 
      :search-input="search"
  />
</template>