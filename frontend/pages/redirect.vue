<script setup lang="ts">
import type { UserLogin } from '~/types/user';

const { user, refreshIdentity } = useSanctumAuth<UserLogin>()

onMounted(async () => {
  if (!user.value && process.client) {
    await refreshIdentity()
  }

  if (user.value?.role === 'admin') {
    navigateTo('/admin')
  }

  if (user.value?.role === 'unit') {
    navigateTo('/division')
  }

  if (user.value?.role === 'pengawas') {
    navigateTo('/supervisor')
  }
})
</script>