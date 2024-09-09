import { defineNuxtModule, addComponent } from '@nuxt/kit';
import * as LucideIcons from 'lucide-vue-next';

export default defineNuxtModule({
  meta: {
    name: 'lucide-icon-module',
    configKey: 'lucideIcons',
  },
  setup(_, nuxt) {
    // Iterasi semua ikon dari lucide-vue-next
    for (const [iconName, _] of Object.entries(LucideIcons)) {
      // Tambahkan suffix "Icon" ke setiap nama ikon
      const componentName = `${iconName}Icon`;
      
      // Daftarkan sebagai komponen global di Nuxt
      addComponent({
        name: componentName,  // Nama komponen yang akan digunakan
        export: iconName,     // Nama ikon yang diimpor dari lucide-vue-next
        filePath: 'lucide-vue-next', // Path untuk import komponen
        priority: 999,
      });
    }
  }
});
