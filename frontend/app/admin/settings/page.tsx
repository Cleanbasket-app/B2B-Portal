"use client";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { toast } from "@/components/ui/toast";

export default function AdminSettings() {
  return (
    <div className="space-y-2">
      <Input placeholder="Setting" />
      <Button onClick={() => toast("Settings saved")}>Save</Button>
    </div>
  );
}
