import { Sidebar, adminNav } from "@/components/Sidebar";
import { Topbar } from "@/components/Topbar";
import { AuthGate } from "@/components/AuthGate";

export default function AdminLayout({ children }: { children: React.ReactNode }) {
  return (
    <AuthGate allow={["admin"]}>
      <div className="flex">
        <Sidebar items={adminNav} />
        <div className="flex flex-1 flex-col">
          <Topbar />
          <div className="p-4 space-y-4">{children}</div>
        </div>
      </div>
    </AuthGate>
  );
}
