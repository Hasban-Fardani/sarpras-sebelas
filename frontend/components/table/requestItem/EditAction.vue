<script setup lang="ts">
import { toTypedSchema } from '@vee-validate/zod';
import { z } from 'zod';

type Props = {
  id: string,
  name: string
}

const props = defineProps<Props>()

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
    <SForm v-slot="{ submitForm }" as="" :validation-schema="formSchema" @submit="onSubmit">
    <SDialog>
      <SDialogTrigger as-child>
        <SButton variant="outline" class="bg-yellow-500 hover:bg-yellow-200">
          <PenBoxIcon />
        </SButton>
      </SDialogTrigger>
      <SDialogContent class="sm:max-w-[425px]">
        <SDialogHeader>
          <SDialogTitle>Edit Barang</SDialogTitle>
          <SDialogDescription>
            Masukkan perubahan. Klik simpan untuk menyimpan di database.
          </SDialogDescription>
        </SDialogHeader>

        <form @submit="submitForm">
          <SFormField v-slot="{ componentField }" name="username">
            <SFormItem>
              <SLabel>Username</SLabel>
              <SFormControl>
                <SInput type="text" placeholder="shadcn" v-bind="componentField" />
              </SFormControl>
              <!-- <SFormDescription>
                This is your public display name.
              </SFormDescription> -->
              <SFormMessage />
            </SFormItem>
          </SFormField>
        </form>

        <SDialogFooter>
          <SButton type="submit" form="dialogForm">
            Simpan
          </SButton>
        </SDialogFooter>
      </SDialogContent>
    </SDialog>
  </SForm>
</template>