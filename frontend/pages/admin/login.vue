<script setup lang="ts">
import { toTypedSchema } from '@vee-validate/zod'
import * as z from 'zod'

const formSchema = toTypedSchema(z.object({
  nip: z.string().min(2).max(50),
  password: z.string().min(2).max(50),
}))

const form = useForm({
  validationSchema: formSchema,
})

const { login } = useSanctumAuth()
const onSubmit = form.handleSubmit( async (values) => {
  await login(values)
})

// check if already login
const { user, refreshIdentity } = useSanctumAuth()
onMounted(async () => {
  if (!user.value) {
    await refreshIdentity()
  }

  if (user.value) {
    navigateTo('/admin')
  }
})
definePageMeta({
  layout: 'auth',
})
</script>
<template>
  <div class="mx-auto grid w-[350px] gap-6">
    <div class="grid gap-2 text-center">
      <h1 class="text-3xl font-bold">
        Login Admin
      </h1>
      <p class="text-balance text-muted-foreground">
        Masukkan nip anda dan password untuk login sebagai admin
      </p>
    </div>
    <div class="grid gap-4">
      <form @submit="onSubmit">
        <SFormField v-slot="{ componentField }" name="nip">
          <SFormItem>
            <SLabel for="nip">Nip</SLabel>
            <SFormControl>
              <SInput id="nip" type="text" placeholder="Nip" v-bind="componentField"  />
            </SFormControl>
            <SFormMessage />
          </SFormItem>
        </SFormField>
        <SFormField v-slot="{ componentField }" name="password">
          <SFormItem class="mt-4">
            <SLabel for="password">Password</SLabel>
            <SFormControl>
              <SInput id="password" type="password" v-bind="componentField" />
            </SFormControl> 
            <SFormMessage />
          </SFormItem>
        </SFormField>
        <SButton type="submit" class="w-full mt-3">
          Login
        </SButton>
      </form>
    </div>
  </div>
</template>