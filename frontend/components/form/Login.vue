<script setup lang="ts">
import { toTypedSchema } from '@vee-validate/zod'
import * as z from 'zod'

const formSchema = toTypedSchema(z.object({
  nip: z.string().min(9).max(50),
  password: z.string().min(5).max(50),
}))

const form = useForm({
  validationSchema: formSchema,
})

const { user, login, refreshIdentity } = useSanctumAuth()
const onSubmit = form.handleSubmit(async (values) => {
  try {
    await login(values)
    return navigateTo('/redirect')
  } catch (error) {
    showToast({
      title: 'Gagal Login',
      description: 'Nip atau Password salah',
      variant: 'destructive'
    })
  }
})

// check if already login
onMounted(async () => {
  if (!user.value) {
    await refreshIdentity()
  }

  if (user.value) {
    return navigateTo('/redirect')
  }
})
</script>
<template>
  <form @submit="onSubmit">
    <SFormField v-slot="{ componentField }" name="nip">
      <SFormItem>
        <SLabel for="nip">Nip</SLabel>
        <SFormControl>
          <SInput id="nip" type="text" placeholder="Nip" v-bind="componentField" />
        </SFormControl>
        <SFormMessage />
      </SFormItem>
    </SFormField>
    <SFormField v-slot="{ componentField }" name="password">
      <SFormItem class="mt-4">
        <SLabel for="password">Password</SLabel>
        <SFormControl>
          <SInput id="password" type="password" placeholder="password anda" v-bind="componentField" />
        </SFormControl>
        <SFormMessage />
      </SFormItem>
    </SFormField>
    <SButton type="submit" class="w-full mt-3">
      Login
    </SButton>
  </form>
</template>