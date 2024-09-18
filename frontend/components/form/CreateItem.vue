<script setup lang="ts">
import { toTypedSchema } from '@vee-validate/zod';
import { z } from 'zod';

const formSchema = toTypedSchema(z.object({
  username: z.string().min(2).max(50),
}))

function onSubmit(values: any) {
  showToast({
    title: 'You submitted the following values:',
    description: h('pre', { class: 'mt-2 w-[340px] rounded-md bg-slate-950 p-4' }, h('code', { class: 'text-white' }, JSON.stringify(values, null, 2))),
  })
}
</script>
<template>
  <SForm @submit="onSubmit" :validation-schema="formSchema">
    <SFormField v-slot="{ componentField }" name="username">
      <SFormItem>
        <SLabel>Username</SLabel>
        <SFormControl>
          <SInput type="text" placeholder="shadcn" v-bind="componentField" />
        </SFormControl>
        <SFormDescription>
          This is your public display name.
        </SFormDescription>
        <SFormMessage />
      </SFormItem>
    </SFormField>
    <SButton type="submit" class="mt-3 float-end">Save</SButton>
  </SForm>
</template>