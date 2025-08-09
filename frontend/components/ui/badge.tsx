import { cn } from "@/lib/utils";

export function Badge({ className, ...props }: React.HTMLAttributes<HTMLSpanElement>) {
  return <span className={cn("inline-flex items-center rounded bg-blue-100 px-2 py-1 text-xs font-medium", className)} {...props} />;
}
