import { Sidebar, clientNav } from "@/components/Sidebar";
import { Topbar } from "@/components/Topbar";
import { AuthGate } from "@/components/AuthGate";

export default function ClientLayout({ children }: { children: React.ReactNode }) {
  return (
    <AuthGate allow={["client"]}>
      <div className="flex">
        <Sidebar items={clientNav} />
        <div className="flex flex-1 flex-col">
          <Topbar />
          <div className="p-4 space-y-4">{children}</div>
        </div>
      </div>
    </AuthGate>
  );
}
