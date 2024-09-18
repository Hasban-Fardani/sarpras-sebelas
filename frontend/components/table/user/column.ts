import type { ColumnDef } from "@tanstack/vue-table";
import { ArrowUpDown } from "lucide-vue-next";
import { Button } from "~/components/ui/button";
import type { User } from "~/types/user";

import DeleteAction from "./DeleteAction.vue";
import EditAction from "./EditAction.vue";
import type { Employee } from "~/types/employee";

export const columns: ColumnDef<User>[] = [
  {
    accessorKey: "employee.name",
    header: ({ column }) => {
      return h(
        Button,
        {
          variant: "ghost",
          onClick: () => column.toggleSorting(column.getIsSorted() === "asc"),
        },
        () => ["Nama", h(ArrowUpDown, { class: "ml-2 h-4 w-4" })]
      );
    },

    cell: ({ row }) => h("div", { class: "" }, row.getValue<Employee>("employee").name),
    enableSorting: true,
  },

  {
    accessorKey: "employee.email",
    header: ({ column }) => {
      return h(
        Button,
        {
          variant: "ghost",
          onClick: () => column.toggleSorting(column.getIsSorted() === "asc"),
        },
        () => ["Email", h(ArrowUpDown, { class: "ml-2 h-4 w-4" })]
      );
    },
    cell: ({ row }) =>
      h("div", {}, row.getValue<Employee>("employee").email),
  },
  {
    accessorKey: "role",
    header: ({ column }) => {
      return h(
        Button,
        {
          variant: "ghost",
          onClick: () => column.toggleSorting(column.getIsSorted() === "asc"),
        },
        () => ["Role", h(ArrowUpDown, { class: "ml-2 h-4 w-4" })]
      );
    },
    cell: ({ row }) =>
      h("div", { class: "text-center" }, row.getValue("role")),
    enableSorting: true,
  },
  {
    accessorKey: "id",
    header: () => h("div", { class: "text-center" }, "Aksi"),
    cell: ({ row }) => {
      return h("div", { class: "flex justify-end space-x-2" }, [
        h(EditAction),
        h(DeleteAction, { id: row.getValue("id"), name: row.getValue("name") }),
      ]);
    },
  },
];
