"use client";
import * as DialogPrimitive from "@radix-ui/react-dialog";
import { X } from "lucide-react";
import { cn } from "@/lib/utils";

const Dialog = DialogPrimitive.Root;
const DialogTrigger = DialogPrimitive.Trigger;
const DialogContent = ({ className, ...props }: DialogPrimitive.DialogContentProps) => (
  <DialogPrimitive.Portal>
    <DialogPrimitive.Overlay className="fixed inset-0 bg-black/50" />
    <DialogPrimitive.Content
      className={cn("fixed top-1/2 left-1/2 w-96 -translate-x-1/2 -translate-y-1/2 rounded bg-white p-6 shadow", className)}
      {...props}
    />
  </DialogPrimitive.Portal>
);
const DialogHeader = ({ children }: { children: React.ReactNode }) => (
  <div className="mb-4 flex items-center justify-between">
    {children}
    <DialogPrimitive.Close asChild>
      <button className="rounded p-1 hover:bg-gray-100">
        <X className="h-4 w-4" />
      </button>
    </DialogPrimitive.Close>
  </div>
);

export { Dialog, DialogTrigger, DialogContent, DialogHeader };
