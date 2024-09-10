import { useToast, type ToastProps } from "~/components/ui/toast";

type StringOrVNode =
  | string
  | VNode
  | (() => VNode)

type ToasterToast = ToastProps & {
  id: string;
  title?: string;
  description?: StringOrVNode;
  action?: Component;
};

type Toast = Omit<ToasterToast, "id">;

export const showToast = (props: Toast, dismissTime = 2000) => {
  const { toast } = useToast();
  const t = toast(props);

  if (dismissTime > 0) {
      setTimeout(() => {
        t.dismiss();
      }, 2000);
  }
};
